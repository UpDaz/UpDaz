<?php

namespace App\Jobs;

use App\AI\Agents\ArticleAnalyzerAgent;
use App\AI\Agents\ThemeSynthesizerAgent;
use App\Models\Category;
use App\Models\RawArticle;
use App\Models\WeeklyDigest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Prism\Prism\Schema\ArraySchema;
use Prism\Prism\Schema\EnumSchema;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;
use Throwable;

class AnalyzeAndGroupArticlesJob implements ShouldQueue
{
    use Queueable;

    /**
     * Enum sentinel returned by the model when no category matches.
     *
     * Anthropic's structured output rejects a nullable EnumSchema (the
     * generated `type: ["string", "null"]` isn't accepted alongside a
     * string-only `enum` list), so we use a plain string value instead
     * of `nullable: true` and treat it as "no match" in sanitizeTheme().
     */
    private const NO_MATCHING_THEME = 'Aucune catégorie';

    private int $throttle;

    public function __construct()
    {
        $this->throttle = max(0, (int) config('ai.throttle_seconds', 5));
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        notice('[AnalyzeAndGroupArticlesJob] Démarrage');

        $this->analyzeUnanalyzedArticles();

        // Regroupement par thème, uniquement les thèmes avec assez de matière
        $eligibleThemeGroups = RawArticle::whereNull('digested_at')
            ->whereNotNull('theme')
            ->get()
            ->groupBy('theme')
            ->filter(fn ($group) => $group->count() >= 2);

        // Un digest par thème deviendra un article : on ne garde que les
        // thèmes les plus riches, dans la limite voulue par run. Les
        // thèmes laissés de côté restent éligibles au prochain run (leurs
        // articles ne sont pas marqués `digested_at`).
        $maxArticlesPerRun = max(1, (int) config('blog.max_articles_per_run', 1));

        $themeGroups = $eligibleThemeGroups
            ->sortByDesc(fn ($group) => $group->count())
            ->take($maxArticlesPerRun);

        notice('[AnalyzeAndGroupArticlesJob] Thèmes éligibles à la synthèse', [
            'themes_eligibles' => $eligibleThemeGroups->keys()->all(),
            'themes_retenus' => $themeGroups->keys()->all(),
            'max_articles_per_run' => $maxArticlesPerRun,
        ]);

        $digestsCreated = 0;

        $themeGroups->each(function ($articles, $theme) use (&$digestsCreated) {
            debug('[AnalyzeAndGroupArticlesJob] Synthèse du thème', [
                'theme' => $theme,
                'articles_count' => $articles->count(),
            ]);

            try {
                $synthesis = (new ThemeSynthesizerAgent())->prompt(
                    $articles->pluck('summary')->implode("\n\n")
                );
            } catch (Throwable $e) {
                warning('[AnalyzeAndGroupArticlesJob] Échec de synthèse du thème', [
                    'theme' => $theme,
                    'error' => $e->getMessage(),
                ]);

                return;
            } finally {
                sleep($this->throttle);
            }

            $digest = WeeklyDigest::create([
                'week_start' => now()->startOfWeek(),
                'theme' => $theme,
                'summary' => $synthesis->text,
                'raw_article_ids' => $articles->pluck('id'),
            ]);

            $digestsCreated++;

            debug('[AnalyzeAndGroupArticlesJob] WeeklyDigest créé', [
                'digest_id' => $digest->id,
                'theme' => $theme,
            ]);

            $articles->each->update(['digested_at' => now()]);
        });

        notice('[AnalyzeAndGroupArticlesJob] Terminé', ['digests_crees' => $digestsCreated]);
    }

    private function analyzeUnanalyzedArticles(): void
    {
        $categories = Category::where('is_active', true)->pluck('name')->all();

        if ($categories === []) {
            warning('[AnalyzeAndGroupArticlesJob] Aucune catégorie active : analyse des articles annulée.');

            return;
        }

        $articles = RawArticle::whereNull('analyzed_at')->get();

        notice('[AnalyzeAndGroupArticlesJob] Analyse des articles bruts', [
            'articles_a_analyser' => $articles->count(),
            'categories' => $categories,
        ]);

        $schema = new ObjectSchema('analysis', 'Analyse d\'article', [
            new EnumSchema(
                'theme',
                'La catégorie qui correspond le mieux à cet article, parmi la liste fournie. Si aucune catégorie ne correspond, retourne "' . self::NO_MATCHING_THEME . '".',
                [...$categories, self::NO_MATCHING_THEME],
            ),
            new StringSchema('summary', 'Résumé en 3-4 phrases'),
            new ArraySchema('keywords', 'Mots-clés', new StringSchema('keyword', '')),
        ], ['theme', 'summary', 'keywords']);

        $articles->each(function (RawArticle $article) use ($schema, $categories) {
            debug('[AnalyzeAndGroupArticlesJob] Analyse de l\'article', [
                'raw_article_id' => $article->id,
                'title' => $article->title,
            ]);

            try {
                $result = (new ArticleAnalyzerAgent())
                    ->withSchema($schema)
                    ->prompt($article->content);
            } catch (Throwable $e) {
                warning('[AnalyzeAndGroupArticlesJob] Échec d\'analyse de l\'article', [
                    'raw_article_id' => $article->id,
                    'error' => $e->getMessage(),
                ]);

                return;
            } finally {
                sleep($this->throttle);
            }

            $theme = $this->sanitizeTheme($result->theme ?? null, $categories);

            if ($theme === null) {
                // Ne correspond à aucune catégorie existante : on marque
                // l'article comme traité, sans résumé/mots-clés inutiles.
                $article->update(['analyzed_at' => now()]);

                debug('[AnalyzeAndGroupArticlesJob] Article sans thème correspondant', [
                    'raw_article_id' => $article->id,
                    'theme_retourne' => $result->theme ?? null,
                ]);

                return;
            }

            $article->update([
                'theme' => $theme,
                'summary' => $result->summary ?? null,
                'keywords' => $result->keywords ?? null,
                'analyzed_at' => now(),
            ]);

            debug('[AnalyzeAndGroupArticlesJob] Article analysé', [
                'raw_article_id' => $article->id,
                'theme' => $theme,
                'keywords' => $result->keywords ?? null,
            ]);
        });
    }

    /**
     * Rejects themes that don't exactly match one of the active
     * categories — guarding against a provider ignoring the schema's
     * enum constraint (e.g. reasoning leaking into the structured
     * output, or a hallucinated value).
     *
     * @param  array<int, string>  $categories
     */
    private function sanitizeTheme(?string $theme, array $categories): ?string
    {
        if ($theme === null) {
            return null;
        }

        $theme = trim($theme);

        if (! in_array($theme, $categories, true)) {
            return null;
        }

        return $theme;
    }
}
