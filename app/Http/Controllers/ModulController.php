<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Modul;


class ModulController extends Controller
{
    //
     use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list() 
    { 
      $moduls = Modul::all();
      $professors = Professor::all();

      return view('modul.list', ['moduls' => $moduls , 'professors' => $professors ,'selectedProfessor' => null]);
    }

    public function cercaProfessor(Request $request)
   {
    $profe = $request->input('filtrarPerProfessor');

    if ($profe) {
        // Filtrar por profesor
        $moduls = Modul::cercaProfessor($profe);
    } else {
        // Mostrar todos
        $moduls = Modul::all();
    }

    $professors = Professor::all();

    return view('modul.list', [ 'moduls' => $moduls, 'professors' => $professors ,'selectedProfessor' => $profe ]);
    }

    public function new(Request $request)
{


    // Si venimos del formulario (POST)
    if ($request->isMethod('post')) {

        $modul = new Modul;
        $request->validate([
        'nom' => 'required',
        'hores' => 'required|integer|min:1',
        ],[
        'nom.required' => 'El nom és obligatori!',
        'hores.required' => 'Les hores són obligatòries!',
        'hores.integer' => 'Les hores han de ser un número enter!',
        'hores.min' => 'Les hores no poden ser menys de 1!',
        ]);

        $modul->nom = $request->nom;
        $modul->hores = $request->hores;
        $modul->professor_id = $request->professor_id;  
        $modul->save();

        return redirect()->route('modul_list') ->with('status', 'Nou modul '.$modul->nom.' creat!');
    }

     // si no venim de fer submit al formulari, hem de mostrar el formulari
    $professors = Professor::all();

    return view('modul.new', ['professors' => $professors]);
}
function edit ($id, Request $request){

 
      if ($request->isMethod('post')) {    
        

        $modul = Modul::find($id);
          $request->validate([
        'nom' => 'required',
        'hores' => 'required|integer|min:1',
        ],[
        'nom.required' => 'El nom és obligatori!',
        'hores.required' => 'Les hores són obligatòries!',
        'hores.integer' => 'Les hores han de ser un número enter!',
        'hores.min' => 'Les hores no poden ser menys de 1!',
        ]);
        $modul->nom = $request->nom;
        $modul->hores = $request->hores;
        $modul->professor_id = $request->professor_id;
        $modul->save();

        return redirect()->route('modul_list')->with('status', 'Modul '.$modul->nom.' editat!');      }
        
        $modul = Modul::find($id);
        $professors = Professor::all();

        return view('modul.edit', ['modul' => $modul, 'professors' => $professors]);    


    }

    function delete($id) 
    { 

   
      $modul = Modul::find($id);
      $modul->delete();

      return redirect()->route('modul_list')->with('status', 'Modul '.$modul->nom.' eliminat!');
    }


}
