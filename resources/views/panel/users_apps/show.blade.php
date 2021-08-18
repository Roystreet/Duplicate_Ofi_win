@extends('layouts.app')
@section('title', 'Listado')

@section('css')
<link rel="stylesheet" href="{{ asset('browers/css/perfil.css') }}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<div class="clearfix"></div>
<div class="content">

  <div class="panel panel-default">
    <div class="panel panel-heading">
      <h1 class="panel-title">Mi Perfil | Detalles </h1>
    </div>
    <div class="content">
      <div class="panel panel-body">

        @include('flash::message')
        <div class="container">

          <h1></h1>
          <div class="row">

            <!-- col1 -->
            <div class="col-xs-12 col-sm-3 center">
              <!-- Foto -->
              <div align="center" valign="middle" class="tdFoto" width="400px" height="293px">
                <img src="../../browers/img/usuario.png" width="160px" height="160px" class="img-circle" alt=""><br><br><br>
              </div>
            </div>

            <!-- col2 -->
            <div class="col-xs-12 col-sm-9">

              <!-- Nombre -->
              <h4 class="blue"><span class="middle"> {!! $usersApp->nombres !!}, {!! $usersApp->apellidos !!} </span></h4>
              <div class="profile-user-info">

                <!-- E-mail -->
                <div class="profile-info-row">
                  <div class="profile-info-name"> E-mail </div>
                  <div class="profile-info-value">
                    <span>{!! $usersApp->email !!}</span>
                  </div>
                </div>

                <!-- Fecha Nacimiento -->
                <div class="profile-info-row">
                  <div class="profile-info-name"> Fecha/Nacimiento </div>
                  <div class="profile-info-value">
                    <span>{!! date('d-m-Y', strtotime($usersApp->f_nacimiento)); !!}</span>
                  </div>
                </div>

                <!-- Sexo -->
                <div class="profile-info-row">
                  <div class="profile-info-name">Sexo</div>
                  <div class="profile-info-value">
                    <span>{!! ($usersApp->id_tp_sexo)?  $usersApp->getSexo->descripcion : '-' !!}</span>
                  </div>
                </div>

                <!-- Telefono -->
                <div class="profile-info-row">
                  <div class="profile-info-name"> Tel&eacute;fono</div>
                  <div class="profile-info-value">
                    <span>{!! $usersApp->telefono !!}</span>
                  </div>
                </div>

                <!-- Direccion -->
                <div class="profile-info-row">
                  <div class="profile-info-name"> Direcci&oacute;n </div>
                  <div class="profile-info-value">
                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                    <span>{!! ( $usersApp->id_country)?  $usersApp->getCountry->country : '-' !!}</span>
                    <span>{!! ( $usersApp->id_departament)?  $usersApp->getDepartament->departament : '-' !!} , {!! ( $usersApp->id_city)?  $usersApp->getCity->city : '-' !!} , {!! ( $usersApp->id_distrito)?  $usersApp->getDistritos->distrito : '-' !!}  </span>
                  </div>
                </div>

                <!-- Estatus  -->
                <div class="profile-info-row">
                  <div class="profile-info-name"> Estatus </div>
                  <div class="profile-info-value">
                    <span>{!! $usersApp->getStatusUsersApp->status_users_app !!}</span>
                  </div>
                </div>

                <!-- Utlima Conexion -->
                <div class="profile-info-row">
                  <div class="profile-info-name"> &Uacute;ltima Conexi&oacute;n </div>
                  <div class="profile-info-value">
                    <span>{!! $usersApp->ult_session !!}</span>
                  </div>
                </div>

              </div>

            </div>

            <!-- /.col -->
            <div class="col-xs-12 col-sm-9">
              <div class="box-botonesPedidos">
                <div class="row justify-content-md-left">
                  <div class="col text-center">
                    <table>
                      <td class="full-width">
                        <a href="{!! route('usuarios-app.index') !!}" class="btn btn-registro btn-default">Listado</a>
                      </td>
                      <td class="full-width">
                        <a href="{!!  route('usuarios-app.edit', [$usersApp->id]) !!}" class="btn btn-registro btn-default">Modificar</a>
                      </td>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col -->

          </div>

        </div>

      </div>
    </div>
  </div>

</div>
@endsection
