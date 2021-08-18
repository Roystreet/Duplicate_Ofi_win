@extends('layout.basic')
@section('title', 'Iniciar Sesión')

@section('css')
@endsection

@section('content')
<div class="logo">Iniciar Sesi&oacute;n</div>
<br>
@include('flash::message')

<form class="page-header-signup mb-2 mb-md-0" method="POST" action="{{ route ('ingresando') }}" id="formLogin" autocomplete="off">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  {{ csrf_field() }}
  <div class="form-row justify-content-center">
    <div class="col-lg-6 col-md-8">

      <!-- Correo Electronico o usuario -->
      <div class="form-group {{ $errors->has('email')? 'has-error'    : '' }} ">
        <label class="sr-only" for="email">Ingresa tu correo o usuario</label>
        <div class="input-group col-xs-12">
          <input class="required form-control form-control-solid rounded-pill " id="email" value="{{ old('email') }}" type="email" name="email" placeholder="Ingresa tu correo o usuario..." aria-required="true" />
        </div>
        <div><span class="help-block" id="error"></span></div>
        {!! $errors->first('email', '<span class="help-block" id="error">:message</span>' ) !!}
      </div>


      <!-- Contraseña  -->
      <div class="form-group {{ $errors->has('email')? 'has-error'    : '' }} ">
        <label class="sr-only" for="email">Ingresa tu contraseña</label>
        <div class="input-group">
          <input class="form-control border-secondary rounded-pill pr-5" id="password" type="password" name="password" placeholder="Ingresa tu contraseña..." aria-required="true">
        </div>
        <div><span class="help-block" id="error"></span></div>
        {!! $errors->first('email', '<span class="help-block" id="error">:message</span>' ) !!}
      </div>

      <div class="form-group {{ $errors->has('general')? 'has-error'  : '' }} ">
        {!! $errors->first('general', '<span class="help-block">:message</span>' ) !!}
      </div>

      <div class=" align-items-center containers">
        <div class="center"><button class="btn btn-primary btn-marketing btn-block rounded-pill" type="submit">Acceder</button></div>
      </div>

      <hr>
      <div class="mr-0 mr-lg-2">
        <a href="{{ url('/auth/google')   }}" class="btn btn-outline-light">
          <img width="15px" style="margin-bottom:3px; margin-right:5px" alt="Google Inicia Sesión" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
          Iniciar sesión con Google
        </a>
      </div>
    </div>
  </div>
  <br>
  <p align="page-header-text small mb-0 center">
    <a href="{{ route ('forget-user') }}" style="color:#ffffff">¿Olvidaste tu usuario?</a>
  </p>
  <p align="page-header-text small mb-0 center">
    <a href="{{ route ('forget-pass') }}" style="color:#ffffff">¿Olvidaste tu contraseña?</a>
  </p>
</form>
<!--FIN DEL FORMULARIO -->
@endsection



@section('scripts')
<script src="{{ asset('js/app/auth/login.js')}} "></script>
@endsection
