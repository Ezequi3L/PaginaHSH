@extends('layout')

<?php
use  App\Subasta;
use App\Residencia;
?>

@section('mainContent')

<?php
if ($errors->any()) {
	foreach ($errors->all() as $error) {
		echo "<p class='alert alert-danger'>*".$error."</p>";
	}	
}

 $subasta = Subasta::find($sub_id);
 $residencia = Residencia::find($subasta->residencia_id);
 $descripcion = $residencia->descripcion;
 $localidad = $residencia->localidad;
 $provincia = $localidad->provincia;
 $src = ($residencia->foto)->src;
 $actual = $subasta->oferta_maxima();
?>
 <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
		<div class="col-md-4" style="margin-inline: 100px;">
          <div class="card mb-4 shadow-sm">
            <img src="<?php echo $src; ?>">
            <div class="card-body">
              <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $localidad->localidad; echo ", "; echo $provincia->provincia; ?> </p>
              <div class="d-flex justify-content-between align-items-center">
              </div>
            </div>
          </div>
     	</div>
     	<div style="text-align:center; margin-top:100px; "> <! form >
     		<p>Monto actual de la subasta: ${{ $actual }}</p>
			<form method="post" action="{{ route('subOfertaExitosa') }}"> 
			@csrf
				<div class="form-group">
					<input class="form-control" type="email" name="mail" placeholder="Ingrese su correo electrónico" required autofocus>
				</div>
				<div class="form-group">
					<input class="form-control" type="number" step="any" name="monto" placeholder="Ingrese el monto" required>
				</div>
				<input type="hidden" name="subasta_id" value="{{ $sub_id }}">
				<input type="submit" name="confirmar" value="Confirmar oferta" class="btn btn-primary">
			</form>
		</div>
 	  </div>
    </div>
 </div>





@endsection