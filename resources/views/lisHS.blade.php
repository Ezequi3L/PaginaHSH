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
  <p class="lead text-muted">Listado de HotSales</p>
</div>
</section>
<?php
use App\HotSale;
use App\Residencia;

$imgnodisp = '/public/imagenes/img-nodisponible.jpg';
?>
  <!-- HotSales finalizadas(admin) -->
  <?php
if(Auth::user()->tipo_de_usuario==0){
  ?>
  <section class="text-center">
   <div class="container">
     <p class="lead text-danger">HotSales finalizadas</p>
   </div>
  </section>
  <?php
if (count($hotsales_finalizadas)==0){
  ?>
  <div class="album py-5 bg-light">
  <h5 class="text-muted" style="text-align:center">No hay HotSales finalizadas</h5>
  </div>
  <?php
}
else {
 ?>
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
  <?php
  foreach ($hotsales_finalizadas as $hotsale) {

    $residencia = Residencia::find($hotsale->residencia_id);
    $descripcion = $residencia->descripcion;
    $ubicacion = $residencia->ubicacion->ubicacion;
    $foto = $residencia->fotos()->first();

?>

<div class="col-md-4">
  <div class="card mb-4 shadow-sm">
   <img src= <?php if ($foto != null){ $src = $foto->src; echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
    <div class="card-body">
      <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion; echo ", "; ?> </p>
      <p class="card-text"> <?php echo "Reserva: "; echo $hotsale->fecha_reserva; ?> </p>
      <p class="card-text"> <?php echo "Precio: "; echo $hotsale->monto; ?> </p>
      <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">
          <?php
          if (Auth::user()->tipo_de_usuario == 0) {  ?>
             <form action="{{ route('deleteHS', [$hotsale]) }}" method="POST">
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
<?php
}
}
?>
<!-- HotSales activas -->
<?php if(Auth::user()->tipo_de_usuario==0){ ?>
<section class="text-center">
  <div class="container">
    <p class="lead text-success">HotSales activas</p>
  </div>
</section>
<?php } ?>
<?php
if (count($hotsales_activas)==0){
?>
<div class="album py-5 bg-light">
<h5 class="text-muted" style="text-align:center">No hay HotSales activas</h5>
</div>
<?php
}
else {
?>
<div class="album py-5 bg-light">
  <div class="container">
    <div class="row">
<?php
foreach ($hotsales_activas as $hotsale) {

  $residencia = Residencia::find($hotsale->residencia_id);
  $descripcion = $residencia->descripcion;
  $ubicacion = $residencia->ubicacion->ubicacion;
  $foto = $residencia->fotos()->first();

?>

<div class="col-md-4">
<div class="card mb-4 shadow-sm">
 <img src= <?php if ($foto != null){ $src = $foto->src; echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
  <div class="card-body">
    <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion; echo ", "; ?> </p>
    <p class="card-text"> <?php echo "Reserva: "; echo $hotsale->fecha_reserva; ?> </p>
    <p class="card-text"> <?php echo "Precio: "; echo $hotsale->monto; ?> </p>
    <div class="d-flex justify-content-between align-items-center">
      <div class="btn-group">
        <?php if ((Auth::user()->tipo_de_usuario == 2)||(Auth::user()->tipo_de_usuario == 3)) {  ?>
            <a href="{{ route('comprarHS', [$hotsale]) }}"><button type="button" class="btn btn-sm btn-primary">Comprar</button></a>
        <?php }
        if (Auth::user()->tipo_de_usuario == 0) {  ?>
           <a href="{{ route('editHS', [$hotsale]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
           <form action="{{ route('deleteHS', [$hotsale]) }}" method="POST">
            @csrf
              {{ method_field('DELETE') }}
              <button type="submit" onclick="return confirm('¿Está seguro que desea eliminar la HotSale?');" class="btn btn-sm btn-outline-danger">Eliminar</button>
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
<?php
}
?>


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
