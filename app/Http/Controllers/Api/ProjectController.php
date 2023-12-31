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
        //insieme le variabili e ne mostro 5 per volta  $projectsData = Project::with(["project", "type", "tecnologies"])->paginate(5);
        $projectsData = Project::with("type","tecnologies")->paginate(6);
       
        return response()->json($projectsData);
        //rimando un json dei dati recuperati
    }
    
    
    public function show($slug) {
        $projectData = Project::where("slug", $slug)
            // recupera le informazioni delle relazioni
            ->with(["type", "tecnologies"])
            // ritorna il primo risultato
            ->first();

        return response()->json($projectData);
    }
}
