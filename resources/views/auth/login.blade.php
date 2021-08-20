@extends('layout.simple')
@section('title', 'Iniciar Sesión')

@section('css')
<style media="screen">
.page-header {
  position: relative;
  padding-top: 6rem;
  padding-bottom: 6rem;
}
</style>
@endsection

@section('content')
@include('flash::message')
<div class="row justify-content-center">
  <div class="col-xl-10 col-lg-12 col-md-9">
    <div class="card o-hidden border-0 shadow-lg">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-6 d-none d-lg-block bg-login-image">
            <div class="col d-none d-md-block text-center">
              <br>
              <img src="https://i.postimg.cc/PrM7hmgB/Comunicados-DEVWIN-BO-2.png" style="width:100%; height:100%; padding-left:4px" />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center"> <!-- Título de login -->
                    <h1 class="h3 text-gray-900 mb-2">Bienvenidos</h1>
                    <h2 class="h4 text-gray-900 mb-2">Oficina Virtual</h2>
                </div>
                <br>
                <form class="user" id="Login" action="{{ url('login') }}" method="POST">
                    {{ csrf_field() }}
                    @if(Session::has('error_message'))
                    <div class="alert alert-info">
                      {{ Session::get('error_message') }}
                    </div>
                    @endif
                    <!-- Correo Electronico o usuario -->
                    <div class="form-group {{ $errors->has('email')? 'has-error'    : '' }} ">
                      <label class="sr-only" for="email">Ingresa tu correo o usuario</label>
                      <div class="input-group col-xs-12">
                        <input class="required form-control form-control-solid rounded-pill" id="email" value="{{ old('email') }}" type="email" name="email" placeholder="Ingresa tu correo o usuario..." aria-required="true" />
                      </div>
                      <div><span class="help-block text-gray-900" id="error"></span></div>
                      {!! $errors->first('email', '<span class="help-block text-gray-900 " id="error">:message</span>' ) !!}
                    </div>

                    <div class="form-group {{ $errors->has('email')? 'has-error'    : '' }} ">
                      <label class="sr-only" for="email">Ingresa tu contraseña</label>
                      <div class="input-group">
                        <input class="required form-control form-control-solid rounded-pill" id="password" type="password" name="password" placeholder="Ingresa tu contraseña..." aria-required="true">
                      </div>
                      <div><span class="help-block text-gray-900 " id="error"></span></div>
                      {!! $errors->first('email', '<span class="help-block text-gray-900 " id="error">:message</span>' ) !!}
                    </div>

                    <div class="form-group {{ $errors->has('general')? 'has-error'  : '' }} ">
                      {!! $errors->first('general', '<span class="help-block text-gray-900 ">:message</span>' ) !!}
                    </div>

                    <div class="form-group d-flex align-items-center justify-content-between mb-0">
                      <button type="submit" class="btn btn-primary btn-marketing btn-block rounded-pill" >Acceder</button>
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-between mb-0">
                      <div class="custom-control custom-control-solid custom-checkbox">
                        <input class="custom-control-input small" id="rememberPassword" type="checkbox"/>
                        <label class="custom-control-label text-gray-900" for="rememberPassword">Recordar contraseña</label>
                      </div>
                    </div>

                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection



@section('scripts')
<script src="{{ asset('js/app/auth/login.js')}} "></script>
@endsection
