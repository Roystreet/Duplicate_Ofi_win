@extends('layout.app')
@section('title', 'Listado')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
@include('layout.page-header')
<div class="clearfix"></div>
@include('flash::message')

<div class="container-fluid mt-n10">
    @include('adminlte-templates::common.errors')
    <div class="card rounded mb-4">
      <h6 class="small text-muted font-weight-500 card-header">Editar usuario</h6>

      <div class="box-body">
        <div class="row">
          {!! Form::model($usersApp, ['route' => ['usuarios-app.update', $usersApp->id],'class'=>'w-100 p-5', 'method' => 'patch', 'id'=>'formEditUsersApp']) !!}
          <div class="form-row">
            @include('admin.users_apps.fields')
          </div>

          <div class="form-group col-sm-12" align="right">
            {!! Form::close() !!}
            <a href="{!!  route('usuarios-app.show', [$usersApp->id]) !!}" class="btn btn-primary btn-default">Cancelar</a>
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-default']) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/panel/users_apps/edit.js')}} "></script>
@endsection
