@extends('layout')

@section('mainContent')

<?php
if ($errors->any()) {
  foreach ($errors->all() as $error) {
    echo "<p class='alert alert-danger'>*".$error."</p>";
  }
}
?>
@if (session()->has('alert-success'))
 <script> alert("{{session()->get('alert-success')}}")</script>
@endif

<div style="text-align:center; margin-top:100px; "> <! form >
  <form method="post" action="{{ route('fotoexitosa', [$id]) }}"
      enctype="multipart/form-data">
  @csrf

    <input type="file" name="foto" accept="image/*">
    <p>
    <a href="{{ route('viewRes', [$id]) }}"class="btn btn-primary">Cancelar</a>
    <input type="submit" name="guardar" value="Agregar" class="btn btn-primary" >
  </p>
    </div>
  </form>
</div>

@endsection
