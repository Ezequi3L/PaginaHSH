<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subasta;
use App\Residencia;
use Carbon\Carbon;

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

        $fIni = Carbon::createFromDate($data['fecha'])->subMonth(6);
        $fAct = Carbon::createFromDate('now');
        if ($fAct > $fIni) {
            return redirect()->route('crearSubasta')->withErrors('La fecha de reserva debe ser por lo menos dentro de seis meses');
        }

        $subastasConMismaFecha = Subasta::whereFecha_reserva($data['fecha'])->get();
        foreach ($subastasConMismaFecha as $sub) {
            if ($sub->residencia_id == $data['residencia']) {
                return redirect()->route('crearSubasta')->withErrors('La residencia indicada ya posee una subasta para la fecha seleccionada');
            }
    	}

    	Subasta::create([
    		'residencia_id' => $data['residencia'],
    		'fecha_reserva' => $data['fecha'],
    		'monto_minimo' => $data['monto']
    		]);
    	return redirect()->route('inicio');

    }

     public function EditSub($id){
      return view('editSub', [
        'title' => 'Detalles de la subasta',
        'id' => $id,
        ]);
    }

     public function update($subid){
        $subasta = Subasta::find($subid);
        $data = request()->validate([

            'monto_minimo' => 'required'
            ], [

            'monto_minimo.required' => 'El campo monto es obligatorio'
            ]);

        $subasta->update($data);
        return redirect()->route('inicio');
    }

      public function Adjudicar($id){
      return view('adjudicar', [
        'title' => 'Adjudicar la subasta',
        'id' => $id,
        ]);
    }

     public function GuardarAdjudicacion($id){

        //$sub = Subasta::find($id);
        //$sub->marca_de_baja = true;

        return redirect()->route('inicio');
    }

}
