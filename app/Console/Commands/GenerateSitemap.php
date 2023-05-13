<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\SitemapGenerator;
use App\Models\Record;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Generate an XML Sitemap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $postsitmap = Sitemap::create();
        // Record::get()->each(function (Record $record) use ($postsitmap) {
        //     $postsitmap->add(
        //         Url::create("/post/{$record->id}")
        //             ->setPriority(0.9)
        //             ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
        //     );
        // });
        // $postsitmap->writeToFile(public_path('sitemap.xml'));

        SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));
    
    }
}
