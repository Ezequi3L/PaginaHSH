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

if ($errors->any()) {
  foreach ($errors->all() as $error) {
    echo "<p class='alert alert-danger'>*".$error."</p>";
  }
}
  use App\Residencia;
  use App\Ubicacion;
  use App\Foto;

  $res = Residencia::find($id);
  $desc = $res->descripcion;
  $loc = $res->ubicacion;

?>

<div style="text-align:center; margin-top:100px; "> <! form >
  <form method="post" action="{{ route('updateExitoso', [$id]) }}">
  {{ method_field('put') }}
  @csrf
    <div class="form-group">
    <!-- <input class="form-control" type="text" name="descripcion" value="{{ old('descripcion', $desc) }}" required autofocus> -->
     <textarea name="descripcion" rows="7" cols="30" placeholder="{{ $desc }}" autofocus></textarea>
    </div>
    <div class="form-group">
        <label for="ubicacion_id">Ubicacion:</label>
        <select class="form-control" name="ubicacion_id" id="ubicacion" value="{{ $loc->id }}">
          <?php
            $ubicaciones = Ubicacion::all();
          foreach ($ubicaciones as $ubicacion) {
          ?>
              <option value="{{$ubicacion->id}}" <?php if($loc->id == $ubicacion->id) echo "selected"; ?>>{{$ubicacion->ubicacion}}</option>
            <?php
            } //end foreach
            ?>
        </select>
    </div>
    <a href="{{ route('viewRes', [$id]) }}"class="btn btn-primary">Cancelar</a>
    <input type="submit" name="guardar" value="Guardar cambios" class="btn btn-primary">
  </form>
      <a href="{{ route('upload', [$id]) }}"class="btn btn-primary" style="margin: 5px;" >Agregar foto</a>
</div>

@endsection
