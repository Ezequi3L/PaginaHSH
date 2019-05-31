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

  use App\Residencia;
  use App\Ubicacion;
  use App\Foto;

  $res = Residencia::find($id);
  $desc = $res->descripcion;
  $loc = $res->ubicacion;
  $fotos = $res->fotos()->get();

  if ($fotos->first() != null) {
    $primera = $fotos->shift()->src;

?>
 <! Primera foto (item active) >
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{ $primera }}">
    </div>

<?php

  foreach ($fotos as $foto) {

?>
  <! Resto de las fotos >
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ $foto->src }}">
    </div>

<?php
  } //end foreach
?>

  </div>
  <! Botones de navegación entre fotos >
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<?php
  } //endif
?>

<ul class="list-group">
  <li class="list-group-item">{{ $desc }}</li>
  <li class="list-group-item">{{ $loc->ubicacion }}</li>
</ul>

@endsection
