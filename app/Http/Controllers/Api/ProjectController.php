<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {

        //recupero dati dal server attraverso istanza classe model
        //insieme alle variabili e ne mostro 5 per volta
        $projectsData = Project::with(["project", "type", "tecnologies"])->paginate(5);
       
        return response()->json($projectsData);
        //rimando un json dei dati recuperati
    }
}
