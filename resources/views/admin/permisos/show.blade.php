@extends('layout.app')
@section('title', 'Permisos')

@section('css')
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
        @include('admin.permisos.show_fields')
        <a href="{!! route('permisos.index') !!}" class="btn btn-primary">Atrás</a>
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
    <div class="box box-success">
      <div class="box-body">
        <div class="row" style="padding-left: 20px">
          @include('admin.permisos.show_fields')
          <a href="{!! route('permisos.index') !!}" class="btn btn-registro btn-default">Atrás</a>
        </div>
      </div>
    </div>
  </div> --}}
@endsection
