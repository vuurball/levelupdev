<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Scraper;
use App\Helpers\NeoDB;

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
                return $scraper->scrape();
            }
        }
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
    }

}
