<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Reserva;
use App\Subasta;
use App\User;

class ReservaController extends Controller{
  public function store(){
    // dd(request());
    $data = request()->validate([
      'usr_id' =>'required',
      'residencia_id' =>'required',
      'fecha' => 'required',
      ], [
      'fecha.required' => 'El campo fecha es obligatorio',
      'usr_id' =>'El id del usuario es necesario',
    ]);
    $usuario=User::select()->where('id',$data['usr_id'])->first();
    $reservas=Reserva::select()->where('usr_id',$usuario->id)->get();
    if(($usuario->semanas_disp)>=1){
      $fecha = Carbon::createFromFormat('d/m/Y', $data['fecha']);
      foreach ($reservas as $reserva){
        if($reserva->fecha==$fecha->format('Y-m-d')){
        return redirect()->route('home')->with('alert-success', 'La reserva no se ha realizado debido a que ya cuenta con una reserva para esa semana');
      }
    }
      Reserva::create([
        'usr_id' => $data['usr_id'],
        'residencia_id' => $data['residencia_id'],
        'fecha' => $fecha,
        'devolucion' => true,
        ]);
      $subasta_a_eliminar=Subasta::select()->where('residencia_id',$data['residencia_id'])->where('fecha_reserva',$fecha->format('Y/m/d'))->first();
      if($subasta_a_eliminar!=null){
        $subasta_a_eliminar->delete();
      }
      $usuario->semanas_disp--;
      $usuario->update();
      return redirect()->route('home')->with('alert-success', 'Reserva realizada con exito');
    }
    return redirect()->route('home')->with('alert-success', 'La reserva no se ha realizado debido a que no cuenta con semananas disponibles');
  }

  public function listarReservas($id){
    $title = "Listado de Reservas";
    $reservas=Reserva::select()->where('usr_id',$id)->get();
    return view('lisUserRes', compact('title','id'));
  }

  public function cancelarReserva(Reserva $reserva){
    $title = "Listado de Reservas";
    $id = $reserva->usr_id;
    $fecha_hoy= date('Y-m-d');
    if($reserva->devolucion){
      //dos meses = 61 días
      $dif=(strtotime($reserva->fecha)-strtotime($fecha_hoy))/86400;//no se de que chota es este nro, creo que es la cantidad de horas de un més o algo así, lo saqué de algún foro
      if($dif>=61){
        $user=User::find($id);
        $user->semanas_disp++;
        $user->save();
      }
    }
    $reserva->delete();
    return view('lisUserRes', compact('title','id'));
 }
}
