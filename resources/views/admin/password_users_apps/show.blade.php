@extends('layout.app')
@section('title', 'Contraseña Usuario')

@section('css')
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<section class="content-header">
  <h1>
    Contrase&ntilde;a Usuarios
  </h1>
</section>
  <div class="content">
    <div class="box box-success">
      <div class="box-body">
        <div class="row" style="padding-left: 20px">
          @include('admin.password_users_apps.show_fields')
          <a href="{!! route('clave-usuarios-app.index') !!}" class="btn btn-registro btn-default">Atrás</a>
        </div>
      </div>
    </div>
  </div>
@endsection
