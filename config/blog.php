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
    | Topics Proposed Per Run
    |--------------------------------------------------------------------------
    |
    | AnalyzeAndGroupArticlesJob groups raw articles into one WeeklyDigest
    | per eligible theme, each proposed as a topic on Discord. Only the N
    | richest themes (most raw articles) are kept per run: the editor
    | picks the ones worth an interview, the others expire.
    |
    */

    'topics_per_run' => (int) env('BLOG_TOPICS_PER_RUN', 3),

];
