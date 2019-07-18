<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\HotSale;
use App\Residencia;
use Carbon\Carbon;
use App\Reserva;
use App\User;

class HotSaleController extends Controller
{
  public function HSForm($id){
    return view('HotSaleForm', ['title' => "Programar una HotSale",'id'=>$id]);
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
    return redirect()->route('home')->with('alert-success', 'Error al crear la hotsale, la residencia se encuentra dada de baja');
  }
  //*
  $fecha = Carbon::createFromFormat('d/m/Y', $data['fecha']);

	HotSale::create([
		'residencia_id' => $data['id'],
		'fecha_reserva' => $fecha,
		'monto' => $data['monto']
		]);
	return redirect()->route('home')->with('alert-success', 'HotSale creada con exito');
}

   public function EditHS($id){
    return view('editHS', [
      'title' => 'Detalles de la HotSale',
      'id' => $id,
      ]);
  }

   public function update($hsid){
      $hotsale = HotSale::find($hsid);
      $data = request()->validate([

          'monto' => 'required'
          ], [

          'monto.required' => 'El campo monto es obligatorio'
          ]);

      if ($data['monto'] <= 0) {
        return redirect()->route('editHS',[$hsid])->withErrors('El monto debe ser superior a $0 (cero pesos)');
      }

      $hotsale->update($data);
      return redirect()->route('home');
  }

  public function CompraHS(HotSale $hotsale){
    $user=Auth::user();
    $reservas=Reserva::where('usr_id',$user->id)->get();
    foreach ($reservas as $reserva) {
      // dd($reserva->fecha,$hotsale->fecha_reserva);
      if($reserva->fecha==$hotsale->fecha_reserva){
      return redirect()->route('listarHotSale')->with('alert-success', 'No sa ha podido concretar la compra de la HotSale debido a que ya cuenta con una reserva para esa semana');
      }
    }
    Reserva::create([
      'usr_id' => $user->id,
      'residencia_id' => $hotsale->residencia_id,
      'fecha' => $hotsale->fecha_reserva,
      'hotsale' => true,
      'monto' => $hotsale->monto,
      ]);
    $hotsale->delete();
    return redirect()->route('home')->with('alert-success', 'HotSale comprada con exito, puede revisar la reserva en su perfil');
  }

  public function destroy(HotSale $hotsale){
    $hotsale->delete();
    return redirect()->route('listarHotSale');
  }
}
