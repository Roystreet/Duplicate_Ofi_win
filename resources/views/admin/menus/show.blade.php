@extends('layout.app')
@section('title', 'Menú')

@section('css')
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<div class="container-fluid p-3">
  <div class="card">
    <div class="card-header">
      <h3>Men&uacute;</h3> 
    </div>
    <div class="card-body">
 
       <div class="row w-100">
        @include('admin.menus.show_fields')
        <a href="{!! route('menus.index') !!}" class="btn btn-primary">Atrás</a>
      </div>
    </div>
  </div>
</div>
{{-- <section class="content-header">
  <h1>
    Men&uacute;
  </h1>
</section>
  <div class="content">
    <div class="box box-success">
      <div class="box-body">
        <div class="row" style="padding-left: 20px">
          @include('admin.menus.show_fields')
          <a href="{!! route('menus.index') !!}" class="btn btn-registro btn-default">Atrás</a>
        </div>
      </div>
    </div>
  </div> --}}
@endsection
