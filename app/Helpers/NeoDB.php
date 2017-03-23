<?php

namespace App\Helpers;

use GraphAware\Neo4j\Client\ClientBuilder;
use App\Classes\Skills;

class NeoDB
{

    protected static $connection = null;

    public static function con()
    {
        if (!self::$connection)
        {
            self::$connection = ClientBuilder::create()
                    ->addConnection('bolt', 'bolt://' . env('NEO_USER') . ':' . env('NEO_PASSWORD') . '@' . env('NEO_HOST'))
                    ->build();
        }
        return self::$connection;
    }

    /**
     * connect 2 skill-nodes, or update the weight on an existing relationship
     * @param string $skillName1
     * @param string $skillName2
     */
    public static function connectSkills($skillName1, $skillName2)
    {
        $query = "MATCH (A:Skill {name:'" . trim($skillName1) . "'})
                  MATCH (B:Skill {name:'" . trim($skillName2) . "'})
                  MERGE (A)-[r:ALSO]-(B)
                    ON CREATE SET r.weight = 1
                    ON MATCH  SET r.weight = r.weight+1
                  RETURN r.weight";
        NeoDB::con()->run($query);
    }

    public static function incSkillCount($skills)
    {

        if (!empty($skills))
        {
            //because fml why would implode work?
            $skillsStr = '';
            foreach ($skills as $skill)
            {
                $skillsStr .= "','" . $skill;
            }

            $query = "MATCH (s:Skill) WHERE s.name IN ['" . substr($skillsStr, 3) . "']
                  WITH (CASE WHEN s.counter IS NULL THEN 0 ELSE s.counter END) AS current, s
                  SET s.counter = current+1 
                  RETURN s";

            NeoDB::con()->run($query);
        }
    }

    /**
     * insert all skills into the db
     */
    public static function initialSeedDB()
    {
        $skills = Skills::getAllSkillKeys();
        $query = "";
        $count = 0;
        foreach ($skills as $skill)
        {
            $query .= "CREATE (s" . $count++ . ":Skill {name:'" . $skill . "', type:'language'}) ";
        }
        if ($query != '')
        {
            NeoDB::con()->run($query);
        }
    }

    /**
     * delete all skill nodes and relationships (reset)
     */
    public static function emptyDB()
    {
        $query = "MATCH (n:Skill) DETACH DELETE n";
        NeoDB::con()->run($query);
    }

}
