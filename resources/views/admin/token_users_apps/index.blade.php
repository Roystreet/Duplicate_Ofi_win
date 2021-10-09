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
        <div class="card-header">
          <div class="col-md-10 float-right">
            B&uacute;squeda de tokens de usuarios
          </div>

          <div class="col-md-2 float-right">
            <a class="btn float-right btn-primary" href="{!! route('token-usuarios-app.create') !!}">Agregar</a>
          </div>
        </div>
        <div class="card rounded mb-4">
      <!-- Filtros para busqueda -->
      <h6 class="small text-muted font-weight-500 card-header">Formulario de búsqueda</h6>
      <form id=formIndexUserApps>
          <meta name="csrf-token" content="{{ csrf_token() }}">
          <div class="p-4 border-bottom">
              <!-- Campos del form de búsqueda -->
              <div class="form-row">
                <div class="col-xs-12 col-sm-6">
                  <label for="id_users_app">Tipo de Token</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-user"></i></div>
                    </div>
                    {!! Form::select('id_tp_token', $tpTokens, null, ['id'=>'id_tp_token', 'placeholder' => 'Seleccione un estatus...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
                  </div>
                  <div><span class="help-block" id="error"></span></div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <label for="email">Token Llave</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                    </div>
                    {!! Form::text('id_llave', null, ['id'=> 'id_llave', 'class' => 'form-control']) !!}
                  </div>
                  <div><span class="help-block" id="error"></span></div>
                </div>
              </div>
  
          </div>
          <div class="bg-light p-4 small">
            <button type="button" class="btn btn-clean btn-default-registro btn-warning" id="clean">Limpiar</button>
            <button type="button" class="btn btn-search float-right btn-default btn-registro btn-primary" id="search">Buscar</button>
          </div>
      </form><!-- END Filtros para busqueda -->
  </div> <!-- END Border Form -->
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
          <table class="table table-sm table-bordered table-hover" width="100%" cellspacing="0" id="dataTable">
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
        </div> <!-- END Border Table -->
      </div> <!-- END Card body -->
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
