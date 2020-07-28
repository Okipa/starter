<?php

namespace App\Console\Commands\Seo;

use App\Console\Commands\CommandAbstract;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends CommandAbstract
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

    public function handle(): void
    {
        $this->log('Started sitemap automated generation...', 'title');
        SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));
        $this->log('Finished sitemap automated generation.', 'success');
    }
}
