@extends('layout.app')
@section('title', 'Estatus Red')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/DataTable/Responsive-2.2.2/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/DataTable/DataTables-1.10.18/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<section class="content-header">
  <h1 class="pull-left">Estatus Red</h1>
  <h1 class="pull-right">
    <a class="btn btn-registro btn-default" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('estatus-red.create') }}">Agregar</a>
  </h1>
</section>
<div class="content">
  <div class="clearfix"></div>
    @include('flash::message')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="clearfix"></div>
    <div class="box box-success">
      <div class="box-body">
        @include('admin.status_reds.table')
      </div>
    </div>
  <div class="text-center">
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/DataTable/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/DataTable/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('js/panel/status_reds/index.js')}} "></script>
@endsection
