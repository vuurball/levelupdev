<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';

use GraphAware\Neo4j\Client\ClientBuilder;

processNewInformation();

function processNewInformation()
{
    $continue = true;   // Assigning a boolean value of TRUE to the $continue variable
    $url = "https://www.drushim.co.il/jobs/cat6/";    // Assigning the URL we want to scrape to the variable $url
    $counter = 0;
    while ($continue == true)
    {
        $counter++;
        if ($counter == 4)
            return;
        $continue = false;
        echo "<h2>SCRAPING: " . $url . "</h2>";
        $page_full_html = curl($url); //get page

        $page_posts_html = scrapeBetween($page_full_html, "<div id=\"MainContent_JobList_jobList\"", "value=\"MainContent_JobList\""); // get all posts part of the page
        $page_posts_html_array = explode("<div class=\"jobContainer\">", $page_posts_html);   // Exploding the results into separate posts into an array
        // For each separate result, scrape the URL

        foreach ($page_posts_html_array as $post_html)
        {
            if ($post_html != "")
            {
                $postContentHtml = scrapeBetween($post_html, "<div class=\"jobFields\">", "<div class=\"jobFooter rtl\">"); // get the post content
                processPost($postContentHtml);
            }
        }

        // Searching for a 'Next' link. If it exists scrape the url and set it as $url for the next loop of the scraper
        if (strpos($page_posts_html, "class=\"pager lightBg stdButton\""))
        {
            $continue = true;
            $url = scrapeBetween($page_posts_html, "<span class=\"pager stdButton darkBg\"", "class=\"pager stdButton lightBg\"");
            $url = scrapeBetween($url, "href=\"", "\"");
        } else
        {
            echo "next page not found";
            $continue = false;  // Setting $continue to FALSE if there's no 'Next' link
        }
        sleep(rand(3, 5));   // Sleep for 3 to 5 seconds. Useful if not using proxies. We don't want to get into trouble.
    }
}

function processPost($postHtml)
{
    echo "<h3>NEW POST<h3>";
    $skills = getAllSkillsArray();
    $foundSkills = [];
    foreach ($skills as $skill)
    {
        $res = strpos(strtolower($postHtml), $skill);
        if ($res !== false)
        {
            echo "found " . $skill . "<br>";
            $foundSkills[] = $skill;
        }
    }

    while (!empty($foundSkills))
    {
        $node1 = array_pop($foundSkills);
        foreach ($foundSkills as $node2)
        {

            echo $node1 . " - " . $node2 . "<br>";
            $query = "MATCH (A:Skill {name:'" . $node1 . "'})
                      MATCH (B:Skill {name:'" . $node2 . "'})
                      MERGE (A)-[r:ALSO]-(B)
                            ON CREATE SET r.weight = 1
                            ON MATCH  SET r.weight = r.weight+1
                      RETURN r.weight";
            Neo::con()->run($query);
        }
    }
}

function curl($url)
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

function scrapeBetween($data, $start, $end)
{
    $data = stristr($data, $start); // Stripping all data from before $start
    $data = substr($data, strlen($start));  // Stripping $start
    $stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
    $data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
    return $data;   // Returning the scraped data from the function
}

function getAllSkillsArray()
{
    return [
        "php",
        "mysql",
        "linux",
        "ruby",
        "python",
        // " c",
        " c#",
        " c++",
        "http",
        "rdp",
        "ssh",
        "SAML", //protocol
        "Oath", //protocol
        "openId", //protocol
        "kerberos", //protocol
        "ntlm", //protocol
        "unix",
        "asp", //asp.net
        ".net", //asp.net
        "apache",
        "css3",
        "html5",
        "javascript",
        "mvc",
        "angular",
        "angularjs",
        "bootstrap",
        "knockout",
        "node", //nodejs
        "node.js",
        "nodejs",
        "react",
        "wcf",
        "nosql", // no sql
        "redis",
        "mongodb", //mongo
        "typescrypt",
        "sql",
        "jquery",
        "aws",
        "big data",
        "ruby on rails",
        "android",
        "ios",
        "bash",
        "python",
        "perl",
        "cshell",
        "tcp",
        "matlab",
        "ionic",
        "jira",
        "ajax",
        "wpf",
        "vb6",
        "oracle",
        "sql server",
        "responsive design",
        "magento",
        "android native",
        "svn",
        "git",
        "hibernate",
        "spring",
        "iot",
        "java",
        "nlp", //natural language processing
        "ml", //machine learning
        "machine learning",
            //"ai",
    ];
}

class Neo
{

    protected static $connection = null;

    public static function con()
    {
        if (!self::$connection)
        {
            self::$connection = ClientBuilder::create()
                    ->addConnection('bolt', 'bolt://neo4j:p!ram1da@10.0.8.214:7687')
                    ->build();
        }
        return self::$connection;
    }

}

