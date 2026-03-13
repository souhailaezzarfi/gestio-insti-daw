<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Alumne;
use App\Models\Modul;
use App\Models\Grup;



class AlumneController extends Controller
{
    //

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list() 
    { 
      $alumnes = Alumne::all();
      $grups = Grup::all();

      return view('alumne.list', ['alumnes' => $alumnes , 'grups' => $grups ,'selectedGrup' => null,'text'=>null , 'nota'=>null , 'operador' => null]);
    }

    public function filtrarAlumne(Request $request)
   {
    $text = $request->input('dniOcognoms');
    $grup = $request->input('filtrarPerGrup');
    $nota = $request->input('nota');
    $operador = $request->input('operador');

    switch ($operador) { 
        case 'and': $alumnes = Alumne::cercaAnd($text , $grup, $nota); 
        break; 
        case 'or': $alumnes = Alumne::cercaOr($text ,$grup, $nota); 
        break; 
    }
    $grups = Grup::all();
    return view('alumne.list', [ 'alumnes' => $alumnes , 'grups' => $grups ,'selectedGrup' => $grup ,'text'=>$text , 'nota'=>$nota , 'operador' => $operador]);
    }


    function new(Request $request) 
    {
        
      if ($request->isMethod('post')) {   
        // recollim els camps del formulari en un objecte alumne

        
         $request->validate([
         'nom' => 'required',
         'cognoms' => 'required',
         'dni' => 'required|unique:alumnes,dni',
         'data_naixement' => 'required|date|before:today',
         'email' => 'email|unique:alumnes,email'
        ],[
        'nom.required' => 'El nom és obligatori!',
        'cognoms.required' => 'Els cognoms  són obligatoris!',
        'dni.required' => "El DNI és obligatori!", 
        'dni.unique' => "Aquest DNI ja està registrat!",
        'data_naixement.required' => "La data de naixement és obligatòria!",
        'data_naixement.before' => "La data de naixement ha de ser anterior a avui!",
        'email.email' => "Has d'introduir un email vàlid!", 
        'email.unique' => "Aquest email ja està registrat!"

       ]);
       $alumne = DB::transaction(function() use ($request) {
        $alumne = new Alumne;
        $alumne->nom = $request->nom;
        $alumne->cognoms = $request->cognoms;
        $alumne->dni = $request->dni;
        $alumne->data_naixement = $request->data_naixement;
        $alumne->telefon = $request->telefon;
        $alumne->grup_id = $request->grup_id;
        $alumne->email = $request->email;

        $alumne->save();


        // Si el formulario tiene módulos seleccionados, construimos un array $dades
       // donde cada clave es el ID del módulo y el valor es la nota introducida.
       // Luego usamos attach() para guardar las matrículas en la tabla pivot.
      // Si alguna nota no se ha escrito, se asigna 0 por defecto.

       if ($request->has('checked')) {
            $dades = [];

        foreach ($request->checked as $modulId => $value) {
          $dades[$modulId] = [
             'nota' => isset($request->nota[$modulId]) ? $request->nota[$modulId]: 0
        ];
        }

         $alumne->moduls()->attach($dades);
      }

      if ($request->has('simulate_error')) { 
        throw new \Exception("Error simulat per provar rollback"); }
        
        
        return $alumne;
        });


        // Si el alumno tiene un grupo asignado, creamos/actualizamos una cookie
       // con el ID del grupo para que el formulario recuerde la última selección.
       // Si no tiene grupo, borramos la cookie.
      // En ambos casos redirigimos al listado mostrando un mensaje de éxito.

        if (isset($alumne->grup_id)) {
          return redirect()->route('alumne_list')->with('status', 'Nou alumne '.$alumne->nom.' creat!')
            ->cookie('grup', $alumne->grup_id, 60);
        } else {
          return redirect()->route('alumne_list')->with('status', 'Nou alumne '.$alumne->nom.' creat!')
            ->withoutCookie('grup');
        }
      }
      // si no venim de fer submit al formulari, hem de mostrar el formulari

      $grups = Grup::all();
      $moduls = Modul::all();

      // llegim el valor de la cookie grup(el id)
      // l'enviarem com un parametre al template alumne.new
      $selectedGrup = $request->cookie('grup');

      return view('alumne.new', ['grups' => $grups, 'selectedGrup' => $selectedGrup , 'moduls' => $moduls]);
    }


     function edit(Request $request, $id) 
    {
      
      if ($request->isMethod('post')) {   
        // recollim els camps del formulari en un objecte alumne

        
         $request->validate([
         'nom' => 'required',
         'cognoms' => 'required',
         'dni' => 'required',
         'data_naixement' => 'required|date|before:today',
         'email' => 'email'
        ],[
        'nom.required' => 'El nom és obligatori!',
        'cognoms.required' => 'Els cognoms  són obligatoris!',
        'dni.required' => "El DNI és obligatori!", 
        'data_naixement.required' => "La data de naixement és obligatòria!",
        'data_naixement.before' => "La data de naixement ha de ser anterior a avui!",
        'email.email' => "Has d'introduir un email vàlid!"

       ]);
       $alumne = DB::transaction(function() use ($request , $id) {
        $alumne =  Alumne::find($id);
        $alumne->nom = $request->nom;
        $alumne->cognoms = $request->cognoms;
        $alumne->dni = $request->dni;
        $alumne->data_naixement = $request->data_naixement;
        $alumne->telefon = $request->telefon;
        $alumne->grup_id = $request->grup_id;
        $alumne->email = $request->email;
        $alumne->save();


        // Si el formulario tiene módulos seleccionados, construimos un array $dades
       // donde cada clave es el ID del módulo y el valor es la nota introducida.
       // Luego usamos attach() para guardar las matrículas en la tabla pivot.
      // Si alguna nota no se ha escrito, se asigna 0 por defecto.

       if ($request->has('checked')<=5) {
            $dades = [];

        foreach ($request->checked as $modulId => $value) {
          $dades[$modulId] = [
             'nota' => isset($request->nota[$modulId]) ? $request->nota[$modulId]: 0
        ];
        }

         $alumne->moduls()->sync($dades);
      }else{
        
      }
      

      if ($request->has('simulate_error')) { 
        throw new \Exception("Error simulat per provar rollback"); }
        
        
        return $alumne;
        });


        // Si el alumno tiene un grupo asignado, creamos/actualizamos una cookie
       // con el ID del grupo para que el formulario recuerde la última selección.
       // Si no tiene grupo, borramos la cookie.
      // En ambos casos redirigimos al listado mostrando un mensaje de éxito.

        if (isset($alumne->grup_id)) {
          return redirect()->route('alumne_list')->with('status', 'Nou alumne '.$alumne->nom.' creat!')
            ->cookie('grup', $alumne->grup_id, 60);
        } else {
          return redirect()->route('alumne_list')->with('status', 'Nou alumne '.$alumne->nom.' creat!')
            ->withoutCookie('grup');
        }
      }
      // si no venim de fer submit al formulari, hem de mostrar el formulari
      $alumne = Alumne::find($id);
      $grups = Grup::all();
      $moduls = Modul::all();

      // llegim el valor de la cookie grup(el id)
      // l'enviarem com un parametre al template alumne.new
      $selectedGrup = $request->cookie('grup');

      return view('alumne.edit', ['alumne' => $alumne,'grups' => $grups, 'selectedGrup' => $selectedGrup , 'moduls' => $moduls]);
    }

    public function cookieDelete() { 
        return redirect()->route('alumne_list')->withoutCookie('grup'); 
    }
   


    function delete($id) 
    { 

    
      $alumne = Alumne::find($id);
      $alumne->delete();

      return redirect()->route('alumne_list')->with('status', 'Alumne '.$alumne->nom.' eliminat!');
    }



}
