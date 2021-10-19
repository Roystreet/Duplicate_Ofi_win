@extends('layout.app')
@section('title', 'Rol Usuario')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<div class="container-fluid p-3">
  <div class="card">
    <div class="card-header">
      <h3>Editar Rol Usarios</h3> 
    </div>
    <div class="card-body">
       <div class="row w-100">
        {!! Form::model($rolUsers, ['route' => ['rol-usuarios.update', $rolUsers->id], 'method' => 'patch' , 'id'=>'formEditRolUsers','class'=>'w-100']) !!}
                  <!-- Id Users App Field -->
                  <div class="form-group col-sm-6">
                    <div class="input-group col-xs-12">
                    
                    nombres:{{$tpUsersAps->first_name}} - {{$tpUsersAps->last_name}} <br>
                    cooreo :{{$tpUsersAps->email}} celular {{$tpUsersAps->phone}} <br>
                    <input id="id_user" name="id_user" type="hidden" value="{{$tpUsersAps->id}}">
                  </div><div><span class="help-block" id="error"></span></div></div>

                  <!-- Id Tp Rol Field -->
                  <div class="form-group col-sm-6"><div class="input-group col-xs-12">
                    {!! Form::label('id_tp_rol', 'Rol:') !!}
                    {!! Form::select('id_tp_rol', $tpRols, null, ['id'=>'id_tp_rol', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
                    <!-- {!! Form::text('id_tp_rol', null, ['class' => 'form-control']) !!} -->
                  </div><div><span class="help-block" id="error"></span></div></div>

                  <!-- Submit Field -->
                  <div class="form-group col-sm-12"><div class="input-group col-xs-12">
                    {!! Form::submit('Guardar', ['class' => 'btn  btn-primary']) !!}
                    <a href="{!! route('rol-usuarios.index') !!}" class="btn  btn-primary">Cancelar</a>
                  </div><div><span class="help-block" id="error"></span></div></div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
{{-- <section class="content-header">
  <h1>
    Rol Usuarios
  </h1>
</section>
 <div class="content">
   @include('adminlte-templates::common.errors')
  <div class="box box-success">
    <div class="box-body">
      <div class="row">
        {!! Form::model($rolUsers, ['route' => ['rol-usuarios.update', $rolUsers->id], 'method' => 'patch' , 'id'=>'formEditRolUsers']) !!}
          @include('admin.rol_users.fields')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
 </div> --}}
@endsection

@section('scripts')
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/panel/rol_users/edit.js')}} "></script>
@endsection
