@extends('layout.app')
@section('title', 'Contraseña Usuario')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<section class="content-header">
  <h1>
    Contrase&ntilde;a Usuarios
  </h1>
</section>
  <div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-success">
      <div class="box-body">
        <div class="row">
          {!! Form::model($passwordUsersApp, ['route' => ['clave-usuarios-app.update', $passwordUsersApp->id], 'method' => 'patch' , 'id'=>'formEditPasswordUsersApp']) !!}
            @include('admin.password_users_apps.fields')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/panel/password_users_apps/edit.js')}} "></script>
@endsection
