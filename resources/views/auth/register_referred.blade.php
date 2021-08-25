@extends('layouts.externo_layouts')
@section('title', 'Registrar Referido')
<meta name="author" content="Víctor Enrique Pérez Guevara" />
@section('css')
@endsection

@section('content')
<h1 class="page-header-title">Registrar Referido</h1>

        @include('flash::message')
        <form method="POST" action="{{ route ('registrando_ref') }}" id="formRegister" autocomplete="off">
          <meta name="csrf-token" content="{{ csrf_token() }}" />
          {{ csrf_field() }}

          <label for="">en la red de "{{$nombres}} {{$apellidos}}"</label>
          {!! Form::hidden('usersponsor', $iduser) !!}
          <div class="form-row justify-content-center">
                <div class="col-lg-6 col-md-8">

          <div class="form-group has-feedback {{ $errors->has('email')? 'has-error' : '' }} ">
          <label for=email>Correo</label>
            <div class="mr-0 mr-lg-2">

              <input class="err required form-control form-control-solid rounded-pill" type="email" name="email" id="email"  placeholder="Ingresa tu correo" aria-required="true">

            </div>
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <div>
            <span class="help-block" id="error"></span></div>
            {!!  $errors->first('email', '<span class="help-block" id="error"><strong>:message</strong></span>' ) !!}
          </div>


          <div class="form-group has-feedback {{ $errors->has('email')? 'has-error' : '' }} ">
                <label for=phone>Teléfono</label>
                    <div class="mr-0 mr-lg-2">
                        <input class=" err required form-control form-control-solid rounded-pill" type="number" name="phone" id="phone"  placeholder="Ingresa tu numero de teléfono" aria-required="true">
                      </div>
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                 <div>
                   <span class="help-block" id="error"></span>
                 </div>
                {!!  $errors->first('phone', '<span class="help-block" id="error"><strong>:message</strong></span>' ) !!}
          </div>


          <div class="form-group has-feedback {{ $errors->has('email')? 'has-error' : '' }} ">
                <label for=perfil>Perfil</label>
                    <div class="mr-0 mr-lg-2">
                    {!! Form::select('perfil', $perfiles, null, ['class' => 'err form-select required form-control form-control-solid rounded-pill','placeholder'=>'Seleccione...']) !!}
                    </div>
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>

                 <div>
                   <span class="help-block" id="error"></span>
                 </div>
                {!!  $errors->first('perfil', '<span class="help-block" id="error"><strong>:message</strong></span>' ) !!}
          </div>


          <button class="btn btn-primary btn-marketing btn-block rounded-pill">Registrar</button>

          <hr>
          <p align="page-header-text small mb-0 center">
            <a href="{{ route ('login') }}" style="color:#ffffff">¡Ya tengo cuenta!</a></p>
        </form>

@endsection

@section('scripts')
<script src="{{ asset('js/app/auth_app/register_referred.js')}} "></script>
@endsection
