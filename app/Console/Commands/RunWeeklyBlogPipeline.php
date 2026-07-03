<?php

namespace App\Console\Commands;

use App\Jobs\AnalyzeAndGroupArticlesJob;
use App\Jobs\GenerateSeoArticleJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class RunWeeklyBlogPipeline extends Command
{
    protected $signature = 'blog:weekly-pipeline';

    public function handle(): void
    {
        Bus::chain([
            new FetchArticlesJob(),
            new AnalyzeAndGroupArticlesJob(),
            new GenerateSeoArticleJob(),
        ])->onQueue('ai-pipeline')->dispatch();
    }
}
