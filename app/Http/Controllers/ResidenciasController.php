<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Residencia;

class ResidenciasController extends Controller
{

    public function ResForm(){
      return view('ResForm', ['title' => "Agregar una residencia"]);
    }

    public function ResList(){
      $title = "HSH - Listado de Residencias";
      $resultado = Residencia::all();
      return view('ResList', compact('title','resultado'));
    }

    public function store(){

    	$data = request()->all();

    	if (empty($data['descripcion'])) {
    		return redirect()->route('crearResidencia')->withErrors('El campo descripción es obligatorio');
    	}
    	Residencia::create([
    		'descripcion' => $data['descripcion'],
    		'ubicacion_id' => $data['ubicacion'],
    		//'foto_id' => $data['']
    		]);
    	return redirect()->route('home')->with('alert-success','La residencia ha sido creada con exito');
    }

     public function ViewRes($id){
      return view('viewRes', [
        'title' => 'Detalles de la residencia',
        'id' => $id,
        ]);
    }

    public function EditRes($id){
      return view('editRes', [
        'title' => 'Modificar la residencia',
        'id' => $id,
        ]);
    }

     public function update(Residencia $residencia){
        $data = request()->validate([
            'descripcion' => '',
            'ubicacion_id' => 'required'
            ], [
            'ubicacion_id.required' => 'El campo ubicacion es obligatorio'
            ]);

        if(empty($data['descripcion'])) {
            $data['descripcion'] = $residencia->descripcion;
        }

        $residencia->update($data);
        return redirect()->route('viewRes', [$residencia]);
    }






  
    function destroy(Residencia $residencia){

      $residencia->dada_de_baja = true;
      $residencia->update();
      return redirect()->route('listarResidencias');
    }

}
