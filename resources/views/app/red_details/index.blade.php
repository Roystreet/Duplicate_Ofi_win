@extends('layout.app')
@section('title', 'Red Usuarios')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

@endsection

@section('content')

@include('app.page-header')
@include('app.red_details.view_modal')


<div class="container-fluid mt-n10">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <div align="center" class="waiting_ov"></div>

  @if ($user->username)
  <div class="viewRed">

    <!-- Card  -->
    <div class="card mt-3">
      <!-- Card Title Perfil -->
      <div class="card-header border-bottom">General</div>
      <!-- Card Body Perfil -->
      <div class="card-body">
        <div class="box box-success">
          <div class="row tema-back">
            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 color-back margin-content sombra-content">
              <div class="w-100 padding-content">
                <p>
                  <strong>
                    <h1 class="text-muted text-center" id="total_all">-</h1>
                  </strong>
                </p>
              </div>
              <div class="w-100">
                <p class="text-center "> Total de registros</p>
              </div>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 color-back margin-content sombra-content">
              <div class="w-100 padding-content">
                <p>
                  <strong>
                    <h1 class="text-muted text-center" id="total_semana">-</h1>
                  </strong>
                </p>
              </div>
              <div class="w-100">
                <p class="text-center ">Registros semanal</p>
              </div>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 color-back margin-content sombra-content">
              <div class="w-100 padding-content">
                <p>
                  <strong>
                    <h1 class="text-muted text-center" id="total_mes">-</h1>
                  </strong>
                </p>
              </div>
              <div class="w-100">
                <p class="text-center ">Registros mensual</p>
              </div>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 color-back margin-content sombra-content">
              <div class="w-100 padding-content">
                <p>
                  <strong>
                    <h1 class="text-muted text-center" id="niveles">-</h1>
                  </strong>
                </p>
              </div>
              <div class="w-100">
                <p class="text-center ">Niveles</p>
              </div>
            </div>
          </div>
        </div>
      </div><!-- END Card Body  -->
    </div><!-- END Card  -->

    <div class="card mt-3">
      <!-- Card Title  -->
      <div class="card-header border-bottom">Estadistica</div>
      <!-- Card Body  -->
      <div class="card-body">
        <div class="box box-success">
          <div class="row tema-back">
            <figure class="highcharts-figure">
              <div id="container"></div>
              <p class="highcharts-description">
                Puedes ver los registros relizado dependiendo la fecha seleccionada en el área.
              </p>
            </figure>

          </div>
        </div>
      </div><!-- END Card Body  -->
    </div><!-- END Card  -->

    <div class="card mt-3">
      <!-- Card Title  -->
      <div class="card-header border-bottom">Su red</div>
      <!-- Card Body  -->
      <div class="card-body">
        <div class="box box-success">
          <div class="row tema-back" style="overflow-x: scroll;">
            <table id="usuarios" class="table table-sm w-100">
              <thead>
                <tr>
                  <th>Nivel</th>
                  <th>Usuario</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Correo</th>
                  <th>Telefono</th>
                  <th>Estatus</th>
                  <th>Ver</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>

          </div>
        </div>
      </div><!-- END Card Body  -->
    </div><!-- END Card  -->

    <div class="card mt-3">
      <!-- Card Title  -->
      <div class="card-header border-bottom">Ver red</div>
      <!-- Card Body  -->
      <div class="card-body">


        <div class="card-body">
          <div class="box box-success">
            <div class="row tema-back">

              <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 color-back">
                <div class="card h-100 w-100">
                  <img class="card-img-top" src="https://static.observableusercontent.com/thumbnail/02452067d052d66adffe1cbae750bb0fdbf0209075422cc3815fdd97ae56490f.jpg" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title text-center">Vista Circular</h5>
                    <p class="card-text">Ideal para ver red grandes y extensas.</p>
                    <a href="{{ route('red-view-circular')}}" class="btn btn-block btn-primary">Ver</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 color-back ">
                <div class="card h-100 w-100">
                  <img class="card-img-top" src="https://static.observableusercontent.com/thumbnail/681d16879a0e9077d3f2d72873aa067de6f5ca806a7bb6914c8c2441e5438057.jpg" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title text-center">Vista Clásica</h5>
                    <p class="card-text">Ver la red en formato clasica horizontal</p>
                    <a href="{{ route('red-view-clasico')}}" class="btn btn-block btn-primary">Ver</a>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div><!-- END Card Body  -->
      </div><!-- END Card Body  -->
    </div><!-- END Card  -->

  </div>
  @else
    <div class="card mb-4 col-xs-12 col-lg-10">
      <!-- Card Title -->
      <div class="card-header">Información!</div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="position-relative">
          <div class="row align-items-center justify-content-between">
            <div class="col-xl col-lg-12 text-justify">
              <p class="text-gray-700">Es importante para nosotros que completes tu información.
                  <br><br>Dirigite a <b>"Mi Perfil"</b> agrega todos tus datos.</p>
                <p class="text-gray-700">¡Gracias por ser parte de la gran familia Win Rideshare!</p>
                <p class="text-gray-700">Somos la primera red social monetizada de transporte. Somos WINRIDES</p>
              </div> <!-- END col -->
              <div class="col d-none d-md-block text-right pt-3 text-center"><img class="img-fluid mt-n5" src="images/FuncionalidadesApp/SistemaReferidos.png" style="max-width: 20rem;max-height: 12rem;" /></div>
            </div> <!-- END row -->
          </div>
        </div> <!-- END Card Body -->
      </div> <!-- END Card -->
  @endif




</div>

@endsection

@section('scripts')


<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script src="{{ asset('js/app/red_details/index.js') }}"></script>

@endsection
