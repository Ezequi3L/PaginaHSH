@extends('layout')

@section('mainContent')

<?php

use App\User;


$users = User::select('id','name','email','solicito_upgrade','tipo_de_usuario','created_at')->where('tipo_de_usuario',2)->where('solicito_upgrade',true)->get();
if(count($users)>0){
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
                          <th><span>Email</span></th>
                          <th>&nbsp;</th>
                          </tr>
                      </thead>
                    </style>
<?php
  foreach ($users as $user) {
    if (($user->tipo_de_usuario == 2) and ($user->solicito_upgrade == true)) {
    ?>
  <tbody>
      <tr>
          <td>
              <img src='/public/imagenes/usuario-sin-foto.png' alt="">
              <a class="user-link"><?php echo($user->name); ?></a>
              <!-- <span class="user-subhead">Member</span> -->
          </td>
          <td><?php echo($user->created_at); ?></td>
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
                  <span class="fa-stack">
                    <form method="POST" action="{{ route('upgrade', [$user->id]) }}">
                      @csrf
                      {{ method_field('PUT') }}
                      <button type="submit" class="btn btn-sm btn-success">Confirmar</button>
                    </form>
                  </span>
                  <span class="fa-stack">
                    <form action="{{ route('deleteUsrSolUpg', [$user->id]) }}" method="POST">
                      @csrf
                      {{ method_field('PUT') }}
                      <button type="submit" onclick="return confirm('¿Está seguro que desea cancelar la solicitud del usuario?');" class="btn btn-sm btn-danger" style="margin-left: 54px;">Cancelar</button>
                    </form>
                  </span>
          </td>
      </tr>
  </tbody>
<?php } } }
else{
?>
<center>
  <div class="col-md-auto">
    <h1></h1>
    <h1>No hay usuarios que hayan solicitado ser premium</h1>
  </div>
</center>
<?php
}
?>

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
