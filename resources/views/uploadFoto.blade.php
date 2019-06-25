@extends('layout')

@section('mainContent')

<?php
if ($errors->any()) {
  foreach ($errors->all() as $error) {
    echo "<p class='alert alert-danger'>*".$error."</p>";
  }
}
?>

<div style="text-align:center; margin-top:100px; "> <! form >
  <form method="post" action="{{ route('fotoexitosa', [$id]) }}"
      enctype="multipart/form-data">
  @csrf

    <input type="file" name="foto" accept="image/*">
    <p>
    <a href="{{ route('editRes', [$id]) }}"class="btn btn-primary">Cancelar</a>
    <input type="submit" name="guardar" value="Agregar" class="btn btn-primary" >
  </p>
    </div>
  </form>
</div>

@endsection
