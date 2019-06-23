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
          </ul>
        </div>
      </div>

@endsection

@section('mainContent')

<?php

use App\User;

$usr = User::find($id);

?>
<?php
if (Auth::user()->tipo_de_usuario == 2){
  if (Auth::user()->solicito_upgrade == false){ ?>
    <form method="POST" action="{{ route('solUpgrade', [$usr]) }}">
      @csrf
      <button type="submit" onclick="return confirm('Al volverte premium podrás ver el listado de todas nuestras residencias y realizar una reserva directa, todo por un único pago');" class="btn btn-success btn-lg btn-block">¡Se Premium!</button>
      <!-- <button type="submit" onclick="return confirm('Al volverte premium podrás ver el listado de todas nuestras residencias y realizar una reserva directa, todo por un único pago');" class="btn btn-success btn-lg btn-block">¡Se Premium!</button> -->
    </form>
<?php }
  else {
 ?>
    <center><h3><small class="text-muted">Ya solicitó el upgrade, confirmelo realizando el pago en una de nuestras <a href="{{ route('sucursales')}}">sucursales</a></small></h3></center>
<?php
  }
}
?>
<ul class="list-group">
  <li class="list-group-item">Correo electrónico: {{ $usr->email }}</li>
  <!--El único problema con este parche, es que un admin podría modificar la información de otro admin,
      incluso la que no es relevante en un admin, a no ser que se verifique que el perfil de admin en el que
      entra otro admin sea el suyo, o mejor dicho que directamente no pueda entrar al perfil de otro admin
      sabiendo su ID, ya que en los listados no aparecen los admin-->
  <?php if ((Auth::user()->tipo_de_usuario != 0) or ((Auth::user()->tipo_de_usuario == 0) and (Auth::user()->id!=$id))){ ?>
  <li class="list-group-item">Nombre: {{ $usr->name }}</li>
  <li class="list-group-item">Domicilio: {{ $usr->direccion }}</li>
  <li class="list-group-item">Nro. de teléfono: {{ $usr->telefono }}</li>
  <?php if (Auth::user()->tipo_de_usuario != 1){?>
  <li class="list-group-item">Semanas que tengo disponibles: {{ $usr->semanas_disp }}</li>
  <?php } }?>
  <li class="list-group-item">Tipo de usuario:
    <?php
      switch ($usr->tipo_de_usuario) {
        case '0':?><b>Admin</b>
    <?php
        break;
        case '1':?><b>Sin verificar</b>
    <?php
        break;
        case '2':?><b>Estandar</b>
    <?php
        break;
        case '3':?><b>Premium</b>
    <?php
        break;
      }?>
  </li>
</ul>
  <center>
    <div class="btn-group" role="group" aria-label="Basic example">
    <?php if (((Auth::user()->tipo_de_usuario == 2) or (Auth::user()->tipo_de_usuario == 3)) or ((Auth::user()->tipo_de_usuario == 0) and (Auth::user()->id!=$id))){ ?><a href="{{ route('listaReservasDeUsuario', [$usr->id]) }}"><button type="button" class="btn btn-sm btn-outline-primary">Ver reservas</button></a><?php } ?>
    <?php if ((Auth::user()->tipo_de_usuario != 0) or ((Auth::user()->tipo_de_usuario == 0) and (Auth::user()->id!=$id))){ ?><a href="{{ route('editUsr', [$usr]) }}"><button type="button" class="btn btn-sm btn-outline-primary">Modificar información</button></a><?php } ?>
    <a href="{{ route('changePass', [$usr]) }}"><button type="button" class="btn btn-sm btn-outline-primary">Cambiar contraseña</button></a>
    </div>
    <?php if ((Auth::user()->tipo_de_usuario == 0) and (Auth::user()->id!=$id)){
        if (!$usr->eliminado){?>
         <form action="{{ route('deleteUsr', [$id]) }}" method="POST">
          @csrf
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
         </form>
    <?php }
        else { ?>
          <form method="POST" action="{{ route('habilitarUsr', [$usr]) }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-success" >Habilitar</button>
          </form>
    <?php  }} ?>
  </center>

@endsection
