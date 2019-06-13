<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ubicacion;

class UbicacionController extends Controller
{
    //
      public function UbicacionForm(){
        return view('ubicacionForm', ['title' => 'Alta de Ubicacion']);
      }

      public function store(){
        $data=request()->all();
        if (empty($data['ubicacion'])) {
      		return redirect()->route('altaUbicacion')->withErrors('El campo ubicacion es obligatorio');
      }
        Ubicacion::create([
          'ubicacion' => $data['ubicacion']
        ]);
        return redirect()->route('inicio');
}
}
