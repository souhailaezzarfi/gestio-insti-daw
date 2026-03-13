<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Grup;



class GrupController extends Controller
{
   use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list() 
    { 
      $grups = Grup::all();

      return view('grup.list', ['grups' => $grups ]);
    }

    public function new(Request $request)
{
   
    // Si venimos del formulario (POST)
    if ($request->isMethod('post')) {

        $grup = new Grup;
        $grup->nom = $request->nom;
        $grup->aula = $request->aula;
        $grup->professor_id = $request->professor_id;  
        $grup->save();

        return redirect()->route('grup_list') ->with('status', 'Nou grup '.$grup->nom.' creat!');
    }

     // si no venim de fer submit al formulari, hem de mostrar el formulari
    $professors = Professor::all();

    return view('grup.new', ['professors' => $professors]);
}

 function edit ($id, Request $request){
 
      if ($request->isMethod('post')) {    
        

        $grup = Grup::find($id);
        $grup->nom = $request->nom;
        $grup->aula = $request->aula;
        $grup->professor_id = $request->professor_id;
        $grup->save();

        return redirect()->route('grup_list')->with('status', 'Grup '.$grup->nom.' editat!');      }
        
        $grup = Grup::find($id);
        $professors = Professor::all();

        return view('grup.edit', ['grup' => $grup, 'professors' => $professors]);    


    }

    function delete($id) 
    { 

    
      $grup = Grup::find($id);
      $grup->delete();

      return redirect()->route('grup_list')->with('status', 'Grup '.$grup->nom.' eliminat!');
    }



}
