<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class resultController extends Controller
{
    public function index(){
    	return view('resultView', [
    		'title' => "HSH - Resultados de búsqueda"
    	]);
    }

    public function listarSubasta(){
      $title = "HSH - Listado de Subastas"
      $resultado = App\Subasta::all();
      return view('listadoSubastas', compact($title,$resultado))


    }
}
