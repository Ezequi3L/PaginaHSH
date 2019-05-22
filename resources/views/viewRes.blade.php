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
  use App\Localidad;
  use App\Provincia;
  use App\Foto;

  $res = Residencia::find($id);
  $foto_src = $res->foto->src;
  $desc = $res->descripcion;
  $loc = $res->localidad;
  $prov = $loc->provincia;
  $pais = $prov->pais;

?>

  <! Mostrar todas las fotos de la residencia >

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{ $foto_src }}" alt="{{ $foto_src }}">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ $foto_src }}" alt="{{ $foto_src }}">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ $foto_src }}" alt="{{ $foto_src }}">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

  <! Mostrar toda la info
    *descripcion
    *localidad, provincia, país >

<ul class="list-group">
  <li class="list-group-item">{{ $desc }}</li>
  <li class="list-group-item">{{ $loc->localidad }}, {{ $prov->provincia }}, {{ $pais->pais }}</li>
</ul>

@endsection
