@extends('layouts.externo_layouts')
@section('title', 'Olvide Contraseña')

@section('css')

@endsection

@section('content')
<div class="logo">Restablecer Contraseña</div>
<br>
@include('flash::message')

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<form method="post" action="{{ route('remenber-pass') }}" id="formRecoveryPassword">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {!! csrf_field() !!}
    <div class="form-row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="mr-0 mr-lg-2">
                    <input type="text" class="required form-control form-control-solid rounded-pill" name="email" value="{{ old('email') }}" placeholder="Ingrese su correo o usuario... " aria-required="true">
                </div>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                <div><span class="help-block" id="error"></span></div>
            </div>

            <div class="align-items-center containers">
                <div class="center">
                    <button type="submit" class="btn btn-primary btn-marketing btn-block rounded-pill">
                        Recuperar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <p align="page-header-text small mb-0 center">¿Ya tienes cuenta?<br>
      <a href="{{ route ('login') }}" style="color:#ffffff">¡Entre aqu&iacute;!</a>
    </p>

</form>



@endsection

@section('scripts')
<!--<script src="{{ asset('js/app/auth_app/login.js')}} "></script>-->
<script src="{{ asset('js/app/recovery_password/recovery.js')}} "></script>
@endsection
