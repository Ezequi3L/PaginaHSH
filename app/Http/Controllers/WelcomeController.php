<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
  public function index(){
  	return view('welcomeView', [
  		'title' => "HSH - Página de inicio"
  	]);
  }

  public function sucursales(){
    return view('sucursalesView', [
      'title' => "HSH - Listado de Sucursales"
    ]);
  }

  public function about(){
    return view('about', ['title' => "HSH - Ayuda"]);
  }
}
