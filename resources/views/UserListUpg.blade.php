@extends('layout')

@section('mainContent')

<?php

use App\User;


$users = User::select('id','name','email','solicito_upgrade','tipo_de_usuario')->where('tipo_de_usuario',2)->where('solicito_upgrade',true)->get();
if(count($users)>0){
foreach ($users as $user) {
  if (($user->tipo_de_usuario == 2) and ($user->solicito_upgrade == true)) {
  ?>
  <li type="disc">{{$user->id}}, <b>nombre:</b>{{$user->name}}, <b>e-mail:</b>{{$user->email}} <b>Usuario</b>
    <?php
      switch ($user->tipo_de_usuario) {
        case '1':
          ?><b>No verificado</b>
          <form method="POST" action="{{ route('check', [$user->id]) }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-secondary">Verificar</button>
          </form>

          <?php
          break;
        case '2':
          ?><b>Estandar</b>
          <?php
          break;
        default:
          ?>
          <b>Premium</b>
          <?php
          break;
      }
     ?>
  </li>
  <div class="btn-group" role="group" aria-label="Basic example">
  <a href="{{ route('viewUsr',[ $user->id]) }}" class="btn btn-sm btn-outline-primary">Ver Perfil</a>
  <form method="POST" action="{{ route('upgrade', [$user->id]) }}">
    @csrf
    <button type="submit" class="btn btn-sm btn-outline-success">Upgradear</button>
  </form>
  </div>
<?php } } }
else{
?>
<center>
  <div class="col-md-auto">
    <h1></h1>
    <h1>No hay usuarios que hayan solicitado un upgrade</h1>
  </div>
</center>
<?php
}
?>






@endsection
