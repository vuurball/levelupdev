<?php

namespace App\Classes;

use App\Helpers\ScraperInterface;
use App\Classes\Scraper;

class ScrapeDrushim implements ScraperInterface
{

    protected $key = "drushim";
    protected $firstUrl = 'https://www.drushim.co.il/jobs/cat6/';

    public function scrape()
    {

        $counter = 0;
        $continue = true;   // Assigning a boolean value of TRUE to the $continue variable
        $url = $this->firstUrl;
        while ($continue == true)
        {
            echo "<h3>SCRAPING: " . $url . "</h3>";

            $page_full_html = Scraper::curl($url); //get page

            $page_posts_html = Scraper::scrapeBetween($page_full_html, "<div id=\"MainContent_JobList_jobList\"", "value=\"MainContent_JobList\""); // get all posts part of the page

            $page_posts_html_array = explode("<div class=\"jobContainer\">", $page_posts_html);   // Exploding the results into separate posts into an array
            // For each separate result, scrape the URL
            array_shift($page_posts_html_array); //first element doesn't contain a real post

            foreach ($page_posts_html_array as $post_html)
            {
                if ($post_html != "")
                {
                    $postKey = Scraper::scrapeBetween($post_html, "<div id=\"jobItem", "\"");

                    $res = Scraper::findKey($this->key, $postKey);
                    if (empty($res))
                    {
                        Scraper::processPost($post_html);
                        Scraper::saveKey($this->key, $postKey);
                    }
                }
            }

            // Searching for a 'Next' link. If it exists scrape the url and set it as $url for the next loop of the scraper
            if (strpos($page_posts_html, "class=\"pager lightBg stdButton\""))
            {
                $continue = true;
                $url = Scraper::scrapeBetween($page_posts_html, "<span class=\"pager stdButton darkBg\"", "class=\"pager stdButton lightBg\"");
                $url = Scraper::scrapeBetween($url, "href=\"", "\"");
            } else
            {
                echo "next page not found";
                $continue = false;  // Setting $continue to FALSE if there's no 'Next' link
            }
//            if (++$counter == 50)
//            {
//                $continue = false;
//            }
        }
        return "scrapping drushim";
    }

}
