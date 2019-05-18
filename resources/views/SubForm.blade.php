@extends('layout')

<?php
use  App\Residencia;
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
			<input class="form-control" type="date" name="fecha" id="fecha" value="{{ old('fecha') }}" required>
		</div>
		<div class="form-group">
			<input class="form-control" type="number" step="any" name="monto" placeholder="Ingrese el monto mínimo" required>
		</div>
		<input type="submit" name="guardar" value="Guardar" class="btn btn-primary">
	</form>

@endsection