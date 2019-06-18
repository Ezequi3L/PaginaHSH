@extends('layout')


@section('mainContent')

<?php

use App\Foto;


$fotos = Foto::select()->where('residencia_id',$id)->get();

foreach ($fotos as $foto) {?>
  <li type="disc"><img src="<?php echo "$foto->src";?>" width="100" heigth="100"></li>
  <form method="POST" action="{{ route('BajaFotoOk', [$foto]) }}">
    @csrf
    {{ method_field('DELETE') }}
    <button type="submit" class="btn btn-sm btn-outline-secondary">Borrar</button>
  </form>
  <?php } ?>





@endsection
