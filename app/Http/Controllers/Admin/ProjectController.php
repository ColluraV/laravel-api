<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStoreRequest;
use App\Models\Project;
use App\Models\Tecnology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{


    public function index()
    {

        $projects = Project::all();

        return view("admin.projects.index", compact("projects"));
        /*con compact creo un array di oggetti "project" 
                e vengono associati i valori degli oggetti del db*/
    }

    public function show($id)
    {
        /*seleziono ilo singolo elemento nel db tramite il suo id
         o restituisco errore 404*/
        $project = Project::findOrFail($id);
        dump($project);
        return view("admin.projects.show", compact("project"));
    }


    /*reindirizzo al form di creazione */

    public function create()
    {
        $types=Type::all();             //richiamo type
        $tecnologies=Tecnology::all();    //richiamo tecnology
        
        return view("admin.projects.create",compact("types","tecnologies"));

    }


    /*invio i dati al db attraverso un istanza del model*/

    public function store(ProjectStoreRequest $request)
    {
        $data = $request->validated();

        $counter = 0;
        do {
            // genero uno slug univoco per poter recuperare un elemento senza scrivere l'id nell'url (finezza estetica)

            $slug = Str::slug($data["title"]) . ($counter > 0 ? "-" . $counter : "");

            // cerco se esiste già un elemento con questo slug
            $alreadyExists = Project::where("slug", $slug)->first();

            $counter++;
        } while ($alreadyExists); // finché esiste già un elemento con questo slug, ripeto il ciclo per creare uno slug nuovo

        $data["slug"] = $slug;


        /*carico il file del Public Storage nel $data*/
        $data["image"]= Storage::put("projects",$data["image"]);

        /*Per salvare l'immagine in un disco diverso da quello di default usiamo il
        metodo Storage::disk('nome') 
        
            $img_path = Storage::disk('public')->put('uploads', $data['image']);

        */

        $project = Project::create($data);/*il comando create esegue sia il fill che il save*/

        if (key_exists("tecnologies",$data)){
            $project->tecnologies()->attach($data["tecnologies"]);
        }//attach ha bisogno di un id per connettere la tabella ponte, 
         //dunque va creata dopo il save

        return redirect()->route("admin.projects.show", $project->id);

    }


    /* richiamo il progetto dal database e ne modifico i valori nella pagina edit */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $types=Type::all();
        $tecnologies=Tecnology::all();
        return view("admin.projects.edit", ["project" => $project],compact('types','tecnologies'));
    }


    /* aggiorno il progetto dal database e reindirizzo a show */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);
        $data = $request->all();

        /*controllo se esiste una immagine e la elimino dallo storage prima di sostituirla */
        if (isset($data["image"])){
            Storage::delete($project->image);
        };

        $data["image"]= Storage::put("projects",$data["image"]);

        $project->tecnologies()->sync($data["tecnologies"]);
        
        //in caso di update si eliminano prima i dati vecchi e in seguito si aggiungono i nuovi anche se sono uguali
        //$project->tecnologies()->detach($data["tecnologies"]);
        //$project->tecnologies()->attach($data["tecnologies"]);
        //con sync sincronizzo tecnologies aggiornandp i dati inm caso di differenze

        $project->update($data);

        return redirect()->route('admin.projects.show', $project->id);
    }


    /* elimino il progetto dal database e reindirizzo a index */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->image) {
            Storage::delete($project->image);
        }

        //prima di eliminare un project cancelliamo il suo collegamento
        $project->tecnologies()->detach();
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
