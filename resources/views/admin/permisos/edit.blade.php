@extends('layout.app')
@section('title', 'Permisos')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<div class="container-fluid p-3">
  <div class="card">
    <div class="card-header">
      <h3>Permisos</h3> 
    </div>
    <div class="card-body">
        <div class="row w-100">
          @include('adminlte-templates::common.errors')
        </div>
       <div class="row w-100">
        {!! Form::model($permiso, ['route' => ['permisos.update', $permiso->id], 'method' => 'patch' , 'id'=>'formEditPermisos',"class"=>'w-100']) !!}
            @include('admin.permisos.fields')
          {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
{{-- <section class="content-header">
  <h1>
    Permisos
  </h1>
</section>
  <div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-success">
      <div class="box-body">
        <div class="row">
          {!! Form::model($permiso, ['route' => ['permisos.update', $permiso->id], 'method' => 'patch' , 'id'=>'formEditPermisos']) !!}
            @include('admin.permisos.fields')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div> --}}
@endsection

@section('scripts')
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/panel/permisos/edit.js')}} "></script>
@endsection
