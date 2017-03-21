<?php

namespace App\Classes;

use App\Helpers\ScraperInterface;
use App\Classes\Scraper;
use Illuminate\Support\Facades\Redis;

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
            echo "<h2>SCRAPING: " . $url . "</h2>";

            $page_full_html = Scraper::curl($url); //get page
            $page_posts_html = Scraper::scrapeBetween($page_full_html, "<div id=\"MainContent_JobList_jobList\"", "value=\"MainContent_JobList\""); // get all posts part of the page

            $page_posts_html_array = explode("<div class=\"jobContainer\">", $page_posts_html);   // Exploding the results into separate posts into an array
            // For each separate result, scrape the URL
            array_shift($page_posts_html_array); //first element doesn't contain a real post

            foreach ($page_posts_html_array as $post_html)
            {
                if ($post_html != "")
                {
                    $postKey = Scraper::scrapeBetween($post_html, "<div id=\"", "\"");
                    if (Redis::sismember($this->key, $postKey) === 0)
                    {
                        $postContentHtml = Scraper::scrapeBetween($post_html, "<div class=\"jobFields\">", "<div class=\"jobFooter rtl\">"); // get the post content 
                        Scraper::processPost($postContentHtml);
                        Redis::sadd($this->key, $postKey);
                    }
                    Redis::sismember($this->key, $postKey);
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
            // sleep(rand(3, 5));   // Sleep for 3 to 5 seconds. Useful if not using proxies. We don't want to get into trouble.

            if (++$counter == 10)
            {
                $continue = false;
            }
        }
        return "scrapping drushim";
    }

}
