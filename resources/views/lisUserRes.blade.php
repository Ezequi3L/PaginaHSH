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

	 <!-- <section class="jumbotron text-center">
    <div class="container">
      <h2 class="jumbotron-heading">Listado de Reservas</h2>
    </div>
  </section> -->

  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
  <?php

  use App\Residencia;
  use App\Reserva;

  $imgnodisp = '/public/imagenes/img-nodisponible.jpg';
  $reservas = Reserva::select()->where('usr_id',$id)->get();

  if (count($reservas) !=0){
  foreach ($reservas as $reserva) {
    $residencia = Residencia::find($reserva->residencia_id);
    $descripcion = $residencia->descripcion;
    $ubicacion = $residencia->ubicacion->ubicacion;
    $ubicacion_precisa = $residencia->ubicacion_precisa;
    $foto = $residencia->fotos()->first();

?>

    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
       <img src= <?php if ($foto != null){ $src = $foto->src; echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
        <div class="card-body">
          <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion; echo ", "; echo "</br>"; echo $ubicacion_precisa;  ?> </p>
          <p class="card-text"> <?php echo "Fecha de Reserva: "; echo $reserva->fecha; ?> </p>
          <center> <form action="{{ route('deleteReserva', [$reserva]) }}" method="POST">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-sm btn-outline-danger">Cancerlar Reserva</button>
           </form>
          </center>
        </div>
      </div>
    </div>

<?php

  } //fin foreach
}
else{ ?>
  <center>
    <div class="col-md-auto">
      <h1></h1>
      <h1>Todavia no tiene ninguna reserva</h1>
    </div>
  </center>
  <?php
}
?>

</div>
</div>
</div>

@endsection
