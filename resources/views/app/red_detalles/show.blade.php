@extends('layouts.app')
@section('title', 'Red Detalles')

@section('css')
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
<link rel="stylesheet" href="{{ asset('css/detallesred.css') }}">
<link rel="stylesheet" href="{{ asset('browers/css/perfil.css') }}">
<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">

@endsection

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />
{{ csrf_field() }}

<div class="content">
  <div class="box box-widget widget-user-2">

    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-gray">
      <div class="col-sm-5">
        <img src= "{{ asset('img/logotipo.png') }}" width="250" height="70"/>
      </div>
      <!-- /.widget-user-image -->
      <div class="col-sm-7" align="center">
        <h3 class="widget-user-username">{{ ($dataUser->nombres)? $dataUser->nombres : '-' }} {{ ($dataUser->apellidos)? $dataUser->apellidos : '-' }}</h3>
        <h5 class="widget-user-desc">{{ ($dataUser->tp_rol)? $dataUser->tp_rol : '-' }}</h5>
      </div>
      <br>
      <br>
      <br>
    </div>

    <div class="box-footer">
      <div class="row">
        <div class="col-sm-4 border-right">
          <div class="description-block">


            <div class="description-block infoRed">
                <h5 class="description-header"><label id="totalRed"><i class="fa fa-spinner fa-spin"></i></label></h5>
                <span class="description-text">Total red</span>
            </div>
          </div>


          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4 border-right">
          <div class="description-block">
            <h5 class="description-header"><label id="totalRedDirecta"><i class="fa fa-spinner fa-spin"></i></label></h5>
            <span class="description-text">Red Directa</span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4">
          <div class="description-block">
            <h5 class="description-header"><label id="totalRedInDirecta"><i class="fa fa-spinner fa-spin"></i></label></h5>
            <span class="description-text">Red Indirecta</span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>

  </div>

  <div class="box box-success">

    <div class="box-header with-border">
      <h5 class="box-title">Métodos de búsqueda:</h5>
    </div>
    <div class="box-body">

      <form method="post"  id="formSearchRed">
        <div class="row">
        <div class="col-xs-6">
          <div class="form-group">
            <label for="exampleInputEmail1">Busqueda por:</label>
            {!! Form::select('campo_busqueda', $filtros, null, ['id'=>'campo_busqueda', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
          </div>
        </div>
        <div class="col-xs-6">
          <div class="form-group">
            <label for="exampleInputEmail1">Buscar:</label>
            <input type="text" id="campo" name="campo" class="form-control" placeholder="Buscar...">
          </div>
        </div>
        <div class="col-xs-12" align="center">
          <div class="form-group">
            {!! Form::button('Buscar',  ['id'=>'searchButton', 'class' => 'btn btn-registro btn-default']) !!}
          </div>
        </div>
      </div>
      </form>

    </div>

    <div class="col-sm-12" align="right">
        <input type="hidden" class="form-control" id="nivelBusqueda">
        <input type="hidden" class="form-control" id="sponsorPadre" value="{{ $sponsor }}">
        <p>
          <button type="button" data-paso="anterior"  id="anterior"  class="btn btn-xs bg-olive margin nivel" disabled='disabled'>
            <i class="fa fa-backward"></i>
          </button>
            <label id="level">Nivel 1</label>
          <button type="button" data-paso="siguiente" id="siguiente" class="btn btn-xs bg-olive margin nivel" ><i class="fa fa-forward"></i></button>
        </p>
    </div>

    <!-- /.box-body -->
    <div class="clearfix"></div>
    <div class="box box-success">
      <div class="box-body">
        @include('app.red_detalles.table')
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-show">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h1 class="panel-title pull-left">Mi Perfil | Detalles</h1>
          <h1 class="panel-title pull-right">
          <button type="button" class="btn btn-block btn-success btn-xs" id="searchlevel">Nivel  <label class="nivel_html"></label></button>
          </h1>
      </div>
      <input type="hidden"  id="nivelModal" name="nivelModal">

      <div class="modal-body">

        <div class="row directosDetails"   style="display:none">

          <!-- col1 -->
          <div class="col-xs-12 col-sm-3 center">
            <!-- Foto -->
            <div align="center" valign="middle" class="tdFoto" width="400px" height="293px">
              <img src="{{ asset('browers/img/usuario.png') }}" width="160px" height="160px" class="img-circle" alt=""><br><br><br>
            </div>
          </div>
          <div class="col-xs-12 col-sm-9">

            <!-- Nombre -->
            <h4 class="blue"><span class="middle"> <label class="nombres_html"></label>, <label class="apellidos_html"></label> </span></h4>
            <div class="profile-user-info">

              <!--Sponsor  -->
              <div class="profile-info-row">
                <div class="profile-info-name"> Sponsor </div>
                <div class="profile-info-value">
                  <span><label class="sponsor_html"></label></span>
                </div>
              </div>

              <!-- Nivel -->
              <div class="profile-info-row">
                <div class="profile-info-name"> Perfil </div>
                <div class="profile-info-value">
                  <span><label class="rol_html"></label></span>
                </div>
              </div>


              <!-- E-mail -->
              <div class="profile-info-row">
                <div class="profile-info-name"> E-mail </div>
                <div class="profile-info-value">
                  <span><label class="email_html"></label></span>
                </div>
              </div>
              <!-- Telefono -->
              <div class="profile-info-row">
                <div class="profile-info-name"> Tel&eacute;fono</div>
                <div class="profile-info-value">
                  <span><label class="telefono_html"></label></span>
                </div>
              </div>

              <!-- USUARIO -->
              <div class="profile-info-row">
                <div class="profile-info-name"> Usuario </div>
                <div class="profile-info-value">
                  <span><label class="usuario_invitado_html"></label></span>
                </div>
              </div>

              <!-- CODIGO -->
              <div class="profile-info-row">
                <div class="profile-info-name"> Codigo </div>
                <div class="profile-info-value">
                  <span><label class="codigo_invitado_html"></label></span>
                </div>
              </div>

              <!--Registrado desde  -->
              <div class="profile-info-row">
                <div class="profile-info-name">Registrado </div>
                <div class="profile-info-value">
                  <span><label class="creado_html"></label></span>
                </div>
              </div>

              <!-- Estatus  -->
              <div class="profile-info-row">
                <div class="profile-info-name"> Estatus </div>
                <div class="profile-info-value">
                  <span><label class="estatus_html"></label></span>
                </div>
              </div>

            </div>

        </div>
      </div>

        <div class="row indirectosDetails" style="display:none">

          <!-- col1 -->
          <div class="col-xs-12 col-sm-3 center">
            <!-- Foto -->
            <div align="center" valign="middle" class="tdFoto" width="400px" height="293px">
              <img src="{{ asset('browers/img/usuario.png') }}" width="160px" height="160px" class="img-circle" alt=""><br><br><br>
            </div>
          </div>
          <div class="col-xs-12 col-sm-9">

            <!-- Nombre -->
            <h4 class="blue"><span class="middle"> <label class="nombres_html"></label>, <label class="apellidos_html"></label> </span></h4>
            <div class="profile-user-info">

              <!--Sponsor  -->
              <div class="profile-info-row">
                <div class="profile-info-name"> Sponsor </div>
                <div class="profile-info-value">
                  <span><label class="sponsor_html"></label></span>
                </div>
              </div>

              <!-- Nivel -->
              <div class="profile-info-row">
                <div class="profile-info-name"> Perfil </div>
                <div class="profile-info-value">
                  <span><label class="rol_html"></label></span>
                </div>
              </div>

              <!-- USUARIO -->
              <div class="profile-info-row">
                <div class="profile-info-name"> Usuario </div>
                <div class="profile-info-value">
                  <span><label class="usuario_invitado_html"></label></span>
                </div>
              </div>

              <!-- CODIGO -->
              <div class="profile-info-row">
                <div class="profile-info-name"> Codigo </div>
                <div class="profile-info-value">
                  <span><label class="codigo_invitado_html"></label></span>
                </div>
              </div>

            </div>

          </div>

        </div>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('plugins/DataTable/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/DataTable/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('alertify/js/alertify.min.js') }}"></script>
@if($rol->id_tp_rol == 2)
<script src="{{ asset('js/app/red_detalles/showPromotor.js')}} "></script>
@else
<script src="{{ asset('js/app/red_detalles/showGeneral.js')}} "></script>
@endif
@endsection
