@extends('layout.app')
@section('title', 'Rol')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<section class="content-header">
  <h1>
    Rol
  </h1>
</section>
  <div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-success">
      <div class="box-body">
        <div class="row">
          {!! Form::model($tpRol, ['route' => ['roles.update', $tpRol->id], 'method' => 'patch']) !!}
            @include('admin.tp_rols.fields')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
