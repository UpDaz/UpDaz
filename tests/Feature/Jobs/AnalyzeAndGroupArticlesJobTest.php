<?php

namespace Tests\Feature\Jobs;

use App\Jobs\AnalyzeAndGroupArticlesJob;
use App\Models\RawArticle;
use App\Models\Source;
use App\Models\WeeklyDigest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Prism\Prism\Enums\FinishReason;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Structured\Response as StructuredResponse;
use Prism\Prism\Text\Response as TextResponse;
use Prism\Prism\ValueObjects\Meta;
use Prism\Prism\ValueObjects\Usage;
use Tests\TestCase;

class AnalyzeAndGroupArticlesJobTest extends TestCase
{
    use RefreshDatabase;

    private function fakeAnalysis(string $theme, string $summary): StructuredResponse
    {
        return new StructuredResponse(
            steps: new Collection(),
            text: '',
            structured: [
                'theme' => $theme,
                'summary' => $summary,
                'keywords' => ['ia', 'llm', 'agent'],
            ],
            finishReason: FinishReason::Stop,
            usage: new Usage(10, 10),
            meta: new Meta('fake', 'claude-sonnet-5'),
        );
    }

    private function fakeSynthesis(string $text): TextResponse
    {
        return new TextResponse(
            steps: new Collection(),
            text: $text,
            finishReason: FinishReason::Stop,
            toolCalls: [],
            toolResults: [],
            usage: new Usage(10, 10),
            meta: new Meta('fake', 'claude-sonnet-5'),
            messages: new Collection(),
        );
    }

    public function testAnalyzesUnanalyzedRawArticles(): void
    {
        Prism::fake([
            $this->fakeAnalysis('IA générative', 'Résumé 1.'),
        ]);

        $article = RawArticle::factory()->for(Source::factory())->create([
            'analyzed_at' => null,
        ]);

        (new AnalyzeAndGroupArticlesJob())->handle();

        $article->refresh();

        $this->assertSame('IA générative', $article->theme);
        $this->assertSame('Résumé 1.', $article->summary);
        $this->assertSame(['ia', 'llm', 'agent'], $article->keywords);
        $this->assertNotNull($article->analyzed_at);
    }

    public function testGroupsAnalyzedArticlesIntoADigestWhenThemeHasEnoughMatter(): void
    {
        Prism::fake([
            $this->fakeSynthesis('Synthèse commune sur l\'IA générative.'),
        ]);

        $source = Source::factory()->create();
        $articles = RawArticle::factory()->for($source)->count(2)->create([
            'theme' => 'IA générative',
            'summary' => 'Résumé.',
            'analyzed_at' => now(),
            'digested_at' => null,
        ]);

        (new AnalyzeAndGroupArticlesJob())->handle();

        $this->assertDatabaseCount(WeeklyDigest::class, 1);

        $digest = WeeklyDigest::first();

        $this->assertSame('IA générative', $digest->theme);
        $this->assertSame('Synthèse commune sur l\'IA générative.', $digest->summary);
        $this->assertEqualsCanonicalizing($articles->pluck('id')->all(), $digest->raw_article_ids);

        $articles->each(function (RawArticle $article) {
            $this->assertNotNull($article->refresh()->digested_at);
        });
    }

    public function testDoesNotGroupAThemeWithOnlyOneArticle(): void
    {
        RawArticle::factory()->for(Source::factory())->create([
            'theme' => 'DevOps',
            'summary' => 'Résumé.',
            'analyzed_at' => now(),
            'digested_at' => null,
        ]);

        (new AnalyzeAndGroupArticlesJob())->handle();

        $this->assertDatabaseCount(WeeklyDigest::class, 0);
    }
}
