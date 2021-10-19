@extends('layout.app')
@section('title', 'Rol Usuario')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/DataTable/Responsive-2.2.2/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/DataTable/DataTables-1.10.18/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/datatable.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')

@include('layout.page-header')

<!-- Container-fluid -->
<div class="container-fluid mt-n10">
  <!-- Card -->
  <div class="card mb-4">
    <div class="card-header">
      <div class="col-md-10 float-right">
        Rol Usuarios
      </div>

      <div class="col-md-2 float-right">
        <a class="btn float-right btn-primary" style="margin-top: -10px;margin-bottom: 5px"  href="{!! route('rol-usuarios.create') !!}">Agregar</a>
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
      <div class="content-fluid p-5">
        <div class="row w-100">
          <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="correo" name="email" id="email">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="celular" name="phone" id="phone">
            </div>
          </div>
          <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
              {!! Form::select('id_tp_rol', $roles, null, ['id'=>'id_tp_rol', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
            </div>
            
          </div>
      </div>

      <div class="row">
        <button class="btn btn-primary" onclick="get_user()">BUSCAR</button>
      </div>
      </div>
      
    <div class="row">
      @include('admin.rol_users.table')
    </div>
      
    </div>
  </div>
</div>
@endsection 

@section('scripts')
<script src="{{ asset('plugins/DataTable/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/DataTable/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('js/panel/rol_users/index.js')}} "></script>
@endsection
