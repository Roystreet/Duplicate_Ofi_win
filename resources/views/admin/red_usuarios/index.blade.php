@extends('layout.app')
@section('title', 'Red Usuarios')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/DataTable/Responsive-2.2.2/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/DataTable/DataTables-1.10.18/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/datatable.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
@include('layout.page-header')

<div class="content">
    <div class="clearfix"></div>
    @include('flash::message')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="clearfix"></div>
    <div class="container-fluid mt-n10">
        <div class="card mb-4">
                <div class="card-header"> Red Usuarios</div>
                <div class="card-body">
                    @include('admin.red_usuarios.table')
                </div>
         </div>
    </div>
    <div class="text-center">
    </div>
  </div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/DataTable/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/DataTable/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
<!-- <script src="{{ asset('js/panel/red_usuarios/index.js')}} "></script> -->
@endsection
