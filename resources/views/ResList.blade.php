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
      <p class="lead text-muted">Listado de Residencias</p>
    </div>
  </section>


  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
  <?php


  use App\Residencia;

  $residencias=Residencia::All()->where('dada_de_baja',false);
  $residencias_dadas_de_baja=Residencia::All()->where('dada_de_baja',true);
  foreach ($residencias as $residencia) {
    $descripcion = $residencia->descripcion;
    $ubicacion = $residencia->ubicacion;
    $imgnodisp = '/public/imagenes/img-nodisponible.jpg';
    $foto = $residencia->fotos()->first();
    $src = $residencia->fotos()->first();
    if ($src != null)  $src = $src->first()->src;

?>

    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
        <img src= <?php if ($foto != null){ $src = $foto->src; echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
        <div class="card-body">
          <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", "; ?> </p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
              <?php if (Auth::user()->tipo_de_usuario == 0) {  ?>
                  <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                  <a href="{{ route('crearSubasta', [$residencia->id]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Subastar</button></a>
                  <a href="{{ route('crearHotSale', [$residencia->id]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">HotSale</button></a>
                  <form action="{{ route('aniquilarResidencia', [$residencia]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Está seguro que desea eliminar la residencia?');" type="submit">Eliminar</button>
                  </form>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php

} //fin foreach
//residencias dadas de baja
?>
</div>
</div>
</div>
<?php
if (Auth::user()->tipo_de_usuario == 0){
if(count($residencias_dadas_de_baja)>0){
  ?>
  <section class="text-center">
   <div class="container">
     <p class="lead text-danger">Residencias dadas de baja</p>
   </div>
  </section>
   <div class="album py-5 bg-light">
     <div class="container">
       <div class="row">
<?php
  foreach ($residencias_dadas_de_baja as $residencia) {
    $descripcion = $residencia->descripcion;
    $ubicacion = $residencia->ubicacion;
    $imgnodisp = '/public/imagenes/img-nodisponible.jpg';
    $foto = $residencia->fotos()->first();
    $src = $residencia->fotos()->first();
    if ($src != null)  $src = $src->first()->src;
  ?>
    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
         <p>&nbsp;Residencia</p>
        <img src= <?php if ($foto != null){ $src = $foto->src; echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
        <div class="card-body">
          <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", "; ?> </p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
              <?php if (Auth::user()->tipo_de_usuario == 0) {  ?>
                  <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                  <form method="POST" action="{{ route('habilitarResidencia', [$residencia]) }}">
                    @csrf
                    <button type="submit"  onclick="return confirm('¿Está seguro que desea habilitar la residencia?');" class="btn btn-sm btn-outline-success" >Habilitar Residencia</button>
                  </form>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
}
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
