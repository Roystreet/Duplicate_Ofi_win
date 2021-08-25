<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Etiquetas meta -->
        <meta charset="utf-8">
        <meta name="DC.Language" scheme="RFC1766" content="Spanish">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="Sistema de oficina vistual de WIN Rideshare"/>
        <meta name="keywords" content="Oficina virtial, WIN, Win Rideshare, Rideshare, Win tecnologies"/>
        <meta name="author" content="Brenda Atto, Gloribel Delgado, Luis Piñero, Mauro Gómez, Royner Bracamonte, Susana Piñero, Víctor Pérez" />
        <meta name="copyright" content="WIN TECNOLOGIES INC S.A." />
        <meta name="reply-to" content="sistemas@winhold.net">
        <link REV="made" href="mailto:sistemas@winhold.net">
        <meta http-equiv="cache-control" content="no-cache"/>
        <meta http-equiv="expires" content="43200"/>
        <meta name="Resource-type" content="Manual">
        <meta name="Revisit-after" content="1 days">
        <meta name="robots" content="ALL">
        <!-- Título de la página -->
        <title>Perfil - Oficina Virtual</title>
        <!-- Ícono -->
        <link rel="icon" type="image/x-icon" href="{{asset('/img/win_mark.png')}}" />
        <!-- Fuentes -->
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>
        <!-- Estilos -->
        <link rel="stylesheet" href="{{asset('/css/theme_admin.css')}}"/>
        <link rel="stylesheet" href="{{asset('/css/style_ov.css')}}">
        <!-- The core Firebase JS SDK is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
        <!-- TODO: Add SDKs for Firebase products that you want to use
             https://firebase.google.com/docs/web/setup#available-libraries -->
        <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-analytics.js"></script>
        <script>
          // Your web app's Firebase configuration
          // For Firebase JS SDK v7.20.0 and later, measurementId is optional
          var firebaseConfig = {
            apiKey: "AIzaSyCAvMf4nZ0y12VId9BbkJ_FCc_6f7HhC78",
            authDomain: "win-ov-int.firebaseapp.com",
            projectId: "win-ov-int",
            storageBucket: "win-ov-int.appspot.com",
            messagingSenderId: "94057320763",
            appId: "1:94057320763:web:c39825fd89ab1aa22ae71e",
            measurementId: "G-W6LV5VXSRS"
          };
          // Initialize Firebase
          firebase.initializeApp(firebaseConfig);
          firebase.analytics();
        </script>
    </head>
    <body>

        <!-- Container-fluid -->
        <div class="container-fluid mt-2">

          <!-- Mensaje de carga -->
          <div align="center" class="waiting_ov">
          </div>

          <!-- Card Perfil -->
          <div class="card">
            <!-- Card Title Perfil -->
            <div class="card-header border-bottom">Mi Perfil</div>
            <!-- Card Body Perfil -->
            <div class="card-body">
                <div class="box box-success">
                    <div class="box-body box-profile text-center">
                        <img class="profile-user-img img-responsive img-circle" src="../../browers/img/usuario.png" alt="Imagen de Perfil">
                        <h6 class="profile-username text-center">{!! Auth::user()->email !!}</h6>
                        <p class="text-muted text-center">{{ $usersApp->tp_rol }}</p>
                        <ul class="list-group list-group-unbordered text-justify">
                          <li class="list-group-item">
                            <b>Mi Red:</b> <a class="pull-right">{{ $redUsersApp->redUserMe }}</a>
                          </li>
                          <li class="list-group-item">
                            <b>Activos:</b> <a class="pull-right">{{ $redUsersApp->redUserMeActv }}</a>
                          </li>
                          <li class="list-group-item">
                            <b>Inactivos:</b> <a class="pull-right">{{ $redUsersApp->redUserMeInactv }}</a>
                          </li>
                        </ul>
                    </div>
                </div>
            </div><!-- END Card Body Perfil -->
          </div><!-- END Card Perfil -->

          <!-- Card ver datos Perfil -->
          <div class="card mt-3">
            <!-- Card Title datos perfil -->
            <div class="card-header border-bottom">Mi información de usuario</div>
            <!-- Card Body datos perfil -->
            <div class="card-body">
              <div class="verPerfilDiv">
                <div class="user-detalle-view">
                  <div class="pl-3 pr-3">
                      <!-- Campos de mostrar los datos de usuario -->
                      <div class="form-row">
                        <div class="col-12">
                          <label for="id_users_app">Nombre completo:</label>
                          <div class="input-group mb-2">
                            <h4 class="blue">{{ $usersApp->nombres }}, {{ $usersApp->apellidos }}</h4>
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-xs-12 col-sm-6">
                          <label>Tipo de documento:</label>
                          <div class="bg-light border p-3 mb-3">{{ $usersApp->tp_document }}</div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                          <label>N&uacute;mero de documento:</label>
                          <div class="bg-light border p-3 mb-3">{{ $usersApp->nro_document }}</div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-xs-12 col-sm-6">
                          <label>Correo:</label>
                          <div class="bg-light border p-3 mb-3">{{ $usersApp->email }}</div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                          <label>Tel&eacute;fono:</label>
                          <div class="bg-light border p-3 mb-3">{{ $usersApp->telefono }}</div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-xs-12 col-sm-6">
                          <label>Fecha/Nacimiento:</label>
                          <div class="bg-light border p-3 mb-3">{!! date('d-m-Y', strtotime($usersApp->f_nacimiento)); !!}</div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                          <label>Sexo:</label>
                          <div class="bg-light border p-3 mb-3">{{ $usersApp->sexo }}</div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-xs-12 col-sm-6">
                          <label>Pa&iacute;s:</label>
                          <div class="bg-light border p-3 mb-3">{{ $usersApp->country }}</div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                          <label>Departamento:</label>
                          <div class="bg-light border p-3 mb-3">{{ $usersApp->departament }}</div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-xs-12 col-sm-6">
                          <label>Ciudad:</label>
                          <div class="bg-light border p-3 mb-3">{{ $usersApp->city }}</div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                          <label>Distrito:</label>
                          <div class="bg-light border p-3 mb-3">{{ $usersApp->distrito }}</div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-xs-12 col-sm-6">
                          <label>Estado del usuario:</label>
                          <div class="bg-light border p-3 mb-3">{{ $usersApp->status_users_app }}</div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                          <label>&Uacute;ltima Conexi&oacute;n:</label>
                          <div class="bg-light border p-3 mb-3">{{ $usersApp->ult_session }}</div>
                        </div>
                      </div>
                      <!-- END Campos de mostrar los datos de usuario -->
                   </div>
                </div>
              </div>
            </div><!-- END Card Body datos perfil -->
          </div><!-- END Card ver datos Perfil -->
        </div><!-- END Container-fluid -->

        <!-- Footer -->
        <footer class="footer mt-auto footer-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 small">Copyright &copy; WIN Rideshare {{ date('Y') }}</div>
                    <div class="col-md-6 text-md-right small">
                        <a href="#!">Políticas de privacidad</a>
                        &middot;
                        <a href="#!">Términos &amp; Condiciones</a>
                    </div>
                </div>
            </div>
        </footer> <!-- END Footer -->

        <!-- jQuery 3.4.1 -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <!-- bootstrap js 4.3.1 -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <!-- JS theme_admin -->
        <script src="{{ asset('/js/theme_admin.js') }} "></script>
    </body>
</html>
