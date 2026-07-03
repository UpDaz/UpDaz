<?php

namespace App\Jobs;

use App\AI\Agents\ArticleAnalyzerAgent;
use App\AI\Agents\ThemeSynthesizerAgent;
use App\Models\RawArticle;
use App\Models\WeeklyDigest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Prism\Prism\Schema\ArraySchema;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;

class AnalyzeAndGroupArticlesJob implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $schema = new ObjectSchema('analysis', 'Analyse d\'article', [
            new StringSchema('theme', 'Thème principal'),
            new StringSchema('summary', 'Résumé en 3-4 phrases'),
            new ArraySchema('keywords', 'Mots-clés', new StringSchema('keyword', '')),
        ]);

        RawArticle::whereNull('analyzed_at')->each(function (RawArticle $article) use ($schema) {
            $result = (new ArticleAnalyzerAgent())
                ->withSchema($schema)
                ->prompt($article->content);

            $article->update([
                'theme' => $result->theme,
                'summary' => $result->summary,
                'keywords' => $result->keywords,
                'analyzed_at' => now(),
            ]);
        });

        // Regroupement par thème, uniquement les thèmes avec assez de matière
        RawArticle::whereNull('digested_at')
            ->whereNotNull('theme')
            ->get()
            ->groupBy('theme')
            ->filter(fn ($group) => $group->count() >= 2)
            ->each(function ($articles, $theme) {
                $synthesis = (new ThemeSynthesizerAgent())->prompt(
                    $articles->pluck('summary')->implode("\n\n")
                );

                WeeklyDigest::create([
                    'week_start' => now()->startOfWeek(),
                    'theme' => $theme,
                    'summary' => $synthesis->text,
                    'raw_article_ids' => $articles->pluck('id'),
                ]);

                $articles->each->update(['digested_at' => now()]);
            });
    }
}
