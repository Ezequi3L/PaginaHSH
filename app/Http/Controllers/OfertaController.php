<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oferta;
use App\Subasta;

class OfertaController extends Controller
{
    public function OfertaForm($sub_id) {
    	return view('ofertaForm',[
    		'title' => 'Realizar una oferta',
    		'sub_id'=> $sub_id,
    		]);
    }

    public function store(){

    	$data = request()->validate([
    		'subasta_id' => 'required',
    		'mail' => 'required',
    		'monto' => 'required'
    		], [
    		'subasta_id.required' => 'Ha ocurrido un error. Por favor, inténtelo nuevamente',
    		'mail.required' => 'El campo mail es obligatorio',
    		'monto.required' => 'El campo monto es obligatorio'
    		]);

    	if ($data['monto'] <= 0) {
    		return redirect()->route('ofertar',[$data['subasta_id']])->withErrors('El monto indicado debe ser superior a $0 (cero pesos)');
    	}

    	if ($data['monto'] <= Subasta::find($data['subasta_id'])->oferta_maxima()) {
    		return redirect()->route('ofertar',[$data['subasta_id']])->withErrors('El monto indicado debe ser superior al monto actual de la subasta');
    	}
    	
    	Oferta::create([
    		'subasta_id' => $data['subasta_id'],
    		'mail' => $data['mail'],
    		'monto' => $data['monto']
    		]);
    	return redirect()->route('inicio');
    }
}
