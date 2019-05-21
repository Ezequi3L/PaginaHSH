<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Residencia;

class ResidenciasController extends Controller
{

    public function ResForm(){
      return view('ResForm', ['title' => "Agregar una residencia"]);
    }

    public function store(){

    	$data = request()->all();

    	if (empty($data['desc'])) {
    		return redirect()->route('crearResidencia')->withErrors('El campo descripción es obligatorio');
    	}
    	Residencia::create([
    		'descripcion' => $data['desc'],
    		'localidad_id' => $data['localidad'],
    		//'foto_id' => $data['']
    		]);
    	return redirect()->route('inicio');
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
            'localidad_id' => 'required'
            ], [
            'localidad_id.required' => 'El campo localidad es obligatorio'
            ]);

        if(empty($data['descripcion'])) {
            $data['descripcion'] = $residencia->descripcion;
        }
        
        $residencia->update($data);
        return redirect()->route('viewRes', [$residencia]);
    }

}
