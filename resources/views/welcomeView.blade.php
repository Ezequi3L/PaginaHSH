@extends('layout')

@section('mainContent')

 <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Home Switch Home</h1>
      <p class="lead text-muted">Bienvenido. Aquí abajo le mostramos algunas de nuestras mejores residencias</p>
      <p>
        <a href= {{ route('crearResidencia') }} class="btn btn-primary my-2">Agregar residencia</a>
        <a href={{ route('crearSubasta') }} class="btn btn-secondary my-2">Programar subasta</a>
        <a href={{ route('listarSubasta') }} class="btn btn-secondary my-2">Listar subastas</a>
      </p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">

<?php
  use App\Residencia;

  $mostrar =  Residencia::all()->take(6);

  foreach ($mostrar as $residencia) {

      $descripcion = $residencia->descripcion;
      $localidad = $residencia->localidad;
      $provincia = $localidad->provincia;
  //    $src = $residencia->fotos()->first()->src;
      $src=1;
?>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="<?php echo $src; ?>">
            <div class="card-body">
              <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $localidad->localidad; echo ", "; echo $provincia->provincia; ?> </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                  <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                </div>
              </div>
            </div>
          </div>
        </div>

<?php

 }  //end foreach

?>

      </div>
    </div>
  </div>

@endsection

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

@section('footer')

<footer class="text-muted">
  <div class="container">
    <p class="float-right">
      <a href="#">Ir arriba</a>
    </p>
  </div>
</footer>

@endsection

@section('buscador')

	<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #e9ecef;
}

.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;
  }
}
</style>
</head>
<body>

<div class="topnav">
  <div class="search-container">
    <form  method="POST" action={{ route('resultados') }}>
     @csrf
      <input type="text" placeholder="Buscar.." name="search">
      <input type="checkbox" name="subasta" value="subasta"> {{"Subastas"}}
      <select class="form-control" name="localidad" id="localidad">
            <option value=""> {{"Seleccione una localidad"}} </option>
        <?php

    			$localidades = App\Localidad::all();
   			foreach ($localidades as $localidad) {
    		?>
    				<option value="{{$localidad->id}}">{{$localidad->localidad}}</option>
    			<?php
    			} //end foreach
    			?>
  		</select>
      <button type="submit" name="buscar"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

@endsection
