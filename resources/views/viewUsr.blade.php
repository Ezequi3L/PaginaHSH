@extends('layout')

@section('headerContent')

      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted"></p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contáctenos</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white">221 888-8888</a></li>
            <li><a href="#" class="text-white">Follow on Twitter</a></li>
            <li><a href="#" class="text-white">Like on Facebook</a></li>
            <li><a href="#" class="text-white">Email me</a></li>
          </ul>
        </div>
      </div>

@endsection

@section('mainContent')

<?php

  use App\User;
  use App\Residencia;
  use App\Ubicacion;
  use App\Foto;
  use App\Oferta;

  $usr = User::find($id); 

?>

<ul class="list-group">
  <li class="list-group-item">Nombre: {{ $usr->name }}</li>
  <li class="list-group-item">Correo electrónico: {{ $usr->email }}</li>
  <li class="list-group-item">Domicilio: {{ $usr->direccion }}</li>
  <li class="list-group-item">Nro. de teléfono: {{ $usr->telefono }}</li>
  <li class="list-group-item">Semanas que tengo disponibles: {{ $usr->semanas_disp }}</li>
  <center>
<a href="{{ route('editUsr', [$usr]) }}"><button type="button" class="btn btn-sm btn-outline-primary">Modificar información</button></a>
<a href="{{ route('changePass', [$usr]) }}"><button type="button" class="btn btn-sm btn-outline-primary">Cambiar contraseña</button></a>
</center>
  </ul>


@endsection