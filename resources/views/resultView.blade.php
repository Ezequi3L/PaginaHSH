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



        <?php

        $imgnodisp = '/public/imagenes/img-nodisponible.jpg';
        ?>



        <?php
        use App\Residencia;


        if(isset($resultado3)){

        ?>

        <!-- HotSales activas -->
        <?php if(Auth::user()->tipo_de_usuario!=1){ ?>
        <section class="text-center">
          <div class="container">
            <p class="lead text-success">HotSales</p>
          </div>
        </section>
        <?php } ?>
        <?php
        if (count($resultado3)==0){
        ?>
        <div class="album py-5 bg-light">
        <h5 class="text-muted" style="text-align:center">No hay HotSales</h5>
        </div>
        <?php
        }
        else {
        ?>
        <div class="album py-5 bg-light">
          <div class="container">
            <div class="row">
        <?php
        foreach ($resultado3 as $hotsale) {

          $residencia = Residencia::find($hotsale->residencia_id);
          $descripcion = $residencia->descripcion;
          $ubicacion = $residencia->ubicacion->ubicacion;
          $foto = $residencia->fotos()->first();

        ?>

        <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
         <img src= <?php if ($foto != null){ $src = $foto->src; echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
          <div class="card-body">
            <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion; echo ", "; ?> </p>
            <p class="card-text"> <?php echo "Reserva: "; echo $hotsale->fecha_reserva; ?> </p>
            <p class="card-text"> <?php echo "Precio: "; echo $hotsale->monto; ?> </p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <?php if ((Auth::user()->tipo_de_usuario == 2)||(Auth::user()->tipo_de_usuario == 3)) {  ?>
                    <a href="{{ route('comprarHS', [$hotsale]) }}"><button type="button" class="btn btn-sm btn-primary">Comprar</button></a>
                <?php }
                if (Auth::user()->tipo_de_usuario == 0) {  ?>
                   <a href="{{ route('editHS', [$hotsale]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                   <form action="{{ route('deleteHS', [$hotsale]) }}" method="POST">
                    @csrf
                      {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                   </form>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        </div>

        <?php

        } //fin foreach
        ?>
        </div>
        </div>
        </div>
        <?php
      }
    }







        if ($resultado2!=NULL){
        if(Auth::user()->tipo_de_usuario!=2){
          ?>
          <section class="text-center">
           <div class="container">
             <p class="lead text-danger">Residencias</p>
           </div>
          </section>
          <?php
        if (count($resultado2)==0){
          ?>
          <div class="album py-5 bg-light">
          <h5 class="text-muted" style="text-align:center">No hay Residencias</h5>
          </div>
          <?php
        }
        else {
          ?>

          <div class="album py-5 bg-light">
            <div class="container">
              <div class="row">

              <?php

        foreach ($resultado2 as $residencia) {
          $descripcion = $residencia->descripcion;
          $ubicacion = $residencia->ubicacion;
          $imgnodisp = '/public/imagenes/img-nodisponible.jpg';
          $foto = $residencia->fotos()->first();
          $src = $residencia->fotos()->first();
          if ($src != null)  $src = $src->first()->src;

        ?>

          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <img src= <?php if ($foto != null){ $src = $foto->src; echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
              <div class="card-body">
                <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", "; ?> </p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                    <?php if (Auth::user()->tipo_de_usuario == 0) {  ?>
                        <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                        <a href="{{ route('crearSubasta', [$residencia->id]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Subastar</button></a>
                        <a href="{{ route('crearHotSale', [$residencia->id]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">HotSalear</button></a>
                        <form action="{{ route('aniquilarResidencia', [$residencia]) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                        </form>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <?php

        } //fin foreach

        ?>

        </div>
        </div>
        </div>
        <?php
        }
        }
      }
        ?>

        <?php
        if($subastas_activas!=NULL){
         ?>
        <!-- Subastas activas -->
        <section class="text-center">
         <div class="container">
           <p class="lead text-success">Subastas activas</p>
         </div>
        </section>

        <?php
        if(count($subastas_activas)==0){
          ?>
          <div class="album py-5 bg-light">
          <h5 class="text-muted" style="text-align:center">No hay subastas activas</h5>
          </div>
          <?php
        }
        else{
          ?>
          <div class="album py-5 bg-light">
          <div class="container">
          <div class="row">
          <?php

          foreach ($subastas_activas as $subasta) {

            $residencia = Residencia::find($subasta->residencia_id);
            $descripcion = $residencia->descripcion;
            $ubicacion = $residencia->ubicacion->ubicacion;
            $foto = $residencia->fotos()->first();

        ?>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
           <img src= <?php if ($foto != null){ $src = $foto->src; echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
            <div class="card-body">
              <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion; echo ", "; ?> </p>
              <p class="card-text"> <?php echo "Reserva: "; echo $subasta->fecha_reserva; ?> </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <?php if ((Auth::user()->tipo_de_usuario == 2)||(Auth::user()->tipo_de_usuario == 3)) {  ?>
                      <a href="{{ route('ofertar', [$subasta]) }}"><button type="button" class="btn btn-sm btn-primary">Ofertar</button></a>
                  <?php }
                  if (Auth::user()->tipo_de_usuario == 0) {  ?>
                     <a href="{{ route('editSub', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                     <form action="{{ route('deleteSub', [$subasta]) }}" method="POST">
                      @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                     </form>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php

          } //fin foreach
          ?>
          </div>
          </div>
          </div>
          <?php
        } //fin del else
      }
        ?>

        <?php
        if($subastas_programadas!=NULL){
         ?>
        <!-- Subastas programadas -->
        <section class="text-center">
         <div class="container">
           <p class="lead text-primary">Subastas programadas</p>
         </div>
        </section>

        <?php
        if(count($subastas_programadas)==0){
          ?>
          <div class="album py-5 bg-light">
          <h5 class="text-muted" style="text-align:center">No hay subastas programadas</h5>
          </div>
          <?php
        }
        else{
          ?>
          <div class="album py-5 bg-light">
          <div class="container">
          <div class="row">
          <?php

          foreach ($subastas_programadas as $subasta) {

            $residencia = Residencia::find($subasta->residencia_id);
            $descripcion = $residencia->descripcion;
            $ubicacion = $residencia->ubicacion->ubicacion;
            $foto = $residencia->fotos()->first();

        ?>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
           <img src= <?php if ($foto != null){ $src = $foto->src; echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
            <div class="card-body">
              <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion; echo ", "; ?> </p>
              <p class="card-text"> <?php echo "Reserva: "; echo $subasta->fecha_reserva; ?> </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <?php
                  if (Auth::user()->tipo_de_usuario == 0) {  ?>
                     <a href="{{ route('editSub', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                     <form action="{{ route('deleteSub', [$subasta]) }}" method="POST">
                      @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                     </form>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php

          } //fin foreach
          ?>
          </div>
          </div>
          </div>
          <?php
        } //fin del else
      }
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
