<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subasta;

class SubastaController extends Controller
{
     public function SubForm(){
      return view('SubForm', ['title' => "Programar una subasta"]);
    }

      public function store(){

    	$data = request()->validate([
    		'residencia' => 'required',
    		'fecha' => 'required',
    		'monto' => 'required'
    		], [
    		'residencia.required' => 'El campo residencia es obligatorio',
    		'fecha.required' => 'El campo fecha es obligatorio',
    		'monto.required' => 'El campo monto es obligatorio'
    		]);
    	
    	Subasta::create([
    		'residencia_id' => $data['residencia'],
    		'fecha_reserva' => $data['fecha'],
    		'monto_minimo' => $data['monto']
    		]);
    	return redirect()->route('inicio');
    }

}
