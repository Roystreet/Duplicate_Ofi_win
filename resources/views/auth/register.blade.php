@extends('layout.basic')
@section('title', 'Registro')

@section('css')
@endsection

@section('content')
<div class="logo">Registrar Usuario</div>
<br>
@include('flash::message')
<form method="POST" action="{{ route ('registrando') }}" id="formRegister" autocomplete="off">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  {{ csrf_field() }}
  <div class="form-row justify-content-center">
    <div class="col-lg-6 col-md-8">
      <div class="form-group has-feedback {{ $errors->has('email')? 'has-error' : '' }} ">
        <label for="reg_email" class="sr-only">Correo</label>
        <input class="required form-control form-control-solid rounded-pill" type="email" name="email" id="email" placeholder="Ingresa tu correo" aria-required="true">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
        <div>
          <span class="help-block" id="error"></span>
        </div>
        {!! $errors->first('email', '<span class="help-block" id="error"><strong>:message</strong></span>' ) !!}
      </div>

      <div class="form-group {{ $errors->has('password')? 'has-error' : '' }} ">
        <label for="reg_password" class="sr-only">Contraseña</label>
        <input class="required form-control form-control-solid rounded-pill" type="password" name="password" id="password" placeholder="Ingresa tu contraseña" aria-required="true">
        <span class="input-group-addon"><a id="reveal-password"><i class="glyphicon glyphicon-eye-open"></i></a></span>
        <div><span class="help-block" id="error"></span></div>
        {!! $errors->first('password', '<span class="help-block"><strong>:message</strong></span>' ) !!}
      </div>

      <div class="form-group {{ $errors->has('password_confirm')? 'has-error' : '' }} ">
        <label for="reg_password_confirm" class="sr-only">RepetirContraseña</label>
        <input class="required form-control form-control-solid rounded-pill" type="password" name="password_confirm" id="password_confirm" placeholder="Ingresa tu contraseña" aria-required="true">
        <span class="input-group-addon">
          <a id="reveal-password2"><i class="glyphicon glyphicon-eye-open"></i></a>
        </span>
        <div><span class="help-block" id="error"></span></div>
        {!! $errors->first('password_confirm', '<span class="help-block"><strong>:message</strong></span>' ) !!}
      </div>

      <div class="form-group">
        <div class="input-group">
          <input class="form-control" type="hidden" name="rol" id="rol">
        </div>
        <div><span class="help-block" id="error"></span></div>
        {!! $errors->first('password_confirm', '<span class="help-block"><strong>:message</strong></span>' ) !!}
      </div>

      <button class="btn btn-primary btn-marketing btn-block rounded-pill">Guardar</button>

      <hr>
      <div class="mr-0 mr-lg-2">
        <a href="{{ url('/auth/google')   }}" class="btn btn-outline-light">
          <img width="15px" style="margin-bottom:3px; margin-right:5px" alt="Google Inicia Sesión" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
          Registrarse con Google
        </a>
      </div>
      <hr>
      <p align="page-header-text small mb-0 center">¿Ya tienes cuenta?<br>
        <a href="{{ route ('login') }}" style="color:#ffffff">¡Entre aqu&iacute;!</a>
      </p>
</form>

@endsection

@section('scripts')
<script>
  $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/app/auth/register.js')}} "></script>
@endsection
