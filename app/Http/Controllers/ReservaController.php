<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Reserva;

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
  // dd($data);
  $fecha = Carbon::createFromFormat('d/m/Y', $data['fecha']);
  Reserva::create([
    'usr_id' => $data['usr_id'],
    'residencia_id' => $data['residencia_id'],
    'fecha' => $fecha,
    'devolucion' => true
    ]);
  return redirect()->route('home')->with('alert-success', 'Reserva realizada con exito');
}
}
