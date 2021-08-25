@extends('layout.app')
@section('title', 'Red Usuarios')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

@endsection

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="container-fluid mt-2">
    <div align="center" class="waiting_ov">
    </div>
    <!-- Card  -->
    <div class="card mt-3">
      <!-- Card Title Perfil -->
      <div class="card-header border-bottom">General</div>
      <!-- Card Body Perfil -->
      <div class="card-body">
          <div class="box box-success">
                <div class="row w-100 tema-back">

                    <div class="row w-100 p-2">
                        <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                          <input type="text" class="form-control" placeholder="usuario" id="username" >
                        </div>
                        {{-- <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                          <input type="text" class="form-control" placeholder="Apellidos" id="last_name" onkeyup="mayus(this);">
                        </div> --}}
                    </div>

                    <div class="row w-100 p-2">
                        <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                          <button class="btn btn-success" onclick="buscar()">Buscar</button>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
                       <div class="row w-100 p-2">
                            <figure class="highcharts-figure">
                              <div id="container"></div>
                              <p class="highcharts-description">
                                  Puedes ver los registros relizado dependiendo la fecha seleccionada en el área.
                              </p>
                          </figure>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
                        <div class="row w-100 p-2">
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 color-back margin-content sombra-content p-2">
                                <div class="w-100 padding-content">
                                    <h1 class="text-muted text-center" id="total_user">-</h1>
                                </div>

                                <div class="w-100">
                                    <p class="text-center">Total de registros</p>
                                </div>

                            </div>

                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 color-back margin-content sombra-content p-2">
                                <div class="w-100 padding-content">
                                    <h1 class="text-muted text-center" id="niveles">-</h1>
                                </div>
                                <div class="w-100">
                                    <p class="text-center">Niveles</p>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 color-back margin-content sombra-content p-2">
                                <div class="w-100 padding-content">
                                    <button class="btn btn-success btn-lg btn-block" onclick="descargarExcel()">Excel</button>
                                </div>
                                <div class="w-100">
                                    <p class="text-center">Reporte de sus niveles</p>
                                </div>
                            </div>
                        </div>
                    </div>





                    <div class="row w-100 p-2">
                      <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <button class="btn btn-primary" onclick="buscar()">Buscar</button>
                      </div>
                    </div>

              </div>
          </div>
      </div><!-- END Card Body  -->
    </div><!-- END Card  -->

    <div class="card mt-3">
      <!-- Card Title  -->
      <div class="card-header border-bottom">Respuesta</div>
      <!-- Card Body  -->
      <div class="card-body">
          <div class="box box-success">
                <div class="row tema-back" style="overflow-x: scroll;">
                  <table id="usuarios" class="table table-bordered table-hover nowrap w-100">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            {{-- <th>D.N.I.</th> --}}
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
              </div>
          </div>
      </div><!-- END Card Body  -->
    </div><!-- END Card  -->



  </div>

@endsection

@section('scripts')

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script src="{{ asset('js/report/administracion.js') }}"></script>

@endsection
