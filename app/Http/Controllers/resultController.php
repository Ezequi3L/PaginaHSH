<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subasta;

class resultController extends Controller
{
    public function index(){
      $data = request()->all();
      $title = "HSH - Resultados de Busqueda";
    	return view('resultView', compact('title','data'));
    }

    public function listarSubasta(){
      $title = "HSH - Listado de Subastas";
      $resultado = Subasta::all();
      return view('lisSub', compact('title','resultado'));


    }
}
