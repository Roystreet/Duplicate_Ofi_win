@extends('layout.app')
@section('title', 'Token de usuarios')

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
    <div class="card mb-4">
        <div class="card-header">B&uacute;squeda de tokens de usuarios</div>
        <!-- Card body -->
        <div class="bg-light p-4 small">
          <p class="d-inline">Agregar token de usuario:</p>
          <a class="btn float-right btn-primary" href="{!! route('token-usuarios-app.create') !!}">Agregar</a>
        </div>
        @if (session('status')) <!-- Si el token se creó/actualizó correctamente, mostrará el mensaje del controlador -->
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
          <!-- Border Table -->
          <div class="border border-lg rounded mb-4">
              <!-- Tabla de listado de usuarios -->
              <h6 class="small text-muted font-weight-600 card-header">Listado de tokens de usuarios:</h6>
              <div class="p-4 border-bottom">
                <div class="datatable table-responsive">
                  <table class="table table-bordered table-hover" width="100%" cellspacing="0" id="dataTable">
                    <thead>
                      <tr>
                        <th>Acci&oacute;n</th>
                        <th>Token</th>
                        <th>Token Llave</th>
                        <th>Token Code</th>
                        <th>Estatus</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Acci&oacute;n</th>
                        <th>Token</th>
                        <th>Token Llave</th>
                        <th>Token Code</th>
                        <th>Estatus</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <!-- El cuerpo de la tabla lo genera el asset token_users_app/index.js -->
                    </tbody>
                  </table>
                </div>
              </div>
          </div> <!-- END Border Table -->
      </div> <!-- END Card body -->
  </div> <!-- END Card -->
</div> <!-- END Container-fluid -->
@endsection

@section('scripts')
<!-- JS DataTable -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<!-- JS Alertify -->
<script src="{{ asset('alertify/js/alertify.min.js') }}"></script>
<!-- JS de la vista -->
<script src="{{ asset('js/panel/token_users_app/index.js')}} "></script>
@endsection
