@extends('layout')

@section('mainContent')

<?php

use App\User;


$users = User::select('id','name','email','tipo_de_usuario','created_at')->where('eliminado',false)->get();
$users_eliminados = User::select('id','name','email','tipo_de_usuario')->where('eliminado',true)->get();
?>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<!-- <hr> -->
<!-- <div class="container bootstrap snippet"> -->
<div class="row">
  <div class="col-lg-12">
      <!-- <div class="main-box no-header clearfix"> -->
          <div class="main-box-body clearfix">
              <div class="table-responsive">
                  <table class="table user-list">
                      <thead>
                          <tr>
                          <th><span>Usuario</span></th>
                          <th><span>Registro</span></th>
                          <th class="text-center"><span>Tipo de Usuario</span></th>
                          <th><span>Email</span></th>
                          <th>&nbsp;</th>
                          </tr>
                      </thead>
                    </style>
<?php
foreach ($users as $user) {
  if ($user->tipo_de_usuario != 0) {
  ?>
<tbody>
    <tr>
        <td>
            <img src='/public/imagenes/usuario-sin-foto.png' alt="">
            <a class="user-link"><?php echo($user->name); ?></a>
            <!-- <span class="user-subhead">Member</span> -->
        </td>
        <td><?php echo($user->created_at); ?></td>
        <td class="text-center">
            <span class="label label-default"><?php
              switch ($user->tipo_de_usuario) {
                case '1':
                  ?>No verificado
                  <?php
                  break;
                case '2':
                  ?>Normal
                  <?php
                  break;
                default:
                  ?>Premium
                  <?php
                  break;
              }
             ?></span>
        </td>
        <td>
            <a href="#"><?php echo($user->email); ?></a>
        </td>
        <td style="width: 20%;">
            <a href="{{ route('viewUsr',[ $user->id]) }}" class="table-link">
                <span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                </span>
            </a>
            <a href="{{ route('editUsr',[ $user->id]) }}" class="table-link">
                <span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                </span>
            </a>
            <!-- <a href="#" class="table-link danger">
                <span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                </span>
            </a> -->
                <span class="fa-stack">
                  <form action="{{ route('deleteUsr', [$user->id]) }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                  </form>
                </span>
                <?php if($user->tipo_de_usuario==1){ ?>
                <span class="fa-stack">
                  <form method="POST" action="{{ route('check', [$user->id]) }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-secondary" style="margin-left: 41px;" >Verificar</button>
                  </form>
                </span>
              <?php } ?>
        </td>
    </tr>
</tbody>
<?php } }?>
<tbody>
    <tr>
      <th>Usuarios dados de baja</th>
    </tr>
</tbody>
<?php
if(count($users_eliminados)>0){
  foreach ($users_eliminados as $user) {
    if ($user->tipo_de_usuario != 0) {
    ?>
  <tbody>
      <tr>
          <td>
              <img src='/public/imagenes/usuario-sin-foto.png' alt="">
              <a class="user-link"><?php echo($user->name); ?></a>
              <!-- <span class="user-subhead">Member</span> -->
          </td>
          <td><?php echo($user->created_at); ?></td>
          <td class="text-center">
              <span class="label label-default"><?php
                switch ($user->tipo_de_usuario) {
                  case '1':
                    ?>No verificado
                    <?php
                    break;
                  case '2':
                    ?>Normal
                    <?php
                    break;
                  default:
                    ?>Premium
                    <?php
                    break;
                }
               ?></span>
          </td>
          <td>
              <a href="#"><?php echo($user->email); ?></a>
          </td>
          <td style="width: 20%;">
              <a href="{{ route('viewUsr',[ $user->id]) }}" class="table-link">
                  <span class="fa-stack">
                      <i class="fa fa-square fa-stack-2x"></i>
                      <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                  </span>
              </a>
              <a href="{{ route('editUsr',[ $user->id]) }}" class="table-link">
                  <span class="fa-stack">
                      <i class="fa fa-square fa-stack-2x"></i>
                      <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                  </span>
              </a>
              <!-- <a href="#" class="table-link danger">
                  <span class="fa-stack">
                      <i class="fa fa-square fa-stack-2x"></i>
                      <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                  </span>
              </a> -->
                  <span class="fa-stack">
                    <form method="POST" action="{{ route('habilitarUsr', [$user->id]) }}">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-success" >Habilitar</button>
                    </form>
                  </span>
                </td>
              </tr>
  </tbody>
<?php } } }?>
</table>
</div>
</div>
</div>
</div>


@endsection


<style media="screen">
body{
  background:#eee;
}
.main-box.no-header {
  padding-top: 20px;
}
.main-box {
  background: #FFFFFF;
  -webkit-box-shadow: 1px 1px 2px 0 #CCCCCC;
  -moz-box-shadow: 1px 1px 2px 0 #CCCCCC;
  -o-box-shadow: 1px 1px 2px 0 #CCCCCC;
  -ms-box-shadow: 1px 1px 2px 0 #CCCCCC;
  box-shadow: 1px 1px 2px 0 #CCCCCC;
  margin-bottom: 16px;
  -webikt-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
}
.table a.table-link.danger {
  color: #e74c3c;
}
.label {
  border-radius: 3px;
  font-size: 0.875em;
  font-weight: 600;
}
.user-list tbody td .user-subhead {
  font-size: 0.875em;
  font-style: italic;
}
.user-list tbody td .user-link {
  display: block;
  font-size: 1.25em;
  padding-top: 3px;
  margin-left: 60px;
}
a {
  color: #3498db;
  outline: none!important;
}
.user-list tbody td>img {
  position: relative;
  max-width: 50px;
  float: left;
  margin-right: 15px;
}

.table thead tr th {
  text-transform: uppercase;
  font-size: 0.875em;
}
.table thead tr th {
  border-bottom: 2px solid #e7ebee;
}
.table tbody tr td:first-child {
  font-size: 1.125em;
  font-weight: 300;
}
.table tbody tr td {
  font-size: 0.875em;
  vertical-align: middle;
  border-top: 1px solid #e7ebee;
  padding: 12px 8px;
}

</style>
