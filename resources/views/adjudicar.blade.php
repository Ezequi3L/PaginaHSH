@extends('layout')

@section('mainContent')
<?php
	use App\Subasta;
	use App\Residencia;
	use App\Oferta;
	use App\User;

if ($errors->any()) {
	foreach ($errors->all() as $error) {
		echo "<p class='alert alert-danger'>*".$error."</p>";
		?>
		<p><form method="POST" action="{{ route('deleteSub', [Subasta::find($id)]) }}">
			@csrf
			{{ method_field('DELETE') }}
			<button type="submit" class="btn btn-sm btn-outline-secondary">Sí</button>
		</form></p>
		<?php
	}
}

	$sub = Subasta::find($id);

	$ofertas = $sub->ofertas->sortBy('monto');
	$vacio= true;
	if ($ofertas->first() != null) {
		$vacio=false;
		$ofertas = $ofertas->reverse();
		$ofertaMaxima = $ofertas->first();
		$ganador = User::find($ofertaMaxima->usr_id);
		$text = "Ofertas para esta subasta";
	}
	else $text = "No hay ninguna oferta para esta subasta";

?>

<ul class="list-group">
  <li class="list-group-item" style="text-align: center; margin-top: 50px;"><h3>{{$text}}</h3>
	<?php if($vacio){
		?><form action="{{ route('deleteSub', [$sub]) }}" method="POST">
		 @csrf
			 {{ method_field('DELETE') }}
			 <button type="submit" onclick="return confirm('¿Está seguro de que desea eliminar la subasta?');" class="btn btn-sm btn-outline-danger">Eliminar</button>
		</form>
		<?php
		}
		else {
	 ?>
 </li>
</ul>

<table class="table">
	<thead class="thead-light">
	   <tr>
		 <th>Mail</th>
		 <th>Monto</th>
		 <th></th>
	   </tr>
	</thead>
	<tbody>

  <?php
  $mostrar = true;

  foreach ($ofertas as $oferta) {
  	$mail = User::find($oferta->usr_id)->email;


  ?>
  	<tr>
        <td>{{ $mail }}</td>
        <td>{{ $oferta->monto }}</td>
        <td>
        <?php
	        if(($oferta->usr_id == $ganador->id)&&($mostrar)) {
	  		$mostrar = false;
	  	?>
	  		<form method="POST" action="{{ route('saveAdj', [$id]) }}">
	  		 	@csrf
			<input type="hidden" name="oferta" value="{{ $ofertaMaxima->id }}">
	  		<button type="submit" class="btn btn-sm btn-outline-success">¡Ganador! - Adjudicar</button>
	  		</form>
  		<?php } ?>
  		</td>
    </tr>
<?php

	} //end foreach
	echo "</tbody>";
 	echo "</table>";
 } //end else
?>

@endsection
