@extends('layout')


@section('mainContent')

<?php

use App\Foto;


$fotos = Foto::select()->where('residencia_id',$id)->get();



 ?>

 <div style="text-align:center; margin-top:100px; "> <! form >
   <form method="post" action="{{ route('destroyfoto', [$id]) }}">
   {{ method_field('put') }}
   @csrf
     <div class="form-group">
         <label for="ubicacion_id">Fotos:</label>
         <select class="form-control" name="foto_id" id="foto_id">
           <?php
           foreach ($fotos as $foto) {
           ?>
               <option value="{{$foto->id}}">{{$foto->id}}</option>
             <?php
             } //end foreach
             ?>
         </select>
     </div>
     <a href="{{ route('viewRes', [$id]) }}"class="btn btn-primary">Cancelar</a>
     <input type="submit" name="guardar" value="Guardar cambios" class="btn btn-primary">
   </form>
 </div>

@endsection
