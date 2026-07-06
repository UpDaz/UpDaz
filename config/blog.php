<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Discord Editorial Channel
    |--------------------------------------------------------------------------
    |
    | The Discord channel ID where the editorial team is notified when the
    | AI agent has generated a new article draft ready for review.
    |
    */

    'discord_channel_id' => env('BLOG_DISCORD_CHANNEL_ID'),

    /*
    |--------------------------------------------------------------------------
    | Fetch Volume Cap
    |--------------------------------------------------------------------------
    |
    | Maximum number of new articles FetchArticlesJob will pull per source
    | on each run. Null means no limit. Useful locally to keep the volume
    | fed into the AI pipeline small (and within free-tier quotas).
    |
    */

    'max_articles_per_source' => filled(env('BLOG_MAX_ARTICLES_PER_SOURCE'))
        ? (int) env('BLOG_MAX_ARTICLES_PER_SOURCE')
        : null,

    /*
    |--------------------------------------------------------------------------
    | Articles Generated Per Run
    |--------------------------------------------------------------------------
    |
    | AnalyzeAndGroupArticlesJob groups raw articles into one WeeklyDigest
    | per eligible theme, and GenerateSeoArticleJob turns every digest
    | without a post into an article — so left uncapped, one pipeline run
    | can produce as many articles as there are eligible themes that week.
    | This keeps only the N richest themes (most raw articles) per run.
    |
    */

    'max_articles_per_run' => (int) env('BLOG_MAX_ARTICLES_PER_RUN', 1),

];
