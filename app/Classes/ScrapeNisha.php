<?php

namespace App\Classes;

use App\Helpers\ScraperInterface;
use App\Classes\Scraper;

class ScrapeNisha implements ScraperInterface
{

    protected $key = "nisha";
    protected $firstUrl = 'https://www.nisha.co.il/Niche/1?NicheID=1&catID=&area=&titles=&pagenum=';

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
            $page_posts_html = Scraper::scrapeBetween($page_full_html, "<h2 class=\"ico ico2\"", "<a class=\"send-btn sendCV"); // get all posts part of the page

            $page_posts_html_array = explode("<tr class=\"jobtr", $page_posts_html);   // Exploding the results into separate posts into an array
            // For each separate result, scrape the URL
            array_shift($page_posts_html_array); //first element doesn't contain a real post

            foreach ($page_posts_html_array as $post_html)
            {
                if ($post_html != "")
                {
                    $postKey = Scraper::scrapeBetween($post_html, "<label jobid=\"", "\"");
                    if($postKey != ""){
                        $res = Scraper::findKey($this->key, $postKey);
                        if (empty($res))
                        {
                            Scraper::processPost($post_html);
                            Scraper::saveKey($this->key, $postKey);
                        }
                    }
                }
            }
            // dd($page_posts_html);
            // Searching for a 'Next' link. If it exists scrape the url and set it as $url for the next loop of the scraper


            if (strpos($page_posts_html, "=" . ($page + 1) . "\" class"))
            {
                $continue = true;
                $url = $this->firstUrl . "" . ++$page;
            } else
            {
                echo "next page not found";
                $continue = false;  // Setting $continue to FALSE if there's no 'Next' link
            }
            // sleep(rand(3, 5));   // Sleep for 3 to 5 seconds. Useful if not using proxies. We don't want to get into trouble.
//            if (++$counter == 2)
//            {
//                $continue = false;
//            }
        }
        return "scrapping nisha";
    }

}
