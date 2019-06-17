<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subasta;
use App\Residencia;
use Carbon\Carbon;
use App\Oferta;
use App\User;

class SubastaController extends Controller
{
     public function SubForm($id){
      return view('SubForm', ['title' => "Programar una subasta",'id'=>$id]);
    }

      public function store(){
      // dd(request());
    	$data = request()->validate([
        'id' =>'required',
    		'fecha' => 'required',
    		'monto' => 'required'
    		], [
    		'fecha.required' => 'El campo fecha es obligatorio',
    		'monto.required' => 'El campo monto es obligatorio'
      ]);
        // dd($data);
        $fecha = Carbon::createFromFormat('d/m/Y', $data['fecha']);

    	Subasta::create([
    		'residencia_id' => $data['id'],
    		'fecha_reserva' => $fecha,
    		'monto_minimo' => $data['monto']
    		]);
    	return redirect()->route('home')->with('alert-success', 'Subasta creada con exito');
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
        return redirect()->route('home');
    }

      public function Adjudicar($id){
      return view('adjudicar', [
        'title' => 'Adjudicar la subasta',
        'id' => $id,
        ]);
    }

     public function GuardarAdjudicacion($id){

        $data = request();
        $oferta = Oferta::find($data->oferta);
        $sub = Subasta::find($id);
        //notificar al usuario que ganó
        if ($oferta->monto >= $sub->monto_minimo) {  // Comprobar que la oferta alcance el monto mínimo.
           $destinatario = User::find($oferta->usr_id)->id;

           //$this->destroy($sub);

           return redirect()->route('sendMail', [$destinatario]);
        }
        else {
            return redirect()->route('adjudicar',[$id])->withErrors('El monto mínimo no ha sido alcanzado. ¿Desea borrar esta subasta?');
        }
    }

     public function destroy(Subasta $subasta){

        $ofertas = $subasta->ofertas;
        foreach ($ofertas as $oferta) { // primero deben borrarse todas las ofertas de esta subasta
            $usr = $oferta->mail; //hay que notificar a este mail
            $oferta->delete();
        }

        $subasta->delete();
        return redirect()->route('listarSubasta');
    }

}
