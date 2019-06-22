@extends('layout')

@section('mainContent')

<?php

use App\User;


$users = User::select('id','name','email','tipo_de_usuario')->where('eliminado',false)->get();
$users_eliminados = User::select('id','name','email','tipo_de_usuario')->where('eliminado',true)->get();
foreach ($users as $user) {
  if ($user->tipo_de_usuario != 0) {
  ?>
  <li type="disc">{{$user->id}}, <b>nombre:</b>{{$user->name}}, <b>e-mail:</b>{{$user->email}}, <b>Usuario</b>
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
          ?><b>Normal</b>
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
  <a href="{{ route('viewUsr',[ $user->id]) }}">
    Ver Perfil
  </a>
<?php } }?>

<?php
if(count($users_eliminados)>0){
  ?>
<section class="text-center">
 <div class="container">
   <p class="lead text-danger">Usuarios dados de baja</p>
 </div>
</section>
 <?php foreach ($users_eliminados as $user) {
   if ($user->tipo_de_usuario != 0) {
   ?>
   <li type="disc">{{$user->id}}, <b>nombre:</b>{{$user->name}}, <b>e-mail:</b>{{$user->email}}, <b>Usuario</b>
     <?php
       switch ($user->tipo_de_usuario) {
         case '1':
           ?><b>No verificado</b>
           <?php
           break;
         case '2':
           ?><b>Normal</b>
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
   <a href="{{ route('viewUsr',[ $user->id]) }}">
     Ver Perfil
   </a>
 <?php } } }?>

@endsection
