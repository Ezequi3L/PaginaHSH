@extends('layout')

@section('mainContent')

 <section class="jumbotron text-center">
    <div class="container">
      <img src= "/public/imagenes/logocompleto.png" style= "width: 70%; height: 70%;" >
      <p class="lead text-muted">Bienvenido. Aquí abajo le mostramos algunas de nuestras mejores residencias</p>
      <p>
        @if (Route::has('login'))
          @auth
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-primary my-2">LogOut</button>
            </form>
        @else
             <a class="btn btn-primary my-2" href="{{ route('login') }}">Login</a>
          @if (Route::has('register'))
            <a class="btn btn-secondary my-2" href="{{ route('register') }}">Register</a>
          @endif
          @endauth

        @endif

      </p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">

<?php
  use App\Residencia;
  use App\Ubiacion;

  $mostrar =  Residencia::all()->take(6);
  $imgnodisp = '/public/imagenes/img-nodisponible.jpg';

  foreach ($mostrar as $residencia) {

      $descripcion = $residencia->descripcion;
      $ubicacion = $residencia->ubicacion;
      $foto = $residencia->fotos()->first();
?>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src= <?php if ($foto != null){ echo '"'; echo $foto->src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
          </div>
        </div>

<?php

 }  //end foreach

?>

      </div>
    </div>
  </div>

@endsection

@section('headerContent')

      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted"></p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contáctenos</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white">support@hsh.com</a></li>
            <li><a href="{{ route('sucursales')}}">Sucursales</a></li>
          </ul>
        </div>
      </div>

@endsection

@section('footer')

<footer class="text-muted">
  <div class="container">
    <p class="float-right">
      <a href="#">Ir arriba</a>
    </p>
  </div>
</footer>

@endsection
