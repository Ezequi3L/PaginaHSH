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
 $ubicacion = $residencia->ubicacion;
 $foto = $residencia->fotos()->first();
 $imgnodisp = '/public/imagenes/img-nodisponible.jpg';
 $actual = $subasta->oferta_maxima();
?>
 <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
		<div class="col-md-4" style="margin-inline: 100px;">
          <div class="card mb-4 shadow-sm">
             <img src= <?php if ($foto != null){ $src = $foto->src; echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
            <div class="card-body">
              <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", "; ?> </p>
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
					<input class="form-control" type="number" step="any" name="monto" placeholder="Ingrese el monto" required>
				</div>
				<input type="hidden" name="subasta_id" value="{{ $sub_id }}">
				<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
				<input type="submit" name="confirmar" value="Confirmar oferta" class="btn btn-primary">
			</form>
		</div>
 	  </div>
    </div>
 </div>





@endsection
