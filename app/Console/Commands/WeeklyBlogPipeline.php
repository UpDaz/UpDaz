<?php

namespace App\Console\Commands;

use App\Jobs\AnalyzeAndGroupArticlesJob;
use App\Jobs\FetchArticlesJob;
use App\Jobs\GenerateSeoArticleJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Process;
use Throwable;

class WeeklyBlogPipeline extends Command
{
    protected $signature = 'blog:generate-pipeline';

    public function handle(): void
    {
        $this->startDiscordBot();

        notice('[WeeklyBlogPipeline] Dispatch de la chaîne FetchArticlesJob -> AnalyzeAndGroupArticlesJob -> GenerateSeoArticleJob');

        Bus::chain([
            new FetchArticlesJob(),
            new AnalyzeAndGroupArticlesJob(),
            new GenerateSeoArticleJob(),
        ])
            ->onQueue('ai-pipeline')
            ->catch(function (Throwable $e) {
                error('[WeeklyBlogPipeline] La chaîne a échoué', ['error' => $e->getMessage()]);
            })
            ->dispatch();
    }

    /**
     * Starts `discord:serve` in the background so the bot is already
     * listening by the time the editorial team gets the review
     * notification. The command guards itself against running twice
     * (see `DiscordBotServe::LOCK_KEY`), so it's safe to call this even
     * if a previous, still-unreviewed draft already has one running.
     */
    private function startDiscordBot(): void
    {
        notice('[WeeklyBlogPipeline] Démarrage de discord:serve en arrière-plan');

        Process::path(base_path())->start([PHP_BINARY, 'artisan', 'discord:serve']);
    }
}
