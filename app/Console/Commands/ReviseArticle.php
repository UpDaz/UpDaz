<?php

namespace App\Console\Commands;

use App\Jobs\ReviseSeoArticleJob;
use App\Models\Article;
use Illuminate\Console\Command;

class ReviseArticle extends Command
{
    protected $signature = 'articles:revise {article} {feedback}';

    protected $description = 'Revises a single article in a dedicated process, so the (slow, blocking) AI call never freezes the Discord bot\'s event loop.';

    public function handle(): int
    {
        $article = Article::find($this->argument('article'));

        if (! $article) {
            $this->error("Article #{$this->argument('article')} introuvable.");

            return self::FAILURE;
        }

        (new ReviseSeoArticleJob($article, $this->argument('feedback')))->handle();

        return self::SUCCESS;
    }
}
