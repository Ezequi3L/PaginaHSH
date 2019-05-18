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
}