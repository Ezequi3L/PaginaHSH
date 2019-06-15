<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
     public function ViewUsr($id){
      return view('viewUsr', [
        'title' => 'Detalles del usuario',
        'id' => $id,
        ]);
    }

    public function EditUsr($id){
      return view('editUsr', [
        'title' => 'Modificar la información',
        'id' => $id,
        ]);
    }
}
