<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Professor;
use Illuminate\Support\Facades\File;



class ProfessorController extends Controller
{
 use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list() 
    { 
      $professors = Professor::all();

      return view('professor.list', ['professors' => $professors ,'camp' => 'nom', 'direccio' => 'asc']);
    }
    

function ordenarProfessor (Request $request){
      $camp = $request->input('ordenarPer');
      $direccio = $request->input('direccio');
   
      $professors = Professor::ordenar($camp , $direccio);
     
      return view('professor.list', ['professors' => $professors, 'camp' => $camp, 'direccio' => $direccio]);
    }
    function new(Request $request) 
    { 

      if ($request->isMethod('post')) {    
        // recollim els camps del formulari en un objecte professor

        $professor = new Professor;
        $request->validate([
         'nom' => 'required',
         'cognoms' => 'required',
         'email' => 'required|email|unique:professors,email'
        ],[
        'nom.required' => 'El nom és obligatori!',
        'cognoms.required' => 'Els cognoms  són obligatoris!',
        'email.required' => "L'email és obligatori!", 
        'email.email' => "Has d'introduir un email vàlid!", 
        'email.unique' => "Aquest email ja està registrat!"
       ]);
        $professor->nom = $request->nom;
        $professor->cognoms = $request->cognoms;
        $professor->email = $request->email;
        if($request->file('foto')){
        $file = $request->file('foto');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path(env('RUTA_FOTOS')), $filename);
        $professor->foto = $filename;
      }
        $professor->save();

        return redirect()->route('professor_list')->with('status', 'Nou professor '.$professor->nom.' creat!');
      }
      return view('professor.new');
    }
        function edit ($id, Request $request){

       
      if ($request->isMethod('post')) {    
        

        $professor = Professor::find($id);
          $request->validate([
         'nom' => 'required',
         'cognoms' => 'required',
         'email' => 'required|email'
        ],[
        'nom.required' => 'El nom és obligatori!',
        'cognoms.required' => 'Els cognoms  són obligatoris!',
        'email.required' => "L'email és obligatori!", 
        'email.email' => "Has d'introduir un email vàlid!", 
       ]);
        $professor->nom = $request->nom;
        $professor->cognoms = $request->cognoms;
        $professor->email = $request->email;
       // Si el usuario sube una nueva foto
      if ($request->hasFile('foto')) {

    // Si ya había una foto, la borramos
       if ($professor->foto) {
        $path = public_path(env('RUTA_FOTOS') . '/' . $professor->foto);

        if (File::exists($path)) {
            File::delete($path);
        }
      }

    // Guardar la nueva foto
      $file = $request->file('foto');
      $filename = time() . '_' . $file->getClientOriginalName();
      $file->move(public_path(env('RUTA_FOTOS')), $filename);

    // Guardar el nombre en la BD
       $professor->foto = $filename;
}

        $professor->save();


        return redirect()->route('professor_list')->with('status', 'Professor '.$professor->nom.' editat!');      
    }
        
        
        $professor = Professor::find($id);

       return view('professor.edit',['professor' => $professor]);    


    }

    function delete($id) 
    { 

    
      $professor = Professor::find($id);
      $professor->delete();

      return redirect()->route('professor_list')->with('status', 'Professor '.$professor->nom.' eliminat!');
    }

 }   
