@extends('layouts.app')
@section('title', 'Listado')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<section class="content-header">
  <h1>
    Usuarios
  </h1>
</section>
  <div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-success">
      <div class="box-body">
        <div class="row">
          {!! Form::model($usersApp, ['route' => ['usuarios-app.update', $usersApp->id],'class'=>'w-100 p-5', 'method' => 'patch', 'id'=>'formEditUsersApp']) !!}
          @include('panel.users_apps.fields')
          <div class="form-group col-sm-12">
            {!! Form::close() !!}
            {!! Form::submit('Guardar', ['class' => 'btn btn-registro btn-default']) !!}
            <a href="{!!  route('usuarios-app.show', [$usersApp->id]) !!}" class="btn btn-registro btn-default">Cancelar</a>
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
