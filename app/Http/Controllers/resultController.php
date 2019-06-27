<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subasta;
use App\HotSale;
use Carbon\Carbon;

class resultController extends Controller
{
    public function index(){
      $data = request()->all();
      if ($data['fecha_reserva1'] != NULL) {

        $fecha = Carbon::createFromFormat('d/m/Y', $data['fecha_reserva1'])->addMonth(2);
}
      if ($data['fecha_reserva2'] != NULL){

        $fecha2 = Carbon::createFromFormat('d/m/Y', $data['fecha_reserva2']);

}
      if ($data['fecha_reserva1'] != NULL and $data['fecha_reserva2'] != NULL and $fecha2->gte($fecha)){
          return redirect()->route('home')->withErrors('La diferencia entre fechas debe ser menor a 2 meses');

      }
      if (isset($fecha2))
      $fecha2->addMonth(2);
      if (isset($fecha1) and isset($fecha2) and $fecha->gt($fecha2)){
        return redirect()->route('home')->withErrors('La fecha de inicio debe ser menor a la de fin');
      }

      $title = "HSH - Resultados de Busqueda";
    	return view('resultView', compact('title','data'));
    }

    public function listarSubasta(){
      $title = "HSH - Listado de Subastas";
      // $subastas_programadas = Subasta::select()->where('activa',1)->get();
      $subastas_activas = Subasta::all();
      foreach ($subastas_activas as $key => $sub) {
        if(!($sub->activa())){
          unset($subastas_activas[$key]);
        }
      }
      // $subastas_programadas = Subasta::select()->where('finalizada',0)->where('activa',0)->get();
      $subastas_programadas = Subasta::all();
      foreach ($subastas_programadas as $key => $sub) {
        if(!($sub->programada())){
          unset($subastas_programadas[$key]);
        }
      }
      // $subastas_finalizadas = Subasta::select()->where('finalizada',1)->get();
      $subastas_finalizadas = Subasta::all();
      foreach ($subastas_finalizadas as $key => $sub) {
        if(!($sub->finalizada())){
          unset($subastas_finalizadas[$key]);
        }
      }
      return view('lisSub', compact('title','subastas_activas','subastas_programadas','subastas_finalizadas'));
    }

    public function listarHotSale(){
      $title = "HSH - Listado de HotSales";
      // $hotsales_activas = HotSale::select()->where('activa',1)->get();
      // $hotsales_finalizadas = HotSale::select()->where('finalizada',1)->get();
      $hotsales_activas = HotSale::all();
      $hotsales_finalizadas = HotSale::all();
      foreach ($hotsales_activas as $key => $hotsale) {
        if(!($hotsale->activa())){
          unset($hotsales_activas[$key]);
        }
        else{
          unset($hotsales_finalizadas[$key]);
        }
      }
      return view('lisHS', compact('title','hotsales_activas','hotsales_finalizadas'));
    }
}
