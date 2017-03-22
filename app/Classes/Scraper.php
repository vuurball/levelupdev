<?php

namespace App\Classes;

use App\Helpers\NeoDB;
use App\Classes\Skills;

class Scraper
{

    const DATA_SOURCES = ['drushim'];

    /**
     * returns a class object of a scraper for a specific site
     */
    public static function getSiteScraper(String $dataSourceName)
    {
        $classPath = 'App\\Classes\\Scrape' . ucfirst($dataSourceName);
        if (class_exists($classPath))
        {
            return new $classPath();
        }

        return null;
    }

    public static function scrapeBetween($data, $start, $end)
    {
        $data = stristr($data, $start); // Stripping all data from before $start
        $data = substr($data, strlen($start));  // Stripping $start
        $stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
        $data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
        return $data;   // Returning the scraped data from the function
    }

    /**
     * gets a page html
     */
    public static function curl($url)
    {
        // Assigning cURL options to an array
        $options = Array(
            CURLOPT_RETURNTRANSFER => TRUE, // Setting cURL's option to return the webpage data
            CURLOPT_FOLLOWLOCATION => TRUE, // Setting cURL to follow 'location' HTTP headers
            CURLOPT_AUTOREFERER => TRUE, // Automatically set the referer where following 'location' HTTP headers
            CURLOPT_CONNECTTIMEOUT => 120, // Setting the amount of time (in seconds) before the request times out
            CURLOPT_TIMEOUT => 120, // Setting the maximum amount of time for cURL to execute queries
            CURLOPT_MAXREDIRS => 10, // Setting the maximum number of redirections to follow
            CURLOPT_USERAGENT => "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8", // Setting the useragent
            CURLOPT_URL => $url, // Setting cURL's URL option with the $url variable passed into the function
        );

        $ch = curl_init();  // Initialising cURL 
        curl_setopt_array($ch, $options);   // Setting cURL's options using the previously assigned array data in $options
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch);    // Closing cURL 
        return $data;   // Returning the data from the function 
    }

    public static function processPost($postHtml)
    {
        echo "processed new post <br>";
        $skills = Skills::getAllSkillNames();
        $foundSkills = [];
        $relevantPost = false;
        foreach ($skills as $skill)
        {
            $res = strpos(strtolower($postHtml), $skill);
            if ($res !== false)
            {
                //echo "found " . $skill . "<br>";
                $foundSkills[] = $skill;

                if ($skill == 'php')
                {
                    $relevantPost = true;
                    echo "<hr>" . $postHtml . "<hr>"; //show me new relevant post
                }
            }
        }

        $skillsToConnect = [];

        foreach ($foundSkills as $foundSkill)
        {
            $skillKey = Skills::getSkillKey($foundSkill);
            // echo "skill: " . $foundSkill . "-" . $skillKey . "<br>";
            $skillsToConnect[$skillKey] = $skillKey;
        }

        while (!empty($skillsToConnect))
        {
            $skillName1 = array_pop($skillsToConnect);
            foreach ($skillsToConnect as $skillName2)
            {
                //   echo $skillName1 . " - " . $skillName2 . "<br>";
                NeoDB::connectSkills($skillName1, $skillName2);
            }
        }
        return $relevantPost;
    }

}
