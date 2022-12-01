<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use App\Models\Autor;

class AutorController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list() { 
      $autors = Autor::all();

      return view('autor.list', ['autors' => $autors]);
    }

    function new(Request $request) { 
      
      if ($request->isMethod('post')) {
        // recollim els camps del formulari en un objecte autor

        $this->validate($request, [
          'nom' => 'required|max:20',
          'cognoms' => 'required|max:30',
        ], $this->messages());

        $autor = new Autor;
        $autor->nom = $request->nom;
        $autor->cognoms = $request->cognoms;
        if($request->file('imatge')){
          $file = $request->file('imatge');
          $filename = str_replace(' ', '_', $request->nom) . "_" . str_replace(' ', '_', $request->cognoms) . "." . $file->getClientOriginalExtension();
          $file->move(public_path('uploads/imatges'), $filename);
          $autor->imatge = $filename;
        }
        $autor->save();

        return redirect()->route('autor_list')->with('status', 'Nou autor '.$autor->nom .' creat!');
      }
      // si no venim de fer submit al formulari, hem de mostrar el formulari

      $autors = Autor::all();

      return view('autor.new', ['autors' => $autors]);
    }

    function edit(Request $request, $id) { 
        $autor = Autor::find($id);

        if ($request->isMethod('post')) {    
          // recollim els camps del formulari en un objecte autor

          $this->validate($request, [
            'nom' => 'required|max:20',
            'cognoms' => 'required|max:30',
          ], $this->messages());
  
          $autor->nom = $request->nom;
          $autor->cognoms = $request->cognoms;
          if($request->delimatge == true){
            $file = public_path(env('RUTA_IMATGES') . $autor->imatge);
            File::delete($file);
            $autor->imatge = null;
          }
          if($request->file('imatge')){
            $file = $request->file('imatge');
            $filename = str_replace(' ', '_', $request->nom) . "_" . str_replace(' ', '_', $request->cognoms) . "." . $file->getClientOriginalExtension();
            $file->move(env('RUTA_IMATGES'), $filename);
            $autor->imatge = $filename;
          }
          $autor->save();
  
          return redirect()->route('autor_list')->with('status', 'Autor '.$autor->nom.' modificat!');
        }
        // si no venim de fer submit al formulari, hem de mostrar el formulari
  
        $autors = Autor::all();
  
        return view('autor.edit', ['autors' => $autors, 'autor' => $autor]);

    }

    function delete($id) { 
      $autor = Autor::find($id);
      $autor->delete();

      return redirect()->route('autor_list')->with('status', 'Autor '.$autor->nom.' eliminat!');
    }

    function messages() {
      return [
          'nom.required' => 'El nom es obligatori.',
          'nom.max' => 'El nom no ha de tenir més de 20 caracters.',
          'cognoms.required' => 'El cognoms son obligatoris.',
          'cognoms.max' => 'Els cognoms no han de tenir més de 30 caracters.',
      ];
    }
}