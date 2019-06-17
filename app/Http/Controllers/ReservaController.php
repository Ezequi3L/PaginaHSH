<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Reserva;
use App\Subasta;
use App\User;

class ReservaController extends Controller
{
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
  if(($usuario->semanas_disp)>=1){
    $fecha = Carbon::createFromFormat('d/m/Y', $data['fecha']);
    Reserva::create([
      'usr_id' => $data['usr_id'],
      'residencia_id' => $data['residencia_id'],
      'fecha' => $fecha,
      'devolucion' => true
      ]);
    $subasta_a_eliminar=Subasta::select()->where('residencia_id',$data['residencia_id'])->where('fecha_reserva',$fecha->format('Y/m/d'))->first();
    if($subasta_a_eliminar!=null){
      $subasta_a_eliminar->delete();
    }
    $usuario->semanas_disp--;
    $usuario->update();
    return redirect()->route('home')->with('alert-success', 'Reserva realizada con exito');
  }
  return redirect()->route('home')->with('alert-success', 'La reserva no se ha realizado debido a que no cuenta con semanas disponibles');


}
}
