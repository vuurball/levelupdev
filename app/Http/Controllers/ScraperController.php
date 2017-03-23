<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Scraper;
use App\Helpers\NeoDB;
use Illuminate\Support\Facades\Redis;

class ScraperController extends Controller
{

    /**
     * scrape all sites
     * @return type
     */
    public function scrapeMain()
    {
        foreach (Scraper::DATA_SOURCES as $dataSourceName)
        {
            $scraper = Scraper::getSiteScraper($dataSourceName);
            if ($scraper != null)
            {
                $scraper->scrape();
            }
        }
    }

    public function showLatest()
    {
        $latest = Redis::hgetall('latest');

        return view('stats.latest', ['latest' => $latest]);
    }

    public function seed()
    {
        NeoDB::initialSeedDB();
    }

    public function emptyDB()
    {
        NeoDB::emptyDB();
        //clear cache
        foreach (Scraper::DATA_SOURCES as $dataSourceName)
        {
            Redis::del($dataSourceName);
        }
        Redis::del('llatest');
        Redis::del('postsCounter');
    }

}
