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

    /*	$data = request()->validate([
    		'desc' => 'required',
    		'localidad_id' => 'required'
    		], [
    		'desc.required' => 'El campo descripción es obligatorio'
    		]);
    */
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
}