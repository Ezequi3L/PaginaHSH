@extends('layout')

<?php
use  App\Residencia;
use Carbon\Carbon;

?>

@section('mainContent')

<?php
if ($errors->any()) {
	foreach ($errors->all() as $error) {
		echo "<p class='alert alert-danger'>*".$error."</p>";
	}

}
?>

<div style="display:block; text-align:center; margin-top:100px; "> <! form >
	<form method="post" action="{{ route('subAltaExitosa') }}">
	@csrf
		<div class="form-group">
		<label for="residencia">Seleccione una residencia</label>
	 	 	<select class="form-control" name="residencia" id="residencia" value="{{ old('residencia') }}" autofocus>
	  		<?php
	  			$residencias = Residencia::all();
	 			foreach ($residencias as $res) {
	  		?>
	  				<option value= <?php echo '"'; echo $res->id; echo '"' ?> > <?php echo $res->id; ?> </option>
	  			<?php
	  			} //end foreach
	  			?>
			</select>
		</div>
		<div class="form-group">
			<label for="fecha">Seleccione una fecha de reserva</label>
			<input class="form-control" type="date" min=<?php $hoy=Carbon::today()->addMonth(6)->toDateString(); echo $hoy; ?> name="fecha" id="fecha" value="{{ old('fecha') }}" required>
		</div>
		<div class="form-group">
			<input class="form-control" type="number" step="any" name="monto" placeholder="Ingrese el monto mínimo" required>
		</div>
		<input type="submit" name="guardar" value="Guardar" class="btn btn-primary">
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
	<body>
	<div class="container">
	    <div class="content">

	        <div class="panel panel-default">
	            <div class="panel-body">
	                <div class="col-md-4 col-md-offset-4">

	                    <form action="/test/save" method="post">
	                        <div class="form-group">
	                            <label for="date">Fecha</label>
	                            <div class="input-group">
	                                <input type="text" class="form-control datepicker" name="date">
	                                <div class="input-group-addon">
	                                    <span class="glyphicon glyphicon-th"></span>
	                                </div>
	                            </div>
	                        </div>
	                        <button type="submit" class="btn btn-default btn-primary">Enviar</button>
	                    </form>

	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- <script>
		$('.datepicker').datepicker({
	    format: "dd/mm/yyyy",
			language:"es",
			startDate: '+6m',
			endDate: '+12m',
	    daysOfWeekDisabled: "0,2,3,4,5,6",
	    daysOfWeekHighlighted: "1",
	    autoclose: true
		});
	</script> -->

	</body>
	</html>

@endsection
