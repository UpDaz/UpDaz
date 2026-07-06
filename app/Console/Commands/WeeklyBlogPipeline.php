<?php

namespace App\Console\Commands;

use App\Jobs\AnalyzeAndGroupArticlesJob;
use App\Jobs\FetchArticlesJob;
use App\Jobs\GenerateSeoArticleJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Throwable;

class WeeklyBlogPipeline extends Command
{
    protected $signature = 'blog:generate-pipeline';

    public function handle(): void
    {
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
}
