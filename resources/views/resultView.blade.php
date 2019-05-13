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
      <p class="lead text-muted">Resultados de la búsqueda</p>
    </div>
  </section>


  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
  <?php

  use App\Subasta;
  use App\Residencia;

  if(isset($_POST['buscar'])) {
    
    $resultado = Subasta::all();

    foreach ($resultado as $subasta) {
         
      $residencia = Residencia::find($subasta->residencia_id);
      $descripcion = $residencia->descripcion;
      $ubicacion = $residencia->ubicacion;
      $src = ($residencia->foto)->src;

  ?>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><img src=" <?php echo $src; ?> "></rect></svg>
            <div class="card-body">
              <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion->ciudad; echo ", "; echo $ubicacion->provincia; ?> </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      

   <?php
         
     } //fin foreach
   }   //fin if(isset)
   
   ?>
      </div>
    </div>
  </div>

@endsection