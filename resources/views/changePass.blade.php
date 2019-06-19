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

use App\User;

$usr = User::find($id);

?>

<div style="text-align:center; margin-top:100px; "> <! form >
  <form method="post" action="{{ route('updatePass', [$id]) }}">
  {{ method_field('put') }}
  @csrf
    <div class="form-group">
        <label for="actual">Contraseña actual: </label>
        <input class="form-control" type="password" name="actual" autofocus>
    </div>
    <div class="form-group">
        <label for="password">Contraseña nueva: </label>
        <input class="form-control" type="password" name="password">
    </div>
    <div class="form-group">
        <label for="password_confirmation">Repita la contraseña nueva: </label>
        <input class="form-control" type="password" name="password_confirmation">
    </div>
    <a href="{{ route('viewUsr', [$id]) }}"class="btn btn-danger">Cancelar</a>
    <input type="submit" name="guardar" value="Guardar cambios" class="btn btn-success">
  </form>
</div>



@endsection
