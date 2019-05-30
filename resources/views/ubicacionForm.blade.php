@extends('layout')


@section('mainContent')

<div style="display:block; text-align:center; margin-top:100px; ">
<form id="formUbicacion" method="post" action="{{ route('altaUbicacion') }}">
@csrf
<div class="form-group">
  <input type="text" name="ubicacion" id="ubicacion" value="" placeholder="Ej: La Plata, Buenos Aires, Argentina.">
</div>
   <input type="submit" name="alta" value="alta" class="btn btn-primary">
</form>
 </div>

@endsection
