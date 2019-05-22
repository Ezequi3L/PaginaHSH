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

	 <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Home Switch Home</h1>
      <p class="lead text-muted">Listado de Subastas</p>
    </div>
  </section>


  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
  <?php


  use App\Subasta;
  use App\Residencia;

  foreach ($resultado as $subasta) {

    $residencia = Residencia::find($subasta->residencia_id);
    $descripcion = $residencia->descripcion;
    $localidad = $residencia->localidad;
    $provincia = $localidad->provincia;
    $src = $residencia->fotos()->first();
    if ($src != null)  $src = $src->first()->src;

?>

<div class="col-md-4">
  <div class="card mb-4 shadow-sm">
    <img src="<?php echo $src; ?>">
    <div class="card-body">
      <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $localidad->localidad; echo ", "; echo $provincia->provincia; ?> </p>
      <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">
          <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
          <a href="{{ route('ofertar', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ofertar</button></a>
          <a href="{{ route('editSub', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar subasta</button></a>
          <a href="{{ route('adjudicar', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Adjudicar</button></a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php

  } //fin foreach

?>

</div>
</div>
</div>

@endsection

@section('footer')

<footer class="text-muted">
  <div class="container">
    <p class="float-right">
      <a href="#">Ir arriba</a>
    </p>
  </div>
</footer>

@endsection
