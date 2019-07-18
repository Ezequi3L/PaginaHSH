@extends('layout')

@section('headerContent')

<div class="row">
  <div class="col-sm-8 col-md-7 py-4">
        <h4><a href="{{ route('about')}}">Ayuda</a></h4>
    <p class="text-muted">
    </p>
  </div>
  <div class="col-sm-4 offset-md-1 py-4">
    <h4 class="text-white">Contáctenos
    </h4>
    <ul class="list-unstyled">
      <li>
        <a href="#" class="text-white">support@hsh.com
        </a>
      </li>
      <li>
        <a href="{{ route('sucursales')}}">Sucursales
        </a>
      </li>
    </ul>
  </div>
</div>

@endsection

@section('mainContent')
<img src=/public/imagenes/about.jpg style= "width: 110%; height: 110%; position: relative;>
@endsection
