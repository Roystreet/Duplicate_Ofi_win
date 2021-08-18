@extends('layouts.app')
@section('title', 'Estatus Usuarios')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<section class="content-header">
  <h1>
    Estatus Usuario
  </h1>
</section>
  <div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-success">
      <div class="box-body">
        <div class="row">
          {!! Form::open(['route' => 'estatus-usuarios-app.store' , 'id'=>'formCreateStatusUsersApps']) !!}
            @include('panel.status_users_apps.fields')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>]
@endsection

@section('scripts')
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/panel/status_users_apps/create.js')}} "></script>
@endsection
