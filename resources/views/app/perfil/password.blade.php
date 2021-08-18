@extends('layout.app')
@section('title', 'Cambiar Contraseña')

@section('css')
<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
@endsection

@section('content')
<!-- Cabecera del contenedor de la vista -->
@include('app.page-header')
<!-- Container-fluid -->
<div class="container-fluid mt-n10 row justify-content-center">
  <!-- Card -->
  <div class="card mb-4 col-xs-12 col-md-8">
    <!-- Card Title -->
    <div class="card-header border-bottom">Actualizar contraseña</div>
    <!-- Card Body -->
    <div class="card-body">
      @include('flash::message')
      <form method="POST" action="{{ route ('pass-change') }}" id="formPassword">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        {{ csrf_field() }}<!-- token del form -->
        <!-- INPUT nueva contraseña -->
        <div class="form-row justify-content-center">
          <div class="col-xs-12 col-sm-6">
            <label for="password">Nueva contraseña:</label><code>*</code>
            <div class="input-group mb-2">
              <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Ingresa tu contraseña" aria-required="true">
              <!-- Mensaje de error de validación del campo -->
              @error('password')
              <span class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror
            </div>
          </div>
        </div>
        <!-- INPUT repetir nueva contraseña -->
        <div class="form-row justify-content-center">
          <div class="col-xs-12 col-sm-6">
            <label for="password_confirm">Repetir nueva contraseña:</label><code>*</code>
            <div class="input-group mb-2">
              <input class="form-control @error('password_confirm') is-invalid @enderror" type="password" name="password_confirm" id="password_confirm" placeholder="Ingresa tu contraseña" aria-required="true">
              <!-- Mensaje de error de validación del campo -->
              @error('password_confirm')
              <span class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 pt-4 pl-1 pr-1 small mx-auto">
          <button class="btn btn-primary btn-block">Guardar</button>
        </div>
      </form> <!-- END Form de FormPassword -->
    </div>
  </div><!-- END Card Perfil -->
</div>
@endsection

@section('scripts')
<!-- Llamado del script de esta vista -->
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('alertify/js/alertify.min.js') }}"></script>
<script src="{{ asset('js/app/perfil_user_apps/password.js')}} "></script>
@endsection
