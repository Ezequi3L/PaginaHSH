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

  $imgnodisp = '/public/imagenes/img-nodisponible.jpg';

  foreach ($resultado as $subasta) {

    $residencia = Residencia::find($subasta->residencia_id);
    $descripcion = $residencia->descripcion;
    $ubicacion = $residencia->ubicacion->ubicacion;
    $foto = $residencia->fotos()->first();

?>

<div class="col-md-4">
  <div class="card mb-4 shadow-sm">
   <img src= <?php if ($foto != null){ $src = $foto->src; echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
    <div class="card-body">
      <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion; echo ", "; ?> </p>
      <p class="card-text"> <?php echo "Reserva: "; echo $subasta->fecha_reserva; ?> </p>
      <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">
          <?php if ((Auth::user()->tipo_de_usuario == 2)||(Auth::user()->tipo_de_usuario == 3)) {  ?>
              <a href="{{ route('ofertar', [$subasta]) }}"><button type="button" class="btn btn-sm btn-primary">Ofertar</button></a>
          <?php }
          if (Auth::user()->tipo_de_usuario == 0) {  ?>
             <a href="{{ route('editSub', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
             <a href="{{ route('adjudicar', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Adjudicar</button></a>
             <form action="{{ route('deleteSub', [$subasta]) }}" method="POST">
              @csrf
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
             </form>
          <?php } ?>
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
