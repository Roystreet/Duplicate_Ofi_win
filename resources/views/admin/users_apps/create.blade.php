@extends('layout.app')
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
          {!! Form::open(['route' => 'usuarios-app.store' , 'id'=>'formCreateUsersApp']) !!}
          @include('admin.users_apps.fields')
          <div class="form-group col-sm-12">
            {!! Form::submit('Guardar', ['class' => 'btn btn-registro btn-default']) !!}
            {!! Form::close() !!}
            <a href="{!!  route('usuarios-app.index') !!}" class="btn btn-registro btn-default">Cancelar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/panel/users_apps/create.js')}} "></script>
@endsection
