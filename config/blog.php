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

];
