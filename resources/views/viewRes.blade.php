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

<?php

  use App\Residencia;
  use App\Ubicacion;
  use App\Foto;
  use App\Reserva;
  use Carbon\Carbon;

//mostrar errores
  if ($errors->any()) {
  	foreach ($errors->all() as $error) {
  		echo "<p class='alert alert-danger'>*".$error."</p>";
  	}

  }
//
  $res = Residencia::find($id);
  $desc = $res->descripcion;
  $loc = $res->ubicacion;
  $fotos = $res->fotos()->get();

  if ($fotos->first() != null) {
    $primera = $fotos->shift()->src;

?>
 <! Primera foto (item active) >
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <!-- <img class="d-block w-100" src="{{ $primera }}"> -->
      <!-- parche para ver el botón xd -->
      <img class="d-block w-50" src="{{ $primera }}">
    </div>

<?php

  foreach ($fotos as $foto) {

?>
  <! Resto de las fotos >
    <div class="carousel-item">
      <!-- lo mismo de arriba -->
      <img class="d-block w-50" src="{{ $foto->src }}">
    </div>

<?php
  } //end foreach
?>

  </div>
  <! Botones de navegación entre fotos >
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-n ext-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<?php
  } //endif
  $usr_id=Auth::user()->id;
  $reservas=Reserva::select('fecha')->where('residencia_id',$id)->get();
  $fechas_reservas="[";
  foreach ($reservas as $reserva) {
  	$carbon=Carbon::createFromFormat('Y-m-d',$reserva->fecha)->format('d/m/Y');
  	$fechas_reservas=$fechas_reservas."'".$carbon."'".",";
  }
  $fechas_reservas=$fechas_reservas."]";
  // dd($fechas_reservas);
?>

<ul class="list-group">
  <li class="list-group-item">{{ $desc }}</li>
  <li class="list-group-item">{{ $loc->ubicacion }}</li>
  <?php if (Auth::user()->tipo_de_usuario == 3) {  ?>
    <center>
      <div style="display:block; text-align:center; margin-top:100px; "> <! form >
      	<form method="post" action="{{ route('reservaExitosa') }}">
      	@csrf
      	<input type="hidden" name="usr_id" value=<?php echo'"';echo"$usr_id";echo'"'?>>
        <input type="hidden" name="residencia_id" value=<?php echo'"';echo"$id";echo'"'?>>
      		<div class="form-group">
      			<label for="fecha">Seleccione la fecha de reserva</label>

      					<div class="content">

      							<div class="panel panel-default">
      									<div class="panel-body">
      											<div class="col-md-4 col-md-offset-4">


      															<div class="form-group">
      																	<label for="fecha">Fecha</label>
      																	<div class="input-group">
      																			<input type="text" class="form-control datepicker" name="fecha">
      																			<div class="input-group-addon">
      																					<span class="glyphicon glyphicon-th"></span>
      																			</div>
      																	</div>
      															</div>
      											</div>
      									</div>
      							</div>
      					</div>
      		</div>
      		<input type="submit" name="rerservar" value="Reservar" class="btn btn-primary">
      	</form>

      	<title>Datepicker</title>
      	    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
      	    <!-- Latest compiled and minified CSS -->
      	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
      	    <!-- Optional theme -->
      	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
      	    <!-- Latest compiled and minified JavaScript -->
      	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
      	    <!-- Jquery -->
      	    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
      	    <!-- Datepicker Files -->
      	    <link rel="stylesheet" href="{{'/public/datePicker/css/bootstrap-datepicker3.css'}}">
      	    <link rel="stylesheet" href="{{'/public/datePicker/css/bootstrap-standalone.css'}}">
      	    <script src="{{'/public/datePicker/js/bootstrap-datepicker.js'}}"></script>
      	    <!-- Languaje -->
      	    <script src="{{'/public/datePicker/locales/bootstrap-datepicker.es.min.js'}}"></script>
      	</head>
      	</html>

      	<script>
      		$('.datepicker').datepicker({
      			format: "dd/mm/yyyy",
      			language:"es",
      			startDate: '+6m',
      			endDate: '+12m',
      			daysOfWeekDisabled: "0,2,3,4,5,6",
      			daysOfWeekHighlighted: "1",
            datesDisabled: "<?php echo $fechas_reservas; ?>",
      			// datesDisabled: ['30/12/2019','23/12/2019'],
      			autoclose: true
      		});
      	</script>
    </center>
  <?php } ?>
</ul>


@endsection
