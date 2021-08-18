@extends('layouts.app')
@section('title', 'Listado de usuarios')

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
<div class="page-header pb-10 page-header-dark bg-content">
    <div class="container-fluid">
        <div class="page-header-content">
            <h1 class="page-header-title">
                <div class="page-header-icon"><i class="fas fa-user"></i></div>
                <span>Usuarios</span>
            </h1>
            <div class="page-header-subtitle"><i class="fas fa-search"></i><span class="pl-2">Buscar y listar los usuarios de la Oficina Virtual</span></div>
        </div>
    </div>
</div>


<div class="clearfix"></div>
@include('flash::message')
<div class="container-fluid mt-n10">
    <!-- Card -->
    <div class="card mb-4">
        <div class="card-header">Búsqueda de usuarios</div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Border Form -->
            <div class="border border-lg rounded mb-4">
                <!-- Filtros para busqueda -->
                <h6 class="small text-muted font-weight-500 card-header">Formulario de búsqueda:</h6>
                <form id=formIndexUserApps>
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
                            <label for="telefono">Tel&eacute;fono</label>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-phone"></i></div>
                              </div>
                              {!! Form::text('telefono', null, ['id'=> 'telefono', 'class' => 'form-control']) !!}
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

                        <div class="form-row">
                          <div class="col-xs-12 col-sm-6">
                            <label for="id_status_users_app">Estado</label>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-check-square"></i></div>
                              </div>
                              {!! Form::select('id_status_users_app', $estatus_users, null, ['id'=>'id_status_users_app', 'placeholder' => 'Seleccione un estatus...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
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
            <!-- Border Table -->
            <div class="border border-lg rounded mb-4">
                <!-- Tabla de listado de usuarios -->
                <h6 class="small text-muted font-weight-500 card-header">Listado de usuarios:</h6>
                <div class="p-4 border-bottom">
                    @include('panel.users_apps.table')
                </div>
                <div class="bg-light p-4 small">
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
<script src="{{ asset('alertify/js/alertify.min.js') }}"></script>
<script src="{{ asset('js/panel/users_apps/index.js')}} "></script>
@endsection
