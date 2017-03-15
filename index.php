<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require 'vendor/autoload.php';

use GraphAware\Neo4j\Client\ClientBuilder;

processPost();

function processPost()
{
    $skills = ["php", "mysql", "linux", "apache", "css3", "html5", "javascript"];

    $post = '
<div class="jobFields"><span class="sendCV"><a action="https://www.drushim.co.il/sendcv.aspx?jobcode=13223604" data-mode="List" jobcode="13223604" class="stdButton orangeBg roundCorners sendC$
';

    $foundSkills = [];
    foreach ($skills as $skill)
    {
        $res = strpos(strtolower($post), $skill);
        if ($res !== false)
        {
            echo "found " . $skill . "<br>";
            $foundSkills[] = $skill;
        }
    }

    echo "<br>";
    $neo4j = ClientBuilder::create()
            ->addConnection('bolt', 'bolt://neo4j:p!ram1da@10.0.8.214:7687')
            ->build();

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
            $result = $neo4j->run($query);
        }
    }
}

function neo()
{
    try {
        $neo4j = ClientBuilder::create()
                ->addConnection('bolt', 'bolt://neo4j:p!ram1da@10.0.8.214:7687')
                ->build();




        $params = ['limit' => 5];
        //$query = 'MATCH (m:Movie)<-[r:ACTED_IN]-(p:Person) RETURN m,r,p LIMIT {limit}';
        $query = "MATCH (n:Employee) RETURN n";
        $result = $neo4j->run($query, $params);
    } catch (Exception $e) {
        echo $e->getMessage();
    }


    echo "<pre>";
    foreach ($result->getRecords() as $record)
    {

        print_r($record->get('n')->value('name'));
        echo "<br><br>";
        // echo $record->value('id') . ' - ' .$record->value('name') ;
    }
    echo "</pre>";
}

echo 'loaded';

