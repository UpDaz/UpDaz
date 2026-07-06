<?php

namespace Tests\Feature\Console;

use App\Jobs\AnalyzeAndGroupArticlesJob;
use App\Jobs\FetchArticlesJob;
use App\Jobs\GenerateSeoArticleJob;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class WeeklyBlogPipelineTest extends TestCase
{
    public function testDispatchesThePipelineChain(): void
    {
        Bus::fake();

        $this->artisan('blog:generate-pipeline')->assertExitCode(0);

        Bus::assertChained([
            FetchArticlesJob::class,
            AnalyzeAndGroupArticlesJob::class,
            GenerateSeoArticleJob::class,
        ]);
    }
}
