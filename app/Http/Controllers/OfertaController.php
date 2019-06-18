<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oferta;
use App\Subasta;
use App\User;
use App\Reserva;

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
    		'user_id' => 'required',
    		'monto' => 'required'
    		], [
    		'subasta_id.required' => 'Ha ocurrido un error. Por favor, inténtelo nuevamente',
    		'user_id.required' => 'Ha ocurrido un error. Por favor, inténtelo nuevamente',
    		'monto.required' => 'El campo monto es obligatorio'
    		]);

    	if ($data['monto'] <= 0) {
    		return redirect()->route('ofertar',[$data['subasta_id']])->withErrors('El monto indicado debe ser superior a $0 (cero pesos)');
    	}

    	if ($data['monto'] <= Subasta::find($data['subasta_id'])->oferta_maxima()) {
    		return redirect()->route('ofertar',[$data['subasta_id']])->withErrors('El monto indicado debe ser superior al monto actual de la subasta');
    	}

        $usuario = User::find($data['user_id']);
        if ($usuario->semanas_disp <= 0) {
            return redirect()->route('ofertar',[$data['subasta_id']])->withErrors('La oferta no ha podido realizarse porque usted no cuenta con semanas disponibles');
        }

        $reservas = Reserva::select()->where('usr_id',$usuario->id)->get();
        $fechaSubasta = Subasta::find($data['subasta_id'])->fecha_reserva; 
        foreach ($reservas as $reserva) {
            if ($reserva->fecha == $fechaSubasta ) {
               return redirect()->route('ofertar',[$data['subasta_id']])->withErrors('La reserva no se ha realizado debido a que ya cuenta con una reserva para esa semana');
            }
         }

    	Oferta::create([
    		'subasta_id' => $data['subasta_id'],
    		'usr_id' => $data['user_id'],
    		'monto' => $data['monto']
    		]);
    	return redirect()->route('home');
    }
}
