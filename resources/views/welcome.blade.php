<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Víctor Enrique Pérez Guevara" />
    <title>Se parte de WIN | Oficina Virtual</title>
    <link href="{{ asset('sb-ui-kit-pro/dist/css/styles.css')  }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="icon" type="image/x-icon" href="{{ asset('img/win_mark.png')  }}" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>
</head>

<body>

    <div id="layoutDefault">
        <div id="layoutDefault_content">
            <main>
                <nav class="navbar navbar-marketing navbar-expand-lg bg-transparent navbar-dark fixed-top">
                    <!-- Información -->
                    <div class="container">
                        <a class="navbar-brand " href="#"><img src="images/logo.png" alt="Logo WIN Perú"></a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto mr-lg-1">
                                <li class="nav-item">
                                    <div class="first"><a class="" id="inf">Información</a></div>
                                </li>
                            </ul>
                            @if (Auth::guest())
                            <a class="nav-link info" href="{!! route('login') !!}">Iniciar sesión &nbsp;<i class="fas fa-user ml-1"></i></a>
                            @else
                            <a class="nav-link info" href="{!! route('home') !!}">Inicio &nbsp;<i class="fas fa-home ml-1"></i></a>
                            @endif

                            <a class="btn-primary btn rounded-pill px-4 ml-lg-4" href="{!! route('registro') !!}">Registrate</a>
                        </div>
                    </div>

                </nav>
                <meta name="csrf-token" content="{{ csrf_token() }}" />
                {{ csrf_field() }}
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
                    <div class="page-header-content mb-n5">
                        <div class="container">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-lg-6" data-aos="fade-right">
                                    <h1 class="page-header-title">Descarga el App</h1>
                                    <p class="page-header-text mb-5">Empieza a ganar con Win</p>
                                    <div class="mb-5 mb-lg-0">
                                        <a class="mr-3" href="https://apps.apple.com/pe/app/win-rideshare/id1458838759"><img src="{{ asset('sb-ui-kit-pro/dist/assets/img/app-store-badge.svg')  }}" style="height: 3rem;" /></a><a href="https://play.google.com/store/apps/details?id=com.winrideshare.passenger"><img src="{{ asset('sb-ui-kit-pro/dist/assets/img/google-play-badge.svg')  }}" style="height: 3rem;" /></a>
                                        <div class="page-header-text mt-2 text-xs font-italic">* Requiere Android OS 6.0+ ó Apple iOS 10.0+</div>
                                    </div>
                                </div>
                                <div class="col-lg-6 z-1" data-aos="fade-left">
                                    <div class="device-wrapper mx-auto mb-n15">
                                        <div class="device" data-device="iPhoneX" data-orientation="portrait" data-color="black">
                                            <div class="screen"><img class="img-fluid z-1" src="images/app_welcome.jpg" /></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-waves text-white">
                        <svg class="wave" style="pointer-events: none" fill="currentColor" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 75">
                            <defs>
                                <style>
                                    .a {
                                        fill: none;
                                    }

                                    .b {
                                        clip-path: url(#a);
                                    }

                                    .d {
                                        opacity: 0.5;
                                        isolation: isolate;
                                    }
                                </style>
                                <clippath id="a">
                                    <rect class="a" width="1920" height="75"></rect>
                                </clippath>
                            </defs>
                            <title>wave</title>
                            <g class="b">
                                <path class="c" d="M1963,327H-105V65A2647.49,2647.49,0,0,1,431,19c217.7,3.5,239.6,30.8,470,36,297.3,6.7,367.5-36.2,642-28a2511.41,2511.41,0,0,1,420,48"></path>
                            </g>
                            <g class="b">
                                <path class="d" d="M-127,404H1963V44c-140.1-28-343.3-46.7-566,22-75.5,23.3-118.5,45.9-162,64-48.6,20.2-404.7,128-784,0C355.2,97.7,341.6,78.3,235,50,86.6,10.6-41.8,6.9-127,10"></path>
                            </g>
                            <g class="b">
                                <path class="d" d="M1979,462-155,446V106C251.8,20.2,576.6,15.9,805,30c167.4,10.3,322.3,32.9,680,56,207,13.4,378,20.3,494,24"></path>
                            </g>
                            <g class="b">
                                <path class="d" d="M1998,484H-243V100c445.8,26.8,794.2-4.1,1035-39,141-20.4,231.1-40.1,378-45,349.6-11.6,636.7,73.8,828,150"></path>
                            </g>
                        </svg>
                    </div>
                </header>
                <section class="bg-white py-10 ">
                    <div class="container ">
                        <div class="row text-center">
                            <div class="col-lg-4 mb-5 mb-lg-0">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i data-feather="dollar-sign"></i></div>
                                <h3>Ganas como:</h3>
                                <p class="mb-0">Usuario, Conductor y Promotor de Marca.</p>
                            </div>
                            <div class="col-lg-4 mb-5 mb-lg-0">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i data-feather="users"></i></div>
                                <h3>Usuarios</h3>
                                <p class="mb-0">Todos ingresan gratis, además compartimos nuestras ganancias por recomendarnos.</p>
                            </div>
                            <div class="col-lg-4">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i data-feather="user"></i></div>
                                <h3>¡Como Promotor ganas más!</h3>
                                <p class="mb-0">Ganas dinero y viajas por todo el Perú</p>
                            </div>

                        </div>
                    </div>
                </section>

                <section class="bg-light py-10 informacion">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center">
                                    <div class="btn-primary btn rounded-pill px-4 ml-lg-4" style="border: 2px solid black;">¿Necesitas un Taxi?</div>
                                    <br><br>
                                    <h2 class="mb-5">Conoce algunos de los beneficios de usar nuestro aplicativo WIN</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up">
                                <a class="card text-center text-decoration-none h-100 lift" href="#!">
                                    <div class="card-body py-5">
                                        <div class="icon-stack icon-stack-lg bg-green-soft text-green mb-4"><img style="width: 100%;  height: auto;" src="images/FuncionalidadesApp/SolicitarViaje.png"></img></div>
                                        <h5>Solicitar viajes fácilmente</h5>
                                        <p class="card-text small">Todos los usuarios pueden solicitar viajes inmediatos en pocos pasos</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="100">
                                <a class="card text-center text-decoration-none h-100 lift" href="#!">
                                    <div class="card-body py-5">
                                        <div class="icon-stack icon-stack-lg bg-red-soft text-red mb-4"><img style="width: 100%;  height: auto; background-color:white;" src="images/FuncionalidadesApp/BotonSos.png"></img></div>
                                        <h5>Botón SOS</h5>
                                        <p class="card-text small">Botón integrado en la app para que nuestros usuarios puedan reportar una alerta durante una situación de emergencia.</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="150">
                                <a class="card text-center text-decoration-none h-100 lift" href="#!">
                                    <div class="card-body py-5">
                                        <div class="icon-stack icon-stack-lg bg-yellow-soft text-yellow mb-4"><img style="width: 100%;  height: auto; background-color:white;" src="images/FuncionalidadesApp/AgendarViaje.png"></img></div>
                                        <h5>Agendar un viaje</h5>
                                        <p class="card-text small">Nuestros usuarios pueden agendar un viaje para una fecha próxima.</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0" data-aos="fade-up">
                                <a class="card text-center text-decoration-none h-100 lift" href="#!">
                                    <div class="card-body py-5">
                                        <div class="icon-stack icon-stack-lg bg-purple-soft text-purple mb-4"><img style="width: 100%;  height: auto; background-color:white;" src="images/FuncionalidadesApp/EstimacionTarifa.png"></img></div>
                                        <h5>Estimaciones de tarifas</h5>
                                        <p class="card-text small">Cálculos dinámicos de tarifas por adelantado basados en los datos proporcionados como punto de partida y punto de destino.</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                                <a class="card text-center text-decoration-none h-100 lift" href="#!">
                                    <div class="card-body py-5">
                                        <div class="icon-stack icon-stack-lg bg-blue-soft text-blue mb-4"><img style="width: 100%;  height: auto; background-color:white;" src="images/FuncionalidadesApp/SeguimientoConductor.png"></img></div>
                                        <h5>Seguimiento de conductores</h5>
                                        <p class="card-text small">Nuestros usuarios pueden ver en tiempo real al conductor llegando.</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
                                <a class="card text-center text-decoration-none h-100 lift" href="#!">
                                    <div class="card-body py-5">
                                        <div class="icon-stack icon-stack-lg bg-orange-soft text-orange mb-4"><img style="width: 100%;  height: auto; background-color:white;" src="images/FuncionalidadesApp/SistemaReferidos.png"></img></div>
                                        <h5>Sistema de Referidos</h5>
                                        <p class="card-text small">Cada usuario cuenta con un código de referido único para compartir mediante un enlace con familiares y amigos para obtener créditos y beneficios.</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bg-white py-10">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <h4>¡Obtén la aplicación ahora!</h4>
                                <p class="lead mb-5 mb-lg-0">¿Listo para empezar? ¡Descarga la aplicación ahora!</p>
                            </div>
                            <div class="col-lg-6 text-lg-right">
                                <a class="mr-3" href="https://apps.apple.com/pe/app/win-rideshare/id1458838759"><img src="{{ asset('sb-ui-kit-pro/dist/assets/img/app-store-badge.svg')  }}" style="height: 3rem;" /></a><a href="https://play.google.com/store/apps/details?id=com.winrideshare.passenger"><img src="{{ asset('sb-ui-kit-pro/dist/assets/img/google-play-badge.svg')  }}" style="height: 3rem;" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-waves text-dark">
                        <svg class="wave" style="pointer-events: none" fill="currentColor" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 75">
                            <defs>
                                <style>
                                    .a {
                                        fill: none;
                                    }

                                    .b {
                                        clip-path: url(#a);
                                    }

                                    .d {
                                        opacity: 0.5;
                                        isolation: isolate;
                                    }
                                </style>
                                <clippath id="a">
                                    <rect class="a" width="1920" height="75"></rect>
                                </clippath>
                            </defs>
                            <title>wave</title>
                            <g class="b">
                                <path class="c" d="M1963,327H-105V65A2647.49,2647.49,0,0,1,431,19c217.7,3.5,239.6,30.8,470,36,297.3,6.7,367.5-36.2,642-28a2511.41,2511.41,0,0,1,420,48"></path>
                            </g>
                            <g class="b">
                                <path class="d" d="M-127,404H1963V44c-140.1-28-343.3-46.7-566,22-75.5,23.3-118.5,45.9-162,64-48.6,20.2-404.7,128-784,0C355.2,97.7,341.6,78.3,235,50,86.6,10.6-41.8,6.9-127,10"></path>
                            </g>
                            <g class="b">
                                <path class="d" d="M1979,462-155,446V106C251.8,20.2,576.6,15.9,805,30c167.4,10.3,322.3,32.9,680,56,207,13.4,378,20.3,494,24"></path>
                            </g>
                            <g class="b">
                                <path class="d" d="M1998,484H-243V100c445.8,26.8,794.2-4.1,1035-39,141-20.4,231.1-40.1,378-45,349.6-11.6,636.7,73.8,828,150"></path>
                            </g>
                        </svg>
                    </div>
                </section>
            </main>
        </div>
        <div id="layoutDefault_footer">
            <footer class="footer pt-10 pb-5 mt-auto bg-dark footer-dark ">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="footer-brand">Win Rideshare</div>
                            <div class="mb-3"></div>
                            <div class="icon-list-social mb-5">
                                <a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-instagram"></i></a><a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-facebook"></i></a><a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-github"></i></a><a class="icon-list-social-link" href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Sistemas</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="https://winescompartir.com/">Página Principal</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Oficina Virtual</a></li>
                                        <li class="mb-2">
                                            <div class="nav accordion" id="accordionSidenav">
                                                <a class=" collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                                                    Sistema de Validación de Conductor
                                                    <div class="sidenav-collapse-arrow" style="display: inline-block;"><i class="fa fa-angle-down"></i></div>
                                                </a>
                                                <div class="collapse" id="collapseDashboards" data-parent="#accordionSidenav">
                                                    <div class="accordion" id="accordionSidenavPages">
                                                        <div><a href="https://bo.conductores.wintecnologies.com/" target="_blank">SVC Bolivia</a></div>
                                                        <div><a href="https://co.conductores.wintecnologies.com/" target="_blank">SVC Colombia</a></div>
                                                        <div><a href="https://ec.conductores.wintecnologies.com/" target="_blank">SVC Ecuador</a></div>
                                                        <div><a href="https://mx.conductores.wintecnologies.com/" target="_blank">SVC México</a></div>
                                                        <div><a href="https://conductores.wintecnologies.com/" target="_blank">SVC Perú</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Países</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="https://bo.winrides.com/" target="_blank">Bolivia</a></li>
                                        <li class="mb-2"><a href="https://co.winrides.com/" target="_blank">Colombia</a></li>
                                        <li class="mb-2"><a href="https://ec.winrides.com/" target="_blank">Ecuador</a></li>
                                        <li class="mb-2"><a href="https://mx.winrides.com/" target="_blank">México</a></li>
                                        <li><a href="https://pe.winrides.com/">Perú</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Soporte</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="https://help.wintecnologies.com/" target="_blank">Centro de ayuda</a></li>
                                        <li class="mb-2"><a href="https://comunidad.winrides.com/" target="_blank">Comunidad</a></li>
                                        <li><a href="https://wintecnologies.com/soporte">Ticket de atención</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="text-uppercase-expanded text-xs mb-4">Legal</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="javascript:void(0);">Políticas de privacidad</a></li>
                                        <li class="mb-2"><a href="javascript:void(0);">Terminos y Condiciones</a></li>
                                        <li><a href="javascript:void(0);">Licencias</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-5" />
                    <div class="row align-items-center">
                        <div class="col-md-6 small">Copyright &copy; Win Rideshare {{ date('Y') }}</div>
                        <div class="col-md-6 text-md-right small">
                            <a href="javascript:void(0);">Politica de privacidad</a>
                            &middot;
                            <a href="javascript:void(0);">Terminos &amp; Condiciones</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('sb-ui-kit-pro/dist/js/scripts.js')  }}"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            disable: 'mobile',
            duration: 600,
            once: true
        });
    </script>
</body>

</html>
