@extends('layout')

@section('mainContent')

<?php
	use App\Subasta;
	use App\Residencia;
	use App\Oferta;

	$sub = Subasta::find($id);

	$ofertas = $sub->ofertas->sortBy('monto');
	$ofertas = $ofertas->reverse();
	
	$ofertaMaxima = $ofertas->first();
	$ganador = $ofertaMaxima->mail;


	
?>

<ul class="list-group">
  <li class="list-group-item"><h3>Ofertas para esta subasta</h3></li>

  <?php

  foreach ($ofertas as $oferta) { 

  ?> 

  	<li class="list-group-item">Mail: {{ $oferta->mail }} | Monto: {{ $oferta->monto }} <?php  if($oferta->mail == $ganador)
  		echo '<a href="save/'.$id.'">¡Ganador! - Adjudicar</a>'; ?> </li>

  <?php
	} //end foreach
  ?>

</ul>

@endsection