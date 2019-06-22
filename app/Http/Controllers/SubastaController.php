<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subasta;
use App\Residencia;
use Carbon\Carbon;
use App\Oferta;
use App\User;
use App\Reserva;

class SubastaController extends Controller
{
  public function SubForm($id){
    return view('SubForm', ['title' => "Programar una subasta",'id'=>$id]);
  }

  public function store(){

	$data = request()->validate([
    'id' =>'required',
		'fecha' => 'required',
		'monto' => 'required'
		], [
		'fecha.required' => 'El campo fecha es obligatorio',
		'monto.required' => 'El campo monto es obligatorio'
  ]);
  $residencia =Residencia::find($data['id']);
  //por las dudas xd
  if($residencia->dada_de_baja){
    return redirect()->route('home')->with('alert-success', 'Error al crear la subasta, la residencia se encuentra dada de baja');
  }
  //*
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
      dd($data);
      $oferta = Oferta::find($data->oferta);
      $sub = Subasta::find($id);
      //notificar al usuario que ganó
      if ($oferta->monto >= $sub->monto_minimo) {  // Comprobar que la oferta alcance el monto mínimo.

         $destinatario = User::find($oferta->usr_id)->id;

         $sub->update(['dada_de_baja' => true]);

         return redirect()->route('sendMail', [$destinatario]);
      }
      else {
          return redirect()->route('adjudicar',[$id])->withErrors('El monto mínimo no ha sido alcanzado. ¿Desea borrar esta subasta?');
      }
  }

   public function destroy(Subasta $subasta){
     $ofertas = $subasta->ofertas;
     if(!$subasta->ganada){//si no está ganada, hace lo de siempre
      $destinatarios = array();
      $i = 0;
      foreach ($ofertas as $oferta) { // primero deben borrarse todas las ofertas de esta subasta
          $usr = $oferta->usr_id; //hay que notificar a este usuario
          $oferta->delete();
          $destinatarios[$i] = $usr;
          $i++;
      }
      $destinatarios = serialize($destinatarios);
      $subasta->delete();
      return redirect('/enviarSubElim/'.$destinatarios);
      }
      //FALTA VER DESDE DONDE LLAMO A ESTE METODO CON EL SUBASTA->GANADA, QUE NO SEA DESDE EL "ELIMINAR SUBASTA", AUNQUE FUNCIONARÍA, LA IDEA SERÍA QUE SE ELIMINE DE UNA AL ADJUDICARLA
      //*
      //*
      //*
    else{//si está ganada, significa que ya envió el mail al ganador y no debería notificar a los pujantes de que fue eliminada
      foreach ($ofertas as $oferta){
          $oferta->delete();
        }
      $subata->delete();
      return redirect('listarSubasta')->with('alert-success', 'Subasta adjudicada y eliminada con exito');
      }
  }

  public function GuardarAdjudicacion($id){

    $data = request();
    $oferta = Oferta::find($data->oferta);
    $sub = Subasta::find($id);
    //notificar al usuario que ganó
    if ($oferta->monto >= $sub->monto_minimo) {  // Comprobar que la oferta alcance el monto mínimo.
      $destinatario = User::find($oferta->usr_id)->id;
      //crear reserva, guardar monto de esa oferta, marcar subasta como ganada.
      // dd($oferta->monto);
      Reserva::create([
        'usr_id' => $oferta->usr_id,
        'residencia_id' => $sub->residencia_id,
        'fecha' => $sub->fecha_reserva,
        'hotsale' => false,
        'monto' => $oferta->monto,
        ]);
      $sub->ganada=true;
      $sub->update();
      return redirect()->route('sendMail', [$destinatario]);
    }
    else {
      return redirect()->route('adjudicar',[$id])->withErrors('El monto mínimo no ha sido alcanzado. ¿Desea borrar esta subasta?');
    }
  }
}
