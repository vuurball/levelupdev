<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\NeoDB;
use App\Classes\Skills;

class StatsController extends Controller
{

    public function index(String $skill = null)
    {
        $skillsArr = Skills::getAllSkillKeys();
        $relatedSkills = [];
        $totalWeight = 0;
        if ($skill != null)
        {
            //get related
            $query = "MATCH (s:Skill {name:'" . $skill . "'})-[r:ALSO]-(s2:Skill) 
                      RETURN s2.name as skillname, s.counter as skillcounter, r.weight as skillweight
                      ORDER BY r.weight DESC";

            $results = NeoDB::con()->run($query);
            $relatedSkills = $results->records();
        }


        return view('stats.index', [
            'skillsArr' => $skillsArr,
            'selectedSkill' => $skill,
            'relatedSkills' => $relatedSkills,
            'totalPosts' => reset($relatedSkills)->get('skillcounter')
                ]
        );
    }

}
