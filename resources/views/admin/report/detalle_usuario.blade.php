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
      <input id="id" name="id" type="hidden" value="{{$id}}">
    </div>
    <!-- Card  -->
    <div class="card mt-3">
      <!-- Card Title Perfil -->
      <div class="card-header border-bottom">Datos basicos</div>
      <!-- Card Body Perfil -->
      <div class="card-body">
          <div class="box box-success">
                <div class="row tema-back">

                    <div class="row w-100 p-2">
                      <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <input type="text" class="form-control" placeholder="Usuario" id="user" >
                      </div>
                      <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <input type="text" class="form-control" placeholder="Correo" id="email">
                      </div>
                      <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <div class="row w-100">
                          <select class="form-control col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <option>Código Pais</option>
                          </select>
                          <input type="text" class="form-control col-sm-7 col-md-7 col-lg-7 col-xl-7" placeholder="Telefono" id="phone">
                        </div>
                        
                      </div>
                    </div>

                    <div class="row w-100 p-2">
                      <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <input type="text" class="form-control" placeholder="Nombres" id="first_name" onkeyup="mayus(this);">
                      </div>
                      <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <input type="text" class="form-control" placeholder="Apellidos" id="last_name" onkeyup="mayus(this);">
                      </div>

                      <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <input type="text" class="form-control" placeholder="Dirección" id="address" onkeyup="mayus(this);">
                      </div>
                    </div>

                    <div class="row w-100 p-2">
                      <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <button class="btn btn-primary" onclick="editar()">Editar</button>
                      </div>
                    </div>
                </div>
          </div>
      </div><!-- END Card Body  -->
    </div><!-- END Card  -->

     <!-- Card  -->
     <div class="card mt-3">
      <!-- Card Title Perfil -->
      <div class="card-header border-bottom">Login</div>
      <!-- Card Body Perfil -->
      <div class="card-body">
          <div class="box box-success">
                <div class="row tema-back">

                    <div class="row w-100 p-2">
                      <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <input type="text" class="form-control" placeholder="Contraseña" id="password" >
                      </div>
                      {{-- <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <input type="text" class="form-control" placeholder="Repetir contraseña" id="password_repedida">
                      </div> --}}

                      <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <button class="btn btn-primary" onclick="restaurar()">Cambiar contraseña</button>
                      </div>
                    </div>

                    <div class="row w-100 p-2">
                      <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <button class="btn btn-primary" onclick="restaurar_x_correo()">Restaurar contraseña por correo</button>
                      </div>

                    </div>
                </div>
          </div>
      </div><!-- END Card Body  -->
    </div><!-- END Card  -->


         <!-- Card  -->
         <div class="card mt-3">
          <!-- Card Title Perfil -->
          <div class="card-header border-bottom">Estatus</div>
          <!-- Card Body Perfil -->
          <div class="card-body">
              <div class="box box-success">
                    <div class="row tema-back">
                        <div class="row w-100 p-2">
                          <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                            <ul type=”A”>
                              <li><label><input type="checkbox" id="app" value="F">Activo app</label><br></li>
                              <li><label><input type="checkbox" id="ov" value="F">Activo O.V.</label><br></li>
                            </ul>
                          </div>
                        </div>
                  </div>
              </div>
            </div><!-- END Card Body  -->
          </div><!-- END Card  -->

@endsection

@section('scripts')


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script src="{{ asset('js/report/detalle_usuario.js') }}"></script>

@endsection
