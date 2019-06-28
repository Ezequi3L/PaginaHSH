  @extends('layout')

  @section('headerContent')

  <div class="row">
    <div class="col-sm-8 col-md-7 py-4">
      <h4 class="text-white">About
      </h4>
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
        <li>
          <a href="{{ route('viewUsr',[ Auth::user()->id]) }}" class="btn btn-primary" style="background-color: transparent; border: none;">
            <strong>Mi perfil
            </strong>
          </a>
        </li>
        <li>@if (Route::has('login'))
          @auth
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary" style="background-color: transparent; border: none;">
              <strong>LogOut
              </strong>
            </button>
          </form>
          @endauth
          @endif
        </li>
      </ul>
    </div>
  </div>

  @endsection

  @section('mainContent')

  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Home Switch Home
      </h1>
      <p class="lead text-muted">Resultados de la búsqueda
      </p>
    </div>
  </section>


  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
        <?php

        $imgnodisp = '/public/imagenes/img-nodisponible.jpg';
        ?>

      </div>
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
