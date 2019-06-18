@extends('layout')

@section('mainContent')
<?php
use config\Session;

if ($errors->any()) {
  foreach ($errors->all() as $error) {
    echo "<p class='alert alert-danger'>*".$error."</p>";
  }

}
 ?>


<section class="jumbotron text-center">
    <div class="container">
      <!-- iba acá xd -->
      <p class="lead text-muted">Bienvenido. Aquí abajo le mostramos algunas de nuestras mejores residencias</p>
      <p>
        <a href= {{ route('crearResidencia') }} class="btn btn-primary my-2">Agregar residencia</a>
        <a href={{ route('listarSubasta') }} class="btn btn-secondary my-2">Listar subastas</a>
        <a href={{ route('listarResidencias') }} class="btn btn-secondary my-2">Listar residencias</a>
        <a href={{ route('listUsr')}} class="btn btn-secondary my-2">Listado de Usuarios</a>
        <img src= "/public/imagenes/logocompleto.png" style= "width: 70%; height: 70%;" >
      </p>
    </div>
  </section>


 <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">

<?php
  use App\Residencia;
  use App\Ubiacion;
  use Carbon\Carbon;




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
  float: none;
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
        {{"Rango de fechas"}}
      <input class="form-control" type="date" name="fecha_reserva1" id="fecha1" value="" min=<?php $hoy=Carbon::today()->addMonth(6)->toDateString(); echo $hoy; ?> max=<?php $hoy=Carbon::today()->addYear()->toDateString(); echo $hoy; ?>>
      <input class="form-control" type="date" name="fecha_reserva2" id="fecha2" value="" min=<?php $hoy=Carbon::today()->addMonth(6)->toDateString(); echo $hoy; ?> max=<?php $hoy=Carbon::today()->addYear()->toDateString(); echo $hoy; ?>>
      <button type="submit" name="buscar"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

@endsection
