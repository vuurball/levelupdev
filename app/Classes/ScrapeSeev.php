<?php

namespace App\Classes;

use App\Helpers\ScraperInterface;
use App\Classes\Scraper;
use Illuminate\Support\Facades\Redis;

class ScrapeSeev implements ScraperInterface
{

    protected $key = "seev";
    protected $firstUrl = 'http://www.seev.co.il/jobs/0-0-0/%D7%9B%D7%9C-%D7%94%D7%AA%D7%97%D7%95%D7%9E%D7%99%D7%9D/%D7%9B%D7%9C-%D7%94%D7%AA%D7%A4%D7%A7%D7%99%D7%93%D7%99%D7%9D/%D7%9B%D7%9C-%D7%94%D7%90%D7%96%D7%95%D7%A8%D7%99%D7%9D?page=';

    public function scrape()
    {
        $counter = 0;
        $continue = true;   // Assigning a boolean value of TRUE to the $continue variable
        $page = 1;
        $url = $this->firstUrl . $page;
        while ($continue == true)
        {
            echo "<h3>SCRAPING: " . $url . "</h3>";

            $page_full_html = Scraper::curl($url); //get page
            //if page has no jobs, then then stop scraping
            if (strpos($page_full_html, "<div class=\"job row"))
            {
                $continue = true;
                $url = $this->firstUrl . "" . ++$page;
            } else
            {
                echo "next page not found";
                $continue = false;  // Setting $continue to FALSE if there's no 'Next' link
            }

            $page_posts_html_array = explode("class=\"job row\"", $page_full_html);   // Exploding the results into separate posts into an array
            // For each separate result, scrape the URL
            array_shift($page_posts_html_array); //first element doesn't contain a real post

            foreach ($page_posts_html_array as $postContentHtml)
            {
                if ($postContentHtml != "")
                {
                    $postKey = Scraper::scrapeBetween($postContentHtml, "data-id=\"", "\"");
                    // echo $postKey . "<br>";
                    if (Redis::sismember($this->key, $postKey) === 0)
                    {
                        $postIsRelevant = Scraper::processPost($postContentHtml);
                        Redis::sadd($this->key, $postKey);
                        if ($postIsRelevant)
                        {
                            Redis::hset('latest', date('dhis'), $postContentHtml . ' <br><br>source: ' . $url); //add new post to latest hash
                        }
                    }
                    Redis::sismember($this->key, $postKey);
                }
            }

            // sleep(rand(3, 5));   // Sleep for 3 to 5 seconds. Useful if not using proxies. We don't want to get into trouble.
//            if (++$counter == 2)
//            {
//                $continue = false;
//            }
        }
        return "scrapping seev";
    }

}
