@extends('layouts.app')
@section('title', 'Mostrar token de usuarios')

@section('css')
@endsection

@section('content')
<!-- Cabecera del contenedor de la vista -->
<div class="page-header pb-10 page-header-dark bg-content">
    <div class="container-fluid">
        <div class="page-header-content">
            <h1 class="page-header-title">
                <div class="page-header-icon"><i class="fas fa-eye"></i></div>
                <span>Mostar token de usuario</span>
            </h1>
            <div class="page-header-subtitle"><i class="fas fa-dot-circle"></i><span class="pl-2">Mostrar los tokens de los usuarios de la Oficina Virtual</span></div>
        </div>
    </div>
</div>
<!-- Container-fluid -->
<div class="container-fluid mt-n10">
  <!-- Card -->
  <div class="card">
    <!-- Card Title -->
    <div class="card-header border-bottom">Mostrar token de usuario</div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="form-row">
        <!-- Tipo de token -->
        <div class="col-xs-12 col-sm-6">
          <label>Tipo de token:</label>
          <div class="bg-light border p-3 mb-3">{{ ($tokenUsersApp->id_tp_token)? $tokenUsersApp->getTpToken->descripcion : '-' }}</div>
        </div>
        <!-- Llave del token -->
        <div class="col-xs-12 col-sm-6">
          <label>Llave del token:</label>
          <div class="bg-light border p-3 mb-3">{{ $tokenUsersApp->token_llave }}</div>
        </div>
      </div>
      <div class="form-row">
        <!-- Código del token -->
        <div class="col-xs-12 col-sm-6">
          <label>C&oacute;digo del token:</label>
          <div class="bg-light border p-3 mb-3">{{ $tokenUsersApp->token_code }}</div>
        </div>
        <!-- Estado del token -->
        <div class="col-xs-12 col-sm-6">
          <label>Estado del token:</label>
          <div class="bg-light border p-3 mb-3">{{ ($tokenUsersApp->status ==1)? 'ACTIVADO' : 'DESACTIVADO' }}</div>
        </div>
      </div>
      <div class="form-row">
        <!-- Creado en -->
        <div class="col-xs-12 col-sm-6">
          <label>Creado en:</label>
          <div class="bg-light border p-3 mb-3">{{ $tokenUsersApp->created_at }}</div>
        </div>
        <!-- Modificado en -->
        <div class="col-xs-12 col-sm-6">
          <label>Modificado en:</label>
          <div class="bg-light border p-3 mb-3">{{ $tokenUsersApp->updated_at }}</div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 pt-4 pl-1 pr-1 small mx-auto">
        <a href="{!! route('token-usuarios-app.index') !!}" class="btn btn-primary btn-block">Atrás</a>
      </div>
    </div><!-- END Card Body -->
  </div><!-- END Card -->
</div><!-- END Container-fluid -->
@endsection
