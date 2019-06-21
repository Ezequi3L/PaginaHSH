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
            <li><a href="#" class="text-white">support@hsh.com</a></li>
            <li><a href="{{ route('sucursales')}}">Sucursales</a></li>
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

use App\Residencia;
use App\HotSale;
use Carbon\Carbon;

$hs = HotSale::find($id);
$res = $hs->residencia_id;
$fecha = $hs->fecha_reserva;
$monto = $hs->monto;

?>

<div style="text-align:center; margin-top:100px; "> <! form >
  <form method="post" action="{{ route('hsUpdateExitoso', [$hs->id]) }}">
  {{ method_field('put') }}
  @csrf
    <div class="form-group">
    <label for="monto_minimo">Monto</label>
    <input class="form-control" type="number" step="any" name="monto" value="{{ old('monto', $monto) }}" required autofocus>
    </div>
    <a href="{{ route('home') }}"class="btn btn-primary">Cancelar</a>
    <input type="submit" name="guardar" value="Guardar cambios" class="btn btn-primary">
  </form>
</div>


@endsection
