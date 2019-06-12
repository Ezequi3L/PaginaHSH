@extends('layout')

@section('mainContent')
<div style="text-align:center; margin-top:100px; "> <! form >
  <form method="post" action="{{ route('fotoexitosa', [$id]) }}"
      enctype="multipart/form-data">
  @csrf

    <input type="file" name="foto">
    <p>
    <a href="{{ route('viewRes', [$id]) }}"class="btn btn-primary">Cancelar</a>
    <input type="submit" name="guardar" value="Agregar" class="btn btn-primary">
  </p>
    </div>
  </form>
</div>

@endsection
