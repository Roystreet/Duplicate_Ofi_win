<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Etiquetas meta -->
  <meta charset="utf-8">
  <meta name="DC.Language" scheme="RFC1766" content="Spanish">
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta name="description" content="Sistema de oficina virtual de WIN Rideshare" />
  <meta name="keywords" content="Oficina virtial, WIN, Win Rideshare, Rideshare, Win tecnologies" />
  <meta name="author" content="Ariana Valenzuela, Brenda Atto, Gloribel Delgado, Luis Piñero, Mauro Gómez, Royner Bracamonte, Susana Piñero, Víctor Pérez" />
  <meta name="copyright" content="WIN TECNOLOGIES INC S.A." />
  <meta name="reply-to" content="sistemas@winhold.net">
  <link rev="made" href="mailto:sistemas@winhold.net">
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="43200" />
  <meta name="Resource-type" content="Manual">
  <meta name="Revisit-after" content="1 days">
  <meta name="robots" content="ALL">

  <!-- Título de la página -->
  <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
  <!-- Ícono -->
  <link rel="icon" type="image/x-icon" href="{{asset('/img/win_mark.png')}}" />
  <!-- Fuentes -->
  <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>
  <!-- Estilos -->

  <link rel="stylesheet" href="{{asset('/css/theme_admin.css')}}" />
  <link rel="stylesheet" href="{{asset('/css/style_ov_admin.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  @yield('css')

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="nav-fixed">
  @if (!Auth::guest())
  <!-- Si el ingreso es de un administrador... -->
  <!-- Nav Admin -->
  <nav class="topnav navbar navbar-expand shadow navbar-light" id="sidenavAccordion">
    <!-- Logo -->
    <a class="navbar-brand" href="{{ url('/') }}">
      <img class="img-responsive" src="{{asset('/img/win_2019.png')}}" alt="">
    </a>
    <!-- Menú -->
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#">
      <i data-feather="menu"></i>
    </button>
    <ul class="navbar-nav align-items-center ml-auto">
      <!-- Notificaciones -->
      <li class="nav-item dropdown no-caret mr-3 dropdown-notifications">
        <a class="btn btn-icon dropdown-toggle" id="navbarDropdownMessages" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="mail"></i></a>
        <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownMessages">
          <h6 class="dropdown-header dropdown-notifications-header"><i class="mr-2" data-feather="mail"></i>Notificaciones</h6>
          <a class="dropdown-item dropdown-notifications-footer" href="#!">No hay Notificaciones</a>
        </div>
      </li> <!-- END Notificaciones -->
      <div class="topbar-divider d-none d-sm-block"></div>
      <!-- Perfil -->
      <li class="nav-item dropdown no-caret mr-3 dropdown-user">
        <a class="btn btn-icon dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="img-fluid" src="{{ asset('browers/img/usuario.png')  }}" />
        </a>
        <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
          <h6 class="dropdown-header d-flex align-items-center">
            <img class="dropdown-user-img" src="{{ asset('browers/img/usuario.png')  }}" />
            <div class="dropdown-user-details">
              <div class="dropdown-user-details-name">{{ Auth::user()->first_name }}</div>
            </div>
          </h6>

          @php ($meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"))
          @php ($mes = $meses[Auth::user()->created_at->format('m') -1 ])
          <p class="dropdown-header">Miembro desde {{ $mes }} de {{ Auth::user()->created_at->format('Y') }}</p>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt mr-2 text-gray-400"></i>
            {{ __('Cerrar sesión') }}
          </a>

        </div>
      </li> <!-- END Menú del perfil -->
    </ul>
  </nav> <!-- END Nav Admin -->

  <!-- layout principal -->
  <div id="layoutSidenav">

    <!-- Contiene menú -->
    @include('layout.sidebar')
    <!-- Layout Content  -->
    <div id="layoutSidenav_content">
      <main>
        <!-- Llamada de cada section de las vistas -->
        @yield('content')
        @else
        <!-- END Admin -->

        <!-- Nav Guest -->
        <nav class="topnav navbar navbar-expand shadow navbar-light" id="sidenavAccordion">
          <!-- Logo -->
          <a class="navbar-brand" href="{{ url('/') }}">
            <img class="img-responsive" src="{{asset('/img/win_2019.png')}}" alt="">
          </a>
          <!-- Menú -->
          <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#">
            <i data-feather="menu"></i>
          </button>
          <ul class="navbar-nav align-items-center ml-auto">
            <!-- Notificaciones -->
            <li class="nav-item dropdown no-caret mr-3 dropdown-notifications">
              <a class="btn btn-icon dropdown-toggle" id="navbarDropdownMessages" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="mail"></i></a>
              <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownMessages">
                <h6 class="dropdown-header dropdown-notifications-header"><i class="mr-2" data-feather="mail"></i>Notificaciones</h6>
                <a class="dropdown-item dropdown-notifications-item" href="#!"><img class="dropdown-notifications-item-img" src="{{ asset('browers/img/usuario.png')  }}" />
                  <div class="dropdown-notifications-item-content">
                    <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                    <div class="dropdown-notifications-item-content-details">WIN Pasajero · 58m</div>
                  </div>
                </a><a class="dropdown-item dropdown-notifications-item" href="#!"><img class="dropdown-notifications-item-img" src="{{ asset('browers/img/usuario.png')  }}" />
                  <div class="dropdown-notifications-item-content">
                    <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                    <div class="dropdown-notifications-item-content-details">WIN Conductor · 2d</div>
                  </div>
                </a><a class="dropdown-item dropdown-notifications-footer" href="#!">Leer todos los mensajes</a>
              </div>
            </li> <!-- END Notificaciones -->

            <!-- Perfil Guest -->
            <li class="nav-item dropdown no-caret mr-3 dropdown-user">
              <a class="btn btn-icon dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-fluid" src="{{ asset('browers/img/usuario.png')  }}" />
              </a>
              <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                  <img class="dropdown-user-img" src="{{ asset('browers/img/usuario.png')  }}" />
                  <div class="dropdown-user-details">
                    <div class="dropdown-user-details-name">Invitado</div>
                  </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ url('/home') }}">Cuenta</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ url('/login') }}">Iniciar sesión</a>
                <a class="dropdown-item" href="{{ url('/register') }}">Registrarse</a>
              </div>
            </li> <!-- END Menú del perfil Guest -->
          </ul>
        </nav> <!-- END Nav Guest -->

        <!-- layout principal -->
        <div id="layoutSidenav">

          <!-- Layout Content  -->
          <div id="layoutSidenav_content">
            <main>
              <!-- Llamada de cada section de las vistas -->
              @yield('content')
              @endif
              <!-- END Guest -->

            </main> <!-- END Main Content -->
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
          </div> <!-- END Layout Content -->
        </div><!-- END Layout principal -->
        <!-- Logout Modal-->


        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">¿Desea Salir de la sesión?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">Seleccione "Salir" para salir de la oficina virtual.</div>
              <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">{{ __('Regresar') }}</button>
                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">{{ __('Salir') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </div>
          </div>
        </div><!-- END Logout Modal-->

        <div id="loader-container" class="loader-container" style=" display:none; color: black; z-index: 10; position: fixed; padding-top: 20%;padding-left: 40%;padding-top: 20%;padding-right: 50%; padding-bottom: 50%; left: 0; top: 0; width: 100%; height: 100%;  background-color: rgb(0,0,0); background-color: rgba(255,255,255,0.4);">
          <div class="loader-container">
            <div class="loader"></div>
            <div style=" padding-top: 20%;padding-left: 33%;padding-top: 43%;padding-right: 50%; padding-bottom: 50%;">
              <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </div>
            <div class="loader2"></div>
          </div>
        </div>

        {{-- libreria para formato de numeros --}}
        <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>


        <!-- jQuery 3.4.1 -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <!-- bootstrap js 4.3.1 -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <!-- JS theme_admin -->
        <script src="{{ asset('/js/theme_admin.js') }} "></script>
        <!-- Llamada de los script de cada vista -->
        {{-- confuguraciones --}}
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

        <script src="{{ asset('/js/general/configuracion.js') }} "></script>
        @yield('scripts')
        <script>
          $('div.alert').not('.alert-important').delay(6000).fadeOut(350);
        </script>
</body>

</html>
