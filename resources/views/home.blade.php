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
      <img src= "/public/imagenes/logocompleto.png" style= "width: 70%; height: 50%;" align=center >
      <p class="lead text-muted">Bienvenido. Aquí abajo le mostramos algunas de nuestras mejores residencias</p>
      <p>
        <?php if (Auth::user()->tipo_de_usuario == 0) {  ?>
          <a href= {{ route('crearResidencia') }} class="btn btn-primary my-2">Agregar residencia</a>
        <?php } ?>

        <a href={{ route('listarSubasta') }} class="btn btn-secondary my-2">Listar subastas</a>
        <a href={{ route('listarResidencias') }} class="btn btn-secondary my-2">Listar residencias</a>
        <?php if (Auth::user()->tipo_de_usuario == 0) {  ?>
          <a href={{ route('listUsr')}} class="btn btn-primary my-2">Listado de Usuarios</a>
        <?php } ?>
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
                  <?php if (Auth::user()->tipo_de_usuario == 0) { ?>
                    <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                  <?php } ?>
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






    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{'/public/datePicker/css/bootstrap-datepicker3.css'}}">
    <link rel="stylesheet" href="{{'/public/datePicker/css/bootstrap-standalone.css'}}">
    <script src="{{'/public/datePicker/js/bootstrap-datepicker.js'}}"></script>
    <!-- Languaje -->
    <script src="{{'/public/datePicker/locales/bootstrap-datepicker.es.min.js'}}"></script>

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
  margin: 0;
  padding: 0;
  list-style: none;
  position: relative;
  float: right;
  overflow: hidden;
  background-color: #e9ecef;
}

.topnav .search-container {
  display: inline-block;
  float: right;
  font-size: 16px;
  padding: 1px 10px;
  text-decoration: none;
}

.topnav input[type=text] {
  padding: 4px;
  margin-top: 4px;
  font-size: 14px;
  border:none;
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


</style>
</head>
<body>

<div class="topnav">
  <div class="search-container">
    <form  method="GET" action={{ route('resultados') }}>
     @csrf
      <input type="text" id="search" placeholder="Buscar.." name="search">
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
      <input type="text" class="form-control datepicker" placeholder="INICIO" name="fecha_reserva1">
      <input type="text" class="form-control datepicker" placeholder="FIN" name="fecha_reserva2">
      <button type="submit" name="buscar"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>



<script>
  $('.datepicker').datepicker({
    format: "dd/mm/yyyy",
    language:"es",
    startDate: '+6m',
    endDate: '+12m',
    daysOfWeekDisabled: "0,2,3,4,5,6",
    daysOfWeekHighlighted: "1",
    autoclose: true
  });
</script>

@endsection
