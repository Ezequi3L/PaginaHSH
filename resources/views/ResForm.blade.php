@extends('layout')

<?php
use  App\Provincia;
use  App\Localidad;
?>

@section('mainContent')

<?php

if ($errors->any()) {
	foreach ($errors->all() as $error) {
		echo "<p class='alert alert-danger'>*".$error."</p>";
	}
	
}	

if (isset($_POST['siguiente'])) {
	$desc = $_POST['descripcion'];
	$provId = $_POST['provincia'];


?>
  <div style="display:block; text-align:center; margin-top:100px; "> <! form de localidad >
	<form method="post" action="{{ route('altaExitosa') }}"> 
	@csrf
	  <div class="form-group">
	  	<label for="localidad">Seleccione una localidad</label>
 	 	<select class="form-control" name="localidad" id="localidad">		
  		<?php
  			$provSelect = Provincia::find($provId);
  			$localidades = $provSelect->localidades;
 			foreach ($localidades as $localidad) {
  		?>
  				<option value="{{$localidad->id}}">{{$localidad->localidad}}</option>
  			<?php
  			} //end foreach
  			?>
		</select>
	  </div>
	  	<input type="hidden" name="desc" value="{{$desc}}">
		<input type="submit" name="guardar" value="Guardar" class="btn btn-primary">
		<a href={{ route('crearResidencia') }} class="btn btn-primary">Seleccionar otra provincia</a>
	</form>
  </div>
<?php
} //endif
else {
?>
  <div style="display:block; text-align:center; margin-top:100px; "> <! form de provincia y descripción >
	<form id="formProv" method="post" action="{{ route('continuar') }}">
	@csrf
	<div class="form-group">
	  <textarea name="descripcion" rows="7" cols="30" placeholder="Ingrese una descripcion" required autofocus></textarea>
	 <!-- <input class="form-control" type="text" name="descripcion" id="descripcion" placeholder="Ingrese una descripcion" required autofocus>
	--></div>
	<div class="form-group">
	  <label for="provincia">Seleccione una provincia...</label>
	  <select class="form-control" name="provincia" id="provincia">
			<?php 
				$provincias = Provincia::all();
				foreach ($provincias as $provincia) {
			?>
	  				<option value= <?php echo '"'; echo $provincia->id; echo '"' ?> > <?php echo $provincia->provincia; ?> </option>
	 		<?php
	 			} //end foreach
	 		?>
	  </select>
	</div>
	   <input type="submit" name="siguiente" value="Siguiente" class="btn btn-primary">
	</form>
   </div>
<?php
} //endelse

?>


@endsection