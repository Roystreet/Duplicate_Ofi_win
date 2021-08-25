@extends('layout.app')
@section('title', 'Estatus Generales')


@section('css')
<!-- Datatables -->
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
<!-- Alertify -->
<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
@endsection

@section('content')


@include('layout.page-header')

<!-- Container-fluid -->
<div class="container-fluid mt-n10">
  <!-- Card -->
  <div class="card rounded mb-4">
    <div class="card-header">
      <div class="col-md-10 float-right">
        Estatus Red
      </div>

      <div class="col-md-2 float-right">
        <a class="btn float-right btn-primary" style="margin-top: -10px;margin-bottom: 5px"  href="{!! route('estatus-red.create') !!}">Agregar</a>
      </div>
    </div>
    @if (session('status')) <!-- Si el tipo de token se creó/actualizó correctamente, mostrará el mensaje del controlador -->
        <div class="alert alert-success alert-icon mt-2 ml-2 mr-2" role="alert">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="alert-icon-aside">
                <i class="fas fa-check"></i>
            </div>
            <div class="alert-icon-content">
                <h6 class="alert-heading">{{ session('status') }}</h6>
            </div>
        </div>
    @endif
    <div class="card-body">
      @include('admin.status.table_red')
    </div>
  </div>



  <div class="card rounded mb-4">
    <div class="card-header">
      <div class="col-md-10 float-right">
        Estatus Sesión
      </div>

      <div class="col-md-2 float-right">
        <a class="btn float-right btn-primary" style="margin-top: -10px;margin-bottom: 5px"  href="{!! route('estatus-sesion.create') !!}">Agregar</a>
      </div>
    </div>
    @if (session('status')) <!-- Si el tipo de token se creó/actualizó correctamente, mostrará el mensaje del controlador -->
        <div class="alert alert-success alert-icon mt-2 ml-2 mr-2" role="alert">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="alert-icon-aside">
                <i class="fas fa-check"></i>
            </div>
            <div class="alert-icon-content">
                <h6 class="alert-heading">{{ session('status') }}</h6>
            </div>
        </div>
    @endif
    <div class="card-body">
      @include('admin.status.table_sessions')
    </div>
  </div>

  <div class="card rounded mb-4">
    <div class="card-header">
      <div class="col-md-10 float-right">
        Estatus Usuarios
      </div>

      <div class="col-md-2 float-right">
        <a class="btn float-right btn-primary" style="margin-top: -10px;margin-bottom: 5px"  href="{!! route('estatus-usuarios-app.create') !!}">Agregar</a>
      </div>
    </div>
    @if (session('status')) <!-- Si el tipo de token se creó/actualizó correctamente, mostrará el mensaje del controlador -->
        <div class="alert alert-success alert-icon mt-2 ml-2 mr-2" role="alert">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="alert-icon-aside">
                <i class="fas fa-check"></i>
            </div>
            <div class="alert-icon-content">
                <h6 class="alert-heading">{{ session('status') }}</h6>
            </div>
        </div>
    @endif
    <div class="card-body">
      @include('admin.status.table_users_apps')
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('plugins/DataTable/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/DataTable/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('js/panel/status/index.js')}} "></script>
@endsection
