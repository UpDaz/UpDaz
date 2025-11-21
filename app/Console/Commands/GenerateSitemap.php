<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        SitemapGenerator::create(config('app.url'))
            ->hasCrawled(function (Url $url) {
                if (substr($url->path(), -1, 1) == '/') {
                    return;
                }
                if ($url->segment(1) == 'articles') {
                    $url->setPriority(0.9);
                } elseif ($url->segment(1) == "mentions-legales") {
                    $url->setPriority(0.5);
                } else {
                    $url->setPriority(1);
                }
                $url->setChangeFrequency(URL::CHANGE_FREQUENCY_WEEKLY);
                return $url;
            })
            ->writeToFile(public_path('sitemap.xml'));
        $this->info('Sitemap file generated successfully !');
    }
}
