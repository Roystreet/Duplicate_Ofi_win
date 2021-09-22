@extends('layout.app')
@section('title', 'Usuarios')

@section('css')
<!-- Datatables -->
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
<style>
  .table {
    width: 100% !important;
  }
</style>
@endsection

@section('content')
@include('layout.page-header')


<div class="clearfix"></div>
@include('flash::message')
<div class="container-fluid mt-n10">

  <div class="card rounded mb-4">
      <!-- Filtros para busqueda -->
      <h6 class="small text-muted font-weight-500 card-header">
        <div class="col-md-10 float-right">
          Formulario de búsqueda
        </div>

        <div class="col-md-2 float-right">
          <a class="btn float-right btn-primary" style="margin-top: -10px;margin-bottom: 5px"  href="{!! route('agentes.create')!!}">Agregar</a>
        </div>
      </h6>
      <form id=formIndexAgents>
          <meta name="csrf-token" content="{{ csrf_token() }}">
          <div class="p-4 border-bottom">
              <!-- Campos del form de búsqueda -->
              <div class="form-row">
                <div class="col-xs-12 col-sm-6">
                  <label for="id_users_app">Usuarios</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-user"></i></div>
                    </div>
                    {!! Form::select('id_users_app', $tpUsersApps, null, ['id'=>'id_users_app', 'placeholder' => 'Seleccione un usuario...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
                  </div>
                  <div><span class="help-block" id="error"></span></div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <label for="email">Correo</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                    </div>
                    {!! Form::text('email', null, ['id'=> 'email', 'class' => 'form-control']) !!}
                  </div>
                  <div><span class="help-block" id="error"></span></div>
                </div>
              </div>

              <div class="form-row">
                <div class="col-xs-12 col-sm-6">
                  <label for="phone">Tel&eacute;fono</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-phone"></i></div>
                    </div>
                    {!! Form::text('phone', null, ['id'=> 'phone', 'class' => 'form-control']) !!}
                  </div>
                  <div><span class="help-block" id="error"></span></div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <label for="id_country">Pa&iacute;s</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-map-marked-alt"></i></div>
                    </div>
                    {!! Form::select('id_country', $pais, null, ['id'=>'id_country', 'placeholder' => 'Seleccione un país...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
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

  <div class="card rounded mb-4">
      <h6 class="small text-muted font-weight-500 card-header">Listado de Agentes</h6>
      <div class="p-4 border-bottom">
          @include('admin.agents.table')
      </div>
      <div class="bg-light p-4 small">
      </div>
  </div>
@endsection

@section('scripts')
<!-- JS DataTable -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('alertify/js/alertify.min.js') }}"></script>
<script src="{{ asset('js/panel/agents/index.js')}} "></script>
@endsection
