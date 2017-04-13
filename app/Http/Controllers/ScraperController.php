<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Scraper;

class ScraperController extends Controller
{

    /**
     * scrape all sites
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


}
