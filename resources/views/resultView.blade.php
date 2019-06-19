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
    $_GET['fecha_reserva2']=Carbon::createFromFormat('d/m/Y',$_GET['fecha_reserva2'])->format('Y-m-d');
    $dif2=Carbon::createFromFormat('Y-m-d',$_GET['fecha_reserva2']);
    $difweek=$dif1->diffInWeeks($dif2);
  }

  if (isset($_GET['subasta'])){
    //imprimir subastas segun switch
    switch ($accion) {
      case 1:{
        if ($_GET['fecha_reserva2'] != NULL) {

          $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
          ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
          ->where('residencias.ubicacion_id',$_GET['ubicacion'])
          ->whereBetween('subastas.fecha_reserva', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])
          ->get();
        }
        else {
          $carb=Carbon::create($_GET['fecha_reserva1'])->addMonth(2);
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
       break;
      }
      case 2:
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
                break;
              case 3:

              if ($_GET['fecha_reserva2'] != NULL) {
              $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
              ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
              ->whereBetween('subastas.fecha_reserva', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])->get();}
              else {
                  $carb=Carbon::create($_GET['fecha_reserva1'])->addMonth(2);
                  $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
                  ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
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
                break;
              case 4:
              if ($_GET['fecha_reserva2'] != NULL) {
              $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
              ->where('residencias.ubicacion_id',$_GET['ubicacion'])
              ->whereBetween('subastas.fecha_reserva', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])->get();}
              else {
                $carb=Carbon::create($_GET['fecha_reserva1'])->addMonth(2);
                $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
                ->where('residencias.ubicacion_id',$_GET['ubicacion'])
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
                break;
              case 5:
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
                break;
              case 6:
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
                break;
              case 7:
              if ($_GET['fecha_reserva2'] != NULL) {
              $resultado = Residencia::select()->join('subastas','residencias.id','=','subastas.residencia_id')
              ->whereBetween('subastas.fecha_reserva', [$_GET['fecha_reserva1'], $_GET['fecha_reserva2']])->get();}
              else {
                $carb=Carbon::createFromFormat('Y-m-d',$_GET['fecha_reserva1'])->addMonth(2)->format('Y-m-d');
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
                break;
              case 8:
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
                break;

}

          }
          else {
            if (Auth::user()->tipo_de_usuario = 2){
              echo "Seleccione el tipo de busqueda que desea";}
                }



          switch ($accion) {
            case '1':
              if ($_GET['fecha_reserva2'] != NULL) {
                $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
                ->leftjoin('reservas','residencias.id', '=', 'reservas.residencia_id')
                ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
                ->where('residencias.ubicacion_id',$_GET['ubicacion'])
                ->groupBy('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
                ->havingRaw('COUNT(*) <= '.$difweek)->get();
                }
            else {
              $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->leftjoin('reservas','residencias.id', '=', 'reservas.residencia_id')
              ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
              ->where('residencias.ubicacion_id',$_GET['ubicacion'])
              ->groupBy('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->havingRaw('COUNT(*) <= 8')->get();}
              break;
            case '2':{
              $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
              ->where('residencias.ubicacion_id',$_GET['ubicacion'])->get();
              break;}
            case '3':{
              if ($_GET['fecha_reserva2'] != NULL) {
                $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
                ->leftjoin('reservas','residencias.id', '=', 'reservas.residencia_id')
                ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
                ->groupBy('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
                ->havingRaw('COUNT(*) <= '.$difweek)->get();
                }
            else {
              $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->leftjoin('reservas','residencias.id', '=', 'reservas.residencia_id')
              ->where('residencias.descripcion','like','%'.$_GET['search'].'%')
              ->groupBy('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->havingRaw('COUNT(*) <= 8')->get();}
              break;}
            case '4':{
              if ($_GET['fecha_reserva2'] != NULL) {
                $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
                ->leftjoin('reservas','residencias.id', '=', 'reservas.residencia_id')
                ->where('residencias.ubicacion_id',$_GET['ubicacion'])
                ->groupBy('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
                ->havingRaw('COUNT(*) <= '.$difweek)->get();
                }
            else {
              $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->leftjoin('reservas','residencias.id', '=', 'reservas.residencia_id')
              ->where('residencias.ubicacion_id',$_GET['ubicacion'])
              ->groupBy('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->havingRaw('COUNT(*) <= 8')->get();}
              break;}
            case '5':{
              $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->where('residencias.descripcion','like','%'.$_GET['search'].'%')->get();
              break;}
            case '6':{
              $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->where('residencias.ubicacion_id',$_GET['ubicacion'])->get();
              break;}
            case '7':{
              if ($_GET['fecha_reserva2'] != NULL) {
                $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
                ->leftjoin('reservas','residencias.id', '=', 'reservas.residencia_id')
                ->groupBy('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
                ->havingRaw('COUNT(*) <= '.$difweek)->get();
                }
            else {
              $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->leftjoin('reservas','residencias.id', '=', 'reservas.residencia_id')
              ->groupBy('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')
              ->havingRaw('COUNT(*) <= 8')->get();}
              break;}
            case '8':{
              $resultado = Residencia::select('residencias.id','residencias.descripcion','residencias.ubicacion_id','residencias.dada_de_baja')->get();
              break;}




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
