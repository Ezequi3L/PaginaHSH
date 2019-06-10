@extends('layout')

@section('mainContent')

 <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Home Switch Home</h1>
      <p class="lead text-muted">Bienvenido. Aquí abajo le mostramos algunas de nuestras mejores residencias</p>
      <p>
        @if (Route::has('login'))
          @auth
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-primary my-2">LogOut</button>
            </form>
        @else
             <a class="btn btn-primary my-2" href="{{ route('login') }}">Login</a>
          @if (Route::has('register'))
            <a class="btn btn-secondary my-2" href="{{ route('register') }}">Register</a>
          @endif
          @endauth

        @endif

      </p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">

<?php
  use App\Residencia;
  use App\Ubiacion;

  $mostrar =  Residencia::all()->take(6);
  $imgnodisp = '/public/imagenes/img-nodisponible.jpg';

  foreach ($mostrar as $residencia) {

      $descripcion = $residencia->descripcion;
      $ubicacion = $residencia->ubicacion;
      $foto = $residencia->fotos()->first();
?>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src= <?php if ($foto != null){ echo '"'; echo $foto->src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
            <div class="card-body">
              <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", "; ?> </p>
              <div class="d-flex justify-content-between align-items-center">
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
    <form  method="GET" action={{ route('resultados') }}>
     @csrf
      <input type="text" placeholder="Buscar.." name="search">
      <input type="checkbox" name="subasta" value="subasta"> {{"Subastas"}}
      <select class="form-control" name="ubicacion" id="ubicacion">
            <option value=""> {{"Seleccione una ubicacion"}} </option>
        <?php

    			$ubicaciones = App\Ubicacion::all();
   			foreach ($ubicaciones as $ubicacion) {
    		?>
    				<option value="{{$ubicacion->id}}">{{$ubicacion->ubicacion}}</option>
    			<?php
    			} //end foreach
    			?>
  		</select>
      <input class="form-control" type="date" name="fecha_reserva" id="fecha" value="" >
      <button type="submit" name="buscar"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

@endsection
