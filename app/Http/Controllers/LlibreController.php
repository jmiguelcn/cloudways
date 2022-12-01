<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Llibre;
use App\Models\Autor;

class LlibreController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list() 
    { 
      $llibres = Llibre::all();

      return view('llibre.list', ['llibres' => $llibres]);
    }

    function new(Request $request) 
    { 
      if ($request->isMethod('post')) {    
        // recollim els camps del formulari en un objecte llibre

        $this->validate($request, [
          'titol' => 'required|min:2|max:20',
          'dataP' => 'date|before_or_equal:now',
          'vendes' => 'required',], $this->messages());

        $llibre = new Llibre;
        $llibre->titol = $request->titol;
        $llibre->dataP = $request->dataP;
        $llibre->vendes = $request->vendes;
        $llibre->autor_id = $request->autor_id;
        $llibre->save();

        $autors = Autor::all();

        if ($llibre->autor_id == null) {
          return redirect()->route('llibre_list')->with('status', 'Nou llibre '.$llibre->titol.' creat!')->withoutCookie('autor');
        } else {
          return redirect()->route('llibre_list')->with('status', 'Nou llibre '.$llibre->titol.' creat!')->cookie(
          'autor', $llibre->autor_id, 180);
        }
        
      }
      // si no venim de fer submit al formulari, hem de mostrar el formulari

      $autors = Autor::all();

      return view('llibre.new', ['autors' => $autors]);
    }

    function edit(Request $request, $id) 
    { 
        $llibre = Llibre::find($id);

        if ($request->isMethod('post')) {    
          // recollim els camps del formulari en un objecte llibre

          $this->validate($request, [
            'titol' => 'required|min:2|max:20',
            'dataP' => 'date|before_or_equal:now',
            'vendes' => 'required',], $this->messages());
  
          $llibre->titol = $request->titol;
          $llibre->dataP = $request->dataP;
          $llibre->vendes = $request->vendes;
          $llibre->autor_id = $request->autor_id;
          $llibre->save();
  
          $autors = Autor::all();
          
          return redirect()->route('llibre_list')->with('status', 'Llibre '.$llibre->titol.' modificat!');
        }
        // si no venim de fer submit al formulari, hem de mostrar el formulari
  
        $autors = Autor::all();
  
        return view('llibre.edit', ['autors' => $autors, 'llibre' => $llibre]);

    }

    function delete($id) 
    { 
      $llibre = Llibre::find($id);
      $llibre->delete();

      return redirect()->route('llibre_list')->with('status', 'Llibre '.$llibre->titol.' eliminat!');
    }

    function messages() {
      return [
          'titol.required' => 'El titol es obligatori.',
          'titol.min' => 'El titol no han de tenir menys de 2 caracters.',
          'titol.max' => 'El titol no han de tenir més de 20 caracters.',
          'dataP.date' => '',
          'dataP.before_or_equal' => 'El dataP ha de ser com a molt tard avui.',
          'vendes.required' => 'Les vendes son obligatories.',
      ];
    }
}