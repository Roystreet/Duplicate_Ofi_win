@extends('layout.app')
@section('title', 'Rol')

@section('css')
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')

<div class="container-fluid p-3">
  <div class="card">
    <div class="card-header">
      <h3>Ver Rol</h3> 
    </div>
    <div class="card-body">
       <div class="row w-100">
        @include('admin.tp_rols.show_fields')
        <a href="{!! route('roles.index') !!}" class="btn  btn-primary">Atrás</a>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
