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
      return view('ResList', compact('title'));
    }

    public function store(){

    	$data = request()->all();

    	if (empty($data['descripcion'])) {
    		return redirect()->route('crearResidencia')->withErrors('El campo descripción es obligatorio');
    	}

      if (empty($data['ubicacion_precisa'])) {
    		return redirect()->route('crearResidencia')->withErrors('El campo ubicación precisa precisa es obligatorio');
    	}

    	Residencia::create([
    		'descripcion' => $data['descripcion'],
    		'ubicacion_id' => $data['ubicacion'],
        'ubicacion_precisa' => $data['ubicacion_precisa'],
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
            'ubicacion_precisa' => '',
            'ubicacion_id' => 'required',
            ], [
            'ubicacion_id.required' => 'El campo ubicacion es obligatorio'
            ]);

        if(empty($data['descripcion'])) {
            $data['descripcion'] = $residencia->descripcion;
        }

        if(empty($data['ubicacion_precisa'])) {
            $data['ubicacion_precisa'] = $residencia->ubicacion_precisa;
        }

        // dd($data['ubicacion_precisa'] ,$residencia->ubicacion_precisa);
        $residencia->update($data);
        return redirect()->route('viewRes', [$residencia]);
    }

    function destroy(Residencia $residencia){
      $residencia->dada_de_baja = true;
      $residencia->update();
      return redirect()->route('listarResidencias');
    }

    public function habilitarResidencia(Residencia $residencia){
      $residencia->dada_de_baja = false;
      $residencia->update();
      return redirect()->route('listarResidencias');
    }
}
