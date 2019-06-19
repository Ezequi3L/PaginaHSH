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

if ($errors->any()) {
  foreach ($errors->all() as $error) {
    echo "<p class='alert alert-danger'>*".$error."</p>";
  }
}

  use App\User;
  use App\Residencia;
  use App\Ubicacion;
  use App\Foto;
  use App\Oferta;

  $usr = User::find($id);

?>
<div class="container">
  <div class="row justify-content-center" style="margin-top:50px; ">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Modificar sus datos') }}</div>
          <div class="card-body">

            <form method="post" action="{{ route('usrUpdateExitoso', [$id]) }}">
            {{ method_field('put') }}
            @csrf
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre </label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="name" value="{{ $usr->name }}" autofocus>
                </div>
              </div>
              <div class="form-group row">
                <label for="direccion" class="col-md-4 col-form-label text-md-right">Domicilio </label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="direccion" value="{{ $usr->direccion }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="telefono" class="col-md-4 col-form-label text-md-right">Teléfono </label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="telefono" value="{{ $usr->telefono }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="dni" class="col-md-4 col-form-label text-md-right">DNI </label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="dni" value="{{ $usr->dni }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="fecha_nac" class="col-md-4 col-form-label text-md-right">Fecha de nacimiento </label>
                <div class="col-md-6">
                  <input class="form-control" type="date" name="fecha_nac" value="{{ $usr->fecha_nac }}">
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <a href="{{ route('viewUsr', [$id]) }}"class="btn btn-danger">Cancelar</a>
                  <input type="submit" name="guardar" value="Guardar cambios" class="btn btn-success">
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
  </div>
</div>

@endsection
