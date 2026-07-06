<?php

namespace Tests\Feature\Console;

use App\Jobs\AnalyzeAndGroupArticlesJob;
use App\Jobs\FetchArticlesJob;
use App\Jobs\GenerateSeoArticleJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Process;
use Tests\TestCase;

class WeeklyBlogPipelineTest extends TestCase
{
    public function testDispatchesThePipelineChainAndStartsTheDiscordBotInTheBackground(): void
    {
        Bus::fake();
        Process::fake();

        $this->artisan('blog:generate-pipeline')->assertExitCode(0);

        Bus::assertChained([
            FetchArticlesJob::class,
            AnalyzeAndGroupArticlesJob::class,
            GenerateSeoArticleJob::class,
        ]);

        Process::assertRan(fn ($process) => $process->command === [PHP_BINARY, 'artisan', 'discord:serve']);
    }
}
