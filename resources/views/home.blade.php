@extends('layout.app')
@section('title', 'Panel')

@section('css')
<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
<style media="screen">

</style>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
{{ csrf_field() }}

<!-- Cabecera del contenedor de la vista -->
@include('app.page-header')

<!-- Container-fluid -->
<div class="container-fixed mt-n10 row justify-content-center" >
    @include('flash::message')
    @if ($rolUser == null)
    <div class="card" style="width:700px;">
        <div class="card-header">Red | Informaci&oacute;n detallada. </div>
        <div class="card-body">

          <form method="POST" action="{{ route ('saveSponsor') }}" id="formUserRol">
            <input type="hidden" name="tp_invited"       id="tp_invited">
            <input type="hidden" name="id_user_sponsor"  id="id_user_sponsor">
            <input type="hidden" name="tp_rol"           id="tp_rol">

            <meta name="csrf-token" content="{{ csrf_token() }}" />

            {{ csrf_field() }}

            <div class="row sponsor_panel">
              <div class="col-md-12 tp_campos_row">
                <label>Selcciona el campo de b&uacute;squeda</label>
                <hr>

                <div class="form-group">
                  <div align="center">
                    <a id="usuario_invitado"   class="w-25 p-2 btn btn-app btn-type-sponsor">
                      <i class="fa fa-user"></i>&nbsp; Usuario
                    </a>
                    <a id="codigo_invitado"   class="w-25 p-2 btn btn-app btn-type-sponsor">
                      <i class="fa fa-qrcode"></i>&nbsp; Código
                    </a>
                  </div>
                </div>
                <hr>
              </div>

              <div class="col-md-12 search_row" style="display:none">
                <div class="form-group">
                  <div class="input-group">
                    <input class="form-control" type="text" name="sponsor" id="sponsor"  placeholder="Búsqueda..." aria-required="true">
                    <span class="input-group-addon"><a class="btn btn-success" id="fa_search"  ><i class="fa fa-search"></i></a></span>
                  </div>
                  <div>&nbsp;&nbsp;&nbsp;&nbsp;<span class="help-block" id="error"></span></div>
                </div>
              </div>

              <div class="col-md-12 table_data" style="display:none">
                <label>Sponsor</label>
                <div class="table-responsive" style="max:width:600px;">
                  <table class="stripe row-border order-column" style="width:100%">
                    <tr>
                      <td rowspan="2" align="center"><label id="name_sponsor_data_nombres"></label>, <label id="name_sponsor_data_apellidos"></label></td>
                      <td align="left"  style="padding-left: 10px;">
                        <a id="confirm_sponsor"><i class="fa fa-check"></i> <label id="confirm_case"></label></a>
                      </td>
                    </tr>
                    <tr>
                      <td align="left"  style="padding-left: 10px;">
                        <a id="search_again"><i class="fa fa-chevron-left"></i> Buscar de nuevo</a>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>


            </div>
            <br>

            <div class="row cuenta_user" style="display:none">
              <div class="col-md-12">
                <div class="form-group">
                  <label for=password>Cuenta</label>
                  <div align="center">
                    <a id="promotor" data-id="2"  class="w-25 p-2 btn btn-app btn-cuenta">
                      <i class="fa fa-industry"></i>&nbsp;Embajador
                    </a>
                    <a id="conductor" data-id="4" class="w-25 p-2 btn btn-app btn-cuenta">
                      <i class="fa fa-taxi"></i>&nbsp;Conductor
                    </a>
                    <a id="pasajero"  data-id="3" class="w-25 p-2 btn btn-app btn-cuenta">
                      <i class="fa fa-user"></i>&nbsp;Pasajero
                    </a>
                  </div>
                </div>
                <hr>
                <button class="btn btn-registro btn-block btn-warning generalbutton" type="submit">Guardar</button>
                <br>
                <div align="center" class="waiting_ov"></div>
              </div>
            </div>

          </form>
        </div>
    </div> <!-- END Card -->
    @else

    <!-- Mensade de bienvenida para el usuario con registro completo -->
    <!-- Card -->

    <div class="card mb-4 col-xs-12 col-lg-10">
        <!-- Card Title -->
        <div class="card-header">Bienvenido(a), tu oficina virtual está lista!</div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="position-relative">
              <div class="row align-items-center justify-content-between">
                <div class="col-xl col-lg-12 text-justify">
                    <p class="text-gray-700">Recibe una cordial bienvenida a tu Oficina Virtual. Hemos diseñado una interfaz más intuitiva y fácil de navegar. Aquí podrás ver a toda tu organización (tu red social) además de contar con capacitación constante.
                      Para cualquier consulta tienes a tu disposición nuestro canal de comunicación al cual puedes acceder desde el menú en la parte izquierda link "información".</p>
                    <p class="text-gray-700">¡Gracias por ser parte de la gran familia Win Rideshare!</p>
                    <p class="text-gray-700">Somos la primera red social monetizada de transporte. Somos WINRIDES</p>
                </div> <!-- END col -->
                <div class="col d-none d-md-block text-right pt-3 text-center"><img class="img-fluid mt-n5" src="https://i.postimg.cc/PrM7hmgB/Comunicados-DEVWIN-BO-2.png" style="max-width: 20rem;" /></div>
              </div> <!-- END row -->
           </div>
        </div> <!-- END Card Body -->
    </div> <!-- END Card -->
    @endif
</div> <!-- END Container-fluid -->
@endsection

@section('scripts')
<!-- Llamado del script de esta vista -->
<script src="{{ asset('alertify/js/alertify.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/app/home.js')}} "></script>
@endsection
