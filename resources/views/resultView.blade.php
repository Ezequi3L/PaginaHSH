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
      <li><a href="#" class="text-white">support@hsh.com</a></li>
      <li><a href="{{ route('sucursales')}}">Sucursales</a></li>
      <li><a href="{{ route('viewUsr',[ Auth::user()->id]) }}" class="btn btn-primary" style="background-color: transparent; border: none;">
        <strong>Mi perfil</strong></a>
      </li>
      <li>@if (Route::has('login'))
        @auth
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-primary" style="background-color: transparent; border: none;"><strong>LogOut</strong></button>
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
    <h1 class="jumbotron-heading">Home Switch Home</h1>
    <p class="lead text-muted">Resultados de la búsqueda</p>
  </div>
</section>


<div class="album py-5 bg-light">
  <div class="container">
    <div class="row">
      <?php
      use App\Subasta;
      use App\Residencia;
      use App\Reserva;
      use Carbon\Carbon;
      $imgnodisp = '/public/imagenes/img-nodisponible.jpg';

      if (isset($_GET['buscar'])){
        if (($_GET['search'] != NULL) and ($_GET['ubicacion'] != NULL) and (($_GET['fecha_reserva1']) !=NULL)) {
          $accion =1;
        }
        else{
          if (($_GET['search'] != NULL) and ($_GET['ubicacion'] !=NULL)) {
            $accion =2;

          }
          else{
            if (($_GET['search'] != NULL) and (($_GET['fecha_reserva1']) != NULL)){
              $accion =3;
              }
              else{
                if(($_GET['ubicacion'] != NULL) and (($_GET['fecha_reserva1']) !=NULL)){
                  $accion =4;
                }
                else{
                  if ($_GET['search'] !=NULL){
                    $accion=5;
                  }
                  else{
                    if ($_GET['ubicacion'] != NULL){
                      $accion=6;
                    }
                    else{
                      if(($_GET['fecha_reserva1']) !=NULL){
                        $accion=7;}
                      else{
                        $accion=8;
                      }
                    }
                  }
                }
              }
            }
          }

        if ($_GET['fecha_reserva1'] != NULL){
          $_GET['fecha_reserva1']=Carbon::createFromFormat('d/m/Y',$_GET['fecha_reserva1'])->format('Y-m-d');
          $dif1=Carbon::createFromFormat('Y-m-d',$_GET['fecha_reserva1']);

        }
        if ($_GET['fecha_reserva2'] != NULL){
          $carb=Carbon::create($_GET['fecha_reserva1'])->addMonth(2)->format('Y-m-d');
          $_GET['fecha_reserva2']=Carbon::createFromFormat('d/m/Y',$_GET['fecha_reserva2'])->format('Y-m-d');
          $dif2=Carbon::createFromFormat('Y-m-d',$_GET['fecha_reserva2']);
          $difweek=$dif1->diffInWeeks($dif2);
        }
//LAS CONSULTAS PARA LA FECHA TIENEN QUE SER DEL ESTILO DE "MOSTRAME TODAS LAS
//RESIDENCIAS QUE NO ESTEN EN ESTA OTRA CONSULTA(CONSULTA QUE BUSCA TODAS LAS RESIDENCIAS SIN SEMANAS DISPONIBLES)"

    //imprimir subastas segun switch
        switch ($accion) {
          case 1:{
            if (isset($_GET['subasta'])){
              if ($_GET['fecha_reserva2'] != NULL) {

                $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
                ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
                ->where('residencias.ubicacion_id',$_GET['ubicacion'])
                ->whereBetween('subastas.fecha_reserva', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])
                ->get();
              }
              else {

                $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
                ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
                ->where('residencias.ubicacion_id',$_GET['ubicacion'])
                ->whereBetween('subastas.fecha_reserva', [$_GET['fecha_reserva1'], $carb])
                ->get();
              }

              foreach ($resultado as $subasta) {

                $residencia = Residencia::find($subasta->residencia_id);
                $descripcion = $residencia->descripcion;
                $ubicacion = $residencia->ubicacion;
                $src = $residencia->fotos()->first();
                if ($src != null)  $src = $src->first()->src;
                //imprimir resultado de nuevo si es que anda
                ?>
                <div class="col-md-4">
                  <div class="card mb-4 shadow-sm">
                    <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                    <div class="card-body">
                      <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                      <p class="card-text"> <?php echo "Reserva:" ; echo $subasta->fecha_reserva; ?> </p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                          <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                          <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                          <a href="{{ route('ofertar', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ofertar</button></a>
                          <a href="{{ route('editSub', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar subasta</button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <?php


              }
            }
            if (isset($_GET['residencia'])){
              if ($_GET['fecha_reserva2'] != NULL) {
                $notin=Reserva::select('reservas.residencia_id')
                ->join('residencias','residencias.id','=','reservas.residencia_id')
                ->whereBetween('reservas.fecha', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])
                ->groupBy('reservas.residencia_id')
                ->havingRaw('COUNT(*) = '.++$difweek)
                ->get();

                $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
                ->where('residencias.dada_de_baja',0)
                ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
                ->where('residencias.ubicacion_id',$_GET['ubicacion'])
                ->whereNotIn('residencias.id', $notin)
                ->get();

              }
              else {
                $notin=Reserva::select('reservas.residencia_id')
                ->join('residencias','residencias.id','=','reservas.residencia_id')
                ->whereBetween('reservas.fecha', [$_GET['fecha_reserva1'], $carb])
                ->groupBy('reservas.residencia_id')
                ->havingRaw('COUNT(*) = '.++$difweek)
                ->get();

                $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
                ->where('residencias.dada_de_baja',0)
                ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
                ->where('residencias.ubicacion_id',$_GET['ubicacion'])
                ->whereNotIn('residencias.id', $notin)
                ->get();
              }
                foreach ($resultado as $residencia) {

                  $res = Residencia::find($residencia->id);
                  $ubicacion = $residencia->ubicacion;
                  $src = $res->fotos()->first();
                  if ($src != null)  $src = $src->first()->src;
                  //imprimir resultado de nuevo si es que anda
                  ?>
                  <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                      <p>&nbsp;Residencia</p>
                      <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                      <div class="card-body">
                        <p class="card-text"> <?php echo $residencia->descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                              <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                              <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php
                  }
            }
            if (isset($_GET['hot_sale'])){
              if ($_GET['fecha_reserva2'] != NULL) {

                $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')
                ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
                ->where('residencias.ubicacion_id',$_GET['ubicacion'])
                ->whereBetween('hotsales.fecha_reserva', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])
                ->get();
              }
              else {

                $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')
                ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
                ->where('residencias.ubicacion_id',$_GET['ubicacion'])
                ->whereBetween('hotsales.fecha_reserva', [$_GET['fecha_reserva1'], $carb])
                ->get();
              }

              foreach ($resultado as $hotsale) {

                $residencia = Residencia::find($hotsale->residencia_id);
                $descripcion = $residencia->descripcion;
                $ubicacion = $residencia->ubicacion;
                $src = $residencia->fotos()->first();
                if ($src != null)  $src = $src->first()->src;
                //imprimir resultado de nuevo si es que anda
                ?>
                <div class="col-md-4">
                  <div class="card mb-4 shadow-sm">
                    <p>&nbsp;Hot Sale</p>
                   <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
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


              }
            }
            break;
          }
          case 2:{
            if (isset($_GET['subasta'])){
            $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
            ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
            ->where('residencias.ubicacion_id',$_GET['ubicacion'])->get();

            foreach ($resultado as $subasta) {

              $residencia = Residencia::find($subasta->residencia_id);
              $descripcion = $residencia->descripcion;
              $ubicacion = $residencia->ubicacion;
              $src = $residencia->fotos()->first();
              if ($src != null)  $src = $src->first()->src;
              //imprimir resultado de nuevo si es que anda
              ?>
              <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                  <p>&nbsp;Subasta</p>
                  <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                  <div class="card-body">
                    <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                    <p class="card-text"> <?php echo "Reserva:"; echo $subasta->fecha_reserva; ?> </p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                        <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                        <a href="{{ route('ofertar', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ofertar</button></a>
                        <a href="{{ route('editSub', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar subasta</button></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <?php
            }
            }
            if (isset($_GET['residencia'])){
            $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
              ->where('residencias.dada_de_baja','false')
              ->where('residencias.ubicacion_id',$_GET['ubicacion'])->get();


              foreach ($resultado as $residencia) {

                  $res = Residencia::find($residencia->id);
                  $ubicacion = $residencia->ubicacion;
                  $src = $res->fotos()->first();
                  if ($src != null)  $src = $src->first()->src;
                //imprimir resultado de nuevo si es que anda
                ?>
                <div class="col-md-4">
                  <div class="card mb-4 shadow-sm">
                     <p>&nbsp;Residencia</p>
                    <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                      <div class="card-body">
                        <p class="card-text"> <?php echo $residencia->descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                              <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                              <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                <?php
              }
              }
              if (isset($_GET['hot_sale'])){
                if ($_GET['fecha_reserva2'] != NULL) {

                  $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')
                  ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
                  ->where('residencias.ubicacion_id',$_GET['ubicacion'])
                  ->get();
                }
                else {

                  $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')
                  ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
                  ->where('residencias.ubicacion_id',$_GET['ubicacion'])
                  ->get();
                }

                foreach ($resultado as $hotsale) {

                  $residencia = Residencia::find($hotsale->residencia_id);
                  $descripcion = $residencia->descripcion;
                  $ubicacion = $residencia->ubicacion;
                  $src = $residencia->fotos()->first();
                  if ($src != null)  $src = $src->first()->src;
                  //imprimir resultado de nuevo si es que anda
                  ?>
                  <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                      <p>&nbsp;Hot Sale</p>
                     <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
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


                }
              }
            break;
          }
          case 3:{
            if (isset($_GET['subasta'])){
            if ($_GET['fecha_reserva2'] != NULL) {
              $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
              ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
              ->whereBetween('subastas.fecha_reserva', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])->get();
            }
            else {
              $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
              ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
              ->whereBetween('subastas.fecha_reserva', [$_GET['fecha_reserva1'], $carb])->get();
            }

            foreach ($resultado as $subasta) {

              $residencia = Residencia::find($subasta->residencia_id);
              $descripcion = $residencia->descripcion;
              $ubicacion = $residencia->ubicacion;
              $src = $residencia->fotos()->first();
              if ($src != null)  $src = $src->first()->src;
              //imprimir resultado de nuevo si es que anda
              ?>
              <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                  <p>&nbsp;Subasta</p>
                  <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                  <div class="card-body">
                    <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                    <p class="card-text"> <?php echo "Reserva:"; echo $subasta->fecha_reserva; ?> </p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                        <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                        <a href="{{ route('ofertar', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ofertar</button></a>
                        <a href="{{ route('editSub', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar subasta</button></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <?php
            }
            }
            if (isset($_GET['residencia'])){
            if ($_GET['fecha_reserva2'] != NULL) {
              $notin=Reserva::select('reservas.residencia_id')
              ->join('residencias','residencias.id','=','reservas.residencia_id')
              ->whereBetween('reservas.fecha', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])
              ->groupBy('reservas.residencia_id')
              ->havingRaw('COUNT(*) = '.++$difweek)
              ->get();
              $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->where('residencias.dada_de_baja',0)
              ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
              ->whereNotIn('residencias.id', $notin)
              ->get();
                }
            else {
              $notin=Reserva::select('reservas.residencia_id')
              ->join('residencias','residencias.id','=','reservas.residencia_id')
              ->whereBetween('reservas.fecha', [$_GET['fecha_reserva1'], $carb])
              ->groupBy('reservas.residencia_id')
              ->havingRaw('COUNT(*) = '.++$difweek)
              ->get();

              $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->where('residencias.dada_de_baja',0)
              ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
              ->whereNotIn('residencias.id', $notin)
              ->get();
            }
            foreach ($resultado as $residencia) {

                $res = Residencia::find($residencia->id);
                $ubicacion = $residencia->ubicacion;
                $src = $res->fotos()->first();
                if ($src != null)  $src = $src->first()->src;
              //imprimir resultado de nuevo si es que anda
              ?>
              <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                   <p>&nbsp;Residencia</p>
                  <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                    <div class="card-body">
                      <p class="card-text"> <?php echo $residencia->descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                            <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

              <?php
            }
            }
            if (isset($_GET['hot_sale'])){
              if ($_GET['fecha_reserva2'] != NULL) {

                $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')
                ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
                ->whereBetween('hotsales.fecha_reserva', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])
                ->get();
              }
              else {

                $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')
                ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
                ->whereBetween('hotsales.fecha_reserva', [$_GET['fecha_reserva1'], $carb])
                ->get();
              }

              foreach ($resultado as $hotsale) {

                $residencia = Residencia::find($hotsale->residencia_id);
                $descripcion = $residencia->descripcion;
                $ubicacion = $residencia->ubicacion;
                $src = $residencia->fotos()->first();
                if ($src != null)  $src = $src->first()->src;
                //imprimir resultado de nuevo si es que anda
                ?>
                <div class="col-md-4">
                  <div class="card mb-4 shadow-sm">
                    <p>&nbsp;Hot Sale</p>
                    <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
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


              }
            }
            break;
          }
          case 4:{
            if (isset($_GET['subasta'])){
            if ($_GET['fecha_reserva2'] != NULL) {
              $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
              ->where('residencias.ubicacion_id',$_GET['ubicacion'])
              ->whereBetween('subastas.fecha_reserva', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])->get();
            }
            else {
              $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
              ->where('residencias.ubicacion_id',$_GET['ubicacion'])
              ->whereBetween('subastas.fecha_reserva', [$_GET['fecha_reserva1'], $carb])->get();
            }

            foreach ($resultado as $subasta) {

              $residencia = Residencia::find($subasta->residencia_id);
              $descripcion = $residencia->descripcion;
              $ubicacion = $residencia->ubicacion;
              $src = $residencia->fotos()->first();
              if ($src != null)  $src = $src->first()->src;
              //imprimir resultado de nuevo si es que anda
              ?>

              <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                  <p>&nbsp;Subasta</p>
                  <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                  <div class="card-body">
                    <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                    <p class="card-text"> <?php echo "Reserva:" ;echo $subasta->fecha_reserva; ?> </p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                        <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                        <a href="{{ route('ofertar', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ofertar</button></a>
                        <a href="{{ route('editSub', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar subasta</button></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <?php
            }
            }
            if (isset($_GET['residencia'])){
            if ($_GET['fecha_reserva2'] != NULL) {
              $notin=Reserva::select('reservas.residencia_id')
              ->join('residencias','residencias.id','=','reservas.residencia_id')
              ->whereBetween('reservas.fecha', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])
              ->groupBy('reservas.residencia_id')
              ->havingRaw('COUNT(*) = '.++$difweek)
              ->get();

              $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->where('residencias.dada_de_baja',0)
              ->where('residencias.ubicacion_id',$_GET['ubicacion'])
              ->whereNotIn('residencias.id', $notin)
              ->get();

            }
            else {
              $notin=Reserva::select('reservas.residencia_id')
              ->join('residencias','residencias.id','=','reservas.residencia_id')
              ->whereBetween('reservas.fecha', [$_GET['fecha_reserva1'],$carb])
              ->groupBy('reservas.residencia_id')
              ->havingRaw('COUNT(*) = '.++$difweek)
              ->get();

              $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->where('residencias.dada_de_baja',0)
              ->where('residencias.ubicacion_id',$_GET['ubicacion'])
              ->whereNotIn('residencias.id', $notin)
              ->get();
            }
            foreach ($resultado as $residencia) {

                $res = Residencia::find($residencia->id);
                $ubicacion = $residencia->ubicacion;
                $src = $res->fotos()->first();
                if ($src != null)  $src = $src->first()->src;
              //imprimir resultado de nuevo si es que anda
              ?>
              <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                   <p>&nbsp;Residencia</p>
                  <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                    <div class="card-body">
                      <p class="card-text"> <?php echo $residencia->descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                            <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

              <?php
            }
            }
            if (isset($_GET['hot_sale'])){
              if ($_GET['fecha_reserva2'] != NULL) {

                $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')
                ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
                ->where('residencias.ubicacion_id',$_GET['ubicacion'])
                ->whereBetween('hotsales.fecha_reserva', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])
                ->get();
              }
              else {

                $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')
                ->where('residencias.ubicacion_id',$_GET['ubicacion'])
                ->whereBetween('hotsales.fecha_reserva', [$_GET['fecha_reserva1'], $carb])
                ->get();
              }

              foreach ($resultado as $hotsale) {

                $residencia = Residencia::find($hotsale->residencia_id);
                $descripcion = $residencia->descripcion;
                $ubicacion = $residencia->ubicacion;
                $src = $residencia->fotos()->first();
                if ($src != null)  $src = $src->first()->src;
                //imprimir resultado de nuevo si es que anda
                ?>
                <div class="col-md-4">
                  <div class="card mb-4 shadow-sm">
                    <p>&nbsp;Hot Sale</p>
                    <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
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


              }
            }
            break;
          }
          case 5:{
            if (isset($_GET['subasta'])){

            $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
            ->where('residencias.descripcion','like','%'.$_GET['search'].'%')->get();

            foreach ($resultado as $subasta) {

              $residencia = Residencia::find($subasta->residencia_id);
              $descripcion = $residencia->descripcion;
              $ubicacion = $residencia->ubicacion;
              $src = $residencia->fotos()->first();
              if ($src != null)  $src = $src->first()->src;
              //imprimir resultado de nuevo si es que anda
              ?>

              <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                  <p>&nbsp;Subasta</p>
                  <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                  <div class="card-body">
                    <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                    <p class="card-text"> <?php echo "Reserva:" ;echo $subasta->fecha_reserva; ?> </p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                        <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                        <a href="{{ route('ofertar', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ofertar</button></a>
                        <a href="{{ route('editSub', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar subasta</button></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <?php
            }
            }
            if(isset($_GET['residencia'])){
            $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
            ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
            ->where('residencias.dada_de_baja',0)->get();
            foreach ($resultado as $residencia) {

                $res = Residencia::find($residencia->id);
                $ubicacion = $residencia->ubicacion;
                $src = $res->fotos()->first();
                if ($src != null)  $src = $src->first()->src;
              //imprimir resultado de nuevo si es que anda
              ?>
              <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                   <p>&nbsp;Residencia</p>
                  <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                    <div class="card-body">
                      <p class="card-text"> <?php echo $residencia->descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                            <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

              <?php
            }
            }
            if (isset($_GET['hot_sale'])){
              if ($_GET['fecha_reserva2'] != NULL) {

                $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')
                ->where('residencias.descripcion','like','%'.$_GET['search'].'%')

                ->get();
              }
              else {

                $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')
                ->where('residencias.descripcion','like','%'.$_GET['search'].'%')

                ->get();
              }

              foreach ($resultado as $hotsale) {

                $residencia = Residencia::find($hotsale->residencia_id);
                $descripcion = $residencia->descripcion;
                $ubicacion = $residencia->ubicacion;
                $src = $residencia->fotos()->first();
                if ($src != null)  $src = $src->first()->src;
                //imprimir resultado de nuevo si es que anda
                ?>
                <div class="col-md-4">
                  <div class="card mb-4 shadow-sm">
                    <p>&nbsp;Hot Sale</p>
                    <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
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


              }
            }
            break;
          }
          case 6:{
            if (isset($_GET['subasta'])){
            $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
            ->where('residencias.ubicacion_id',$_GET['ubicacion'])->distinct()->get();

            foreach ($resultado as $subasta) {

              $residencia = Residencia::find($subasta->residencia_id);
              $descripcion = $residencia->descripcion;
              $ubicacion = $residencia->ubicacion;
              $src = $residencia->fotos()->first();
              if ($src != null)  $src = $src->first()->src;
              //imprimir resultado de nuevo si es que anda
              ?>

              <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                  <p>&nbsp;Subasta</p>
                  <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                  <div class="card-body">
                    <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                    <p class="card-text"> <?php echo "Reserva:" ;echo $subasta->fecha_reserva; ?> </p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                        <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                        <a href="{{ route('ofertar', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ofertar</button></a>
                        <a href="{{ route('editSub', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar subasta</button></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <?php
              }
              }
              if(isset($_GET['residencia'])){
              $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->where('residencias.ubicacion_id',$_GET['ubicacion'])
              ->where('residencias.dada_de_baja','false')->get();

              foreach ($resultado as $residencia) {

                  $res = Residencia::find($residencia->id);
                  $ubicacion = $residencia->ubicacion;
                  $src = $res->fotos()->first();
                  if ($src != null)  $src = $src->first()->src;
                //imprimir resultado de nuevo si es que anda
                ?>
                <div class="col-md-4">
                  <div class="card mb-4 shadow-sm">
                     <p>&nbsp;Residencia</p>
                    <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                      <div class="card-body">
                        <p class="card-text"> <?php echo $residencia->descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                              <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                              <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                <?php
              }
              }
              if (isset($_GET['hot_sale'])){
                if ($_GET['fecha_reserva2'] != NULL) {

                  $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')

                  ->where('residencias.ubicacion_id',$_GET['ubicacion'])
                  ->get();
                }
                else {

                  $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')
                  ->where('residencias.ubicacion_id',$_GET['ubicacion'])
                  ->get();
                }

                foreach ($resultado as $hotsale) {

                  $residencia = Residencia::find($hotsale->residencia_id);
                  $descripcion = $residencia->descripcion;
                  $ubicacion = $residencia->ubicacion;
                  $src = $residencia->fotos()->first();
                  if ($src != null)  $src = $src->first()->src;
                  //imprimir resultado de nuevo si es que anda
                  ?>
                  <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                      <p>&nbsp;Hot Sale</p>
                    <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
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


                }
              }
              break;
            }
          case 7:{
            if (isset($_GET['subasta'])){
            if ($_GET['fecha_reserva2'] != NULL) {
              $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
              ->whereBetween('subastas.fecha_reserva', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])->get();}
              else {
                $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
                ->whereBetween('subastas.fecha_reserva', [$_GET['fecha_reserva1'], $carb])->get();}

                foreach ($resultado as $subasta) {

                  $residencia = Residencia::find($subasta->residencia_id);
                  $descripcion = $residencia->descripcion;
                  $ubicacion = $residencia->ubicacion;
                  $src = $residencia->fotos()->first();
                  if ($src != null)  $src = $src->first()->src;
                  //imprimir resultado de nuevo si es que anda
                  ?>

                  <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                      <p>&nbsp;Subasta</p>
                      <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                      <div class="card-body">

                        <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                        <p class="card-text"> <?php echo "Reserva:" ;echo $subasta->fecha_reserva; ?> </p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                            <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                            <a href="{{ route('ofertar', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ofertar</button></a>
                            <a href="{{ route('editSub', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar subasta</button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <?php
                }
                }
                if(isset($_GET['residencia'])){
                if ($_GET['fecha_reserva2'] != NULL) {
                  $notin=Reserva::select('reservas.residencia_id')
                  ->join('residencias','residencias.id','=','reservas.residencia_id')
                  ->whereBetween('reservas.fecha', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])
                  ->groupBy('reservas.residencia_id')
                  ->havingRaw('COUNT(*) = '.++$difweek)
                  ->get();

                  $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
                  ->where('residencias.dada_de_baja',0)
                  ->whereNotIn('residencias.id', $notin)
                  ->get();

                }
                else {

                  $notin=Reserva::select('reservas.residencia_id')
                  ->join('residencias','residencias.id','=','reservas.residencia_id')
                  ->whereBetween('reservas.fecha', [$_GET['fecha_reserva1'],$carb])
                  ->groupBy('reservas.residencia_id')
                  ->havingRaw('COUNT(*) = '.++$difweek)
                  ->get();

                  $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
                  ->where('residencias.dada_de_baja',0)
                  ->whereNotIn('residencias.id', $notin)
                  ->get();
                }
                foreach ($resultado as $residencia) {

                    $res = Residencia::find($residencia->id);
                    $ubicacion = $residencia->ubicacion;
                    $src = $res->fotos()->first();
                    if ($src != null)  $src = $src->first()->src;
                  //imprimir resultado de nuevo si es que anda
                  ?>
                  <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                       <p>&nbsp;Residencia</p>
                      <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                        <div class="card-body">
                          <p class="card-text"> <?php echo $residencia->descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="btn-group">
                                <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                                <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                  <?php
                }
                }
                if (isset($_GET['hot_sale'])){
                  if ($_GET['fecha_reserva2'] != NULL) {

                    $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')
                    ->whereBetween('hotsales.fecha_reserva', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])
                    ->get();
                  }
                  else {

                    $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')
                    ->whereBetween('hotsales.fecha_reserva', [$_GET['fecha_reserva1'], $carb])
                    ->get();
                  }

                  foreach ($resultado as $hotsale) {

                    $residencia = Residencia::find($hotsale->residencia_id);
                    $descripcion = $residencia->descripcion;
                    $ubicacion = $residencia->ubicacion;
                    $src = $residencia->fotos()->first();
                    if ($src != null)  $src = $src->first()->src;
                    //imprimir resultado de nuevo si es que anda
                    ?>
                    <div class="col-md-4">
                      <div class="card mb-4 shadow-sm">
                        <p>&nbsp;Hot Sale</p>
                        <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
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


                  }
                }
                break;
              }
          case 8:{
              if (isset($_GET['subasta'])){
              $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')->get();

              foreach ($resultado as $subasta) {

                $residencia = Residencia::find($subasta->residencia_id);
                $descripcion = $residencia->descripcion;
                $ubicacion = $residencia->ubicacion;
                $src = $residencia->fotos()->first();
                if ($src != null)  $src = $src->first()->src;
                //imprimir resultado de nuevo si es que anda
                ?>

                <div class="col-md-4">
                  <div class="card mb-4 shadow-sm">
                    <p>&nbsp;Subasta</p>
                    <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                    <div class="card-body">
                      <p class="card-text"> <?php echo $descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                      <p class="card-text"> <?php echo "Reserva:" ;echo $subasta->fecha_reserva; ?> </p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                          <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                          <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                          <a href="{{ route('ofertar', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ofertar</button></a>
                          <a href="{{ route('editSub', [$subasta]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar subasta</button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <?php
              }
              }
              if(isset($_GET['residencia'])){
              $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->where('residencias.dada_de_baja','false')->get();

              foreach ($resultado as $residencia) {

                  $res = Residencia::find($residencia->id);
                  $ubicacion = $residencia->ubicacion;
                  $src = $res->fotos()->first();
                  if ($src != null)  $src = $src->first()->src;
                //imprimir resultado de nuevo si es que anda
                ?>
                <div class="col-md-4">
                  <div class="card mb-4 shadow-sm">
                     <p>&nbsp;Residencia</p>
                    <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
                      <div class="card-body">
                        <p class="card-text"> <?php echo $residencia->descripcion; echo "</br>"; echo $ubicacion->ubicacion; echo ", ";  ?> </p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                              <a href="{{ route('viewRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Ver</button></a>
                              <a href="{{ route('editRes', [$residencia]) }}"><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                <?php
              }
              }
              if (isset($_GET['hot_sale'])){
                if ($_GET['fecha_reserva2'] != NULL) {

                  $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')
                  ->get();
                }
                else {

                  $resultado = Residencia::select()->join('hotsales','residencias.id','=','hotsales.residencia_id')
                  ->get();
                }

                foreach ($resultado as $hotsale) {

                  $residencia = Residencia::find($hotsale->residencia_id);
                  $descripcion = $residencia->descripcion;
                  $ubicacion = $residencia->ubicacion;
                  $src = $residencia->fotos()->first();
                  if ($src != null)  $src = $src->first()->src;
                  //imprimir resultado de nuevo si es que anda
                  ?>
                  <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                      <p>&nbsp;Hot Sale</p>
                      <img src= <?php if ($src != null){ echo '"'; echo $src; echo '"';} else{echo '"'; echo $imgnodisp; echo '"';} ?>>
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


                }
              }
              break;

            }
        }

            if (!(((isset($_GET['subasta'])) or (isset($_GET['residencia'])) or isset($_GET['hot_sale'])))){
              echo "Seleccione el tipo de busqueda que desea";
            }

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
