<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>@yield('title') - WIN-OFICINA-VIRTUAL</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css')  }}">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="{{ asset('browers/css/bootstrap/bootstrap-toggle.min.css')  }}">
    <!-- <link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"> -->


    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <link rel="stylesheet" href="../../browers/css/libs/font-awesome.min.css"> -->


    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('browers/css/libs/ionicons.min.css')  }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->


    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('browers/css/AdminLTE.min.css')  }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css"> -->

    <link rel="stylesheet" href="{{ asset('browers/css/libs/skins/_all-skins.min.css')  }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css"> -->

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('browers/css/libs/skins/_all.css')  }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css"> -->

    <link rel="stylesheet" href="{{ asset('browers/css/libs/skins/select2.min.css')  }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css"> -->

    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('browers/css/libs/skins/ionicons.min.css')  }}">
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->

    <link rel="stylesheet" href="{{ asset('browers/css/libs/skins/bootstrap-datetimepicker.min.css')  }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css"> -->
    <link rel="stylesheet" href="{{ asset('css/style.css')  }}">
    @yield('css')
  </head>

  <body id="LoginForm">

    <div class="container">
      <h3></h3>
      @yield('content')
    </div>

    <!-- jQuery 3.1.1 -->

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script src="{{ asset('browers/js/libs/jquery.min.js')  }}"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script> -->
    <script src="{{ asset('browers/js/libs/moment.min.js')  }}"></script>

    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="{{ asset('browers/js/bootstrap/bootstrap.min.js')  }}"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> -->
    <script src="{{ asset('browers/js/bootstrap/bootstrap-datetimepicker.min.js')  }}"></script>

    <!-- <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> -->
    <script src="{{ asset('browers/js/bootstrap/bootstrap-toggle.min.js')  }}"></script>

    <!-- AdminLTE App -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script> -->
    <script src="{{ asset('browers/js/libs/adminlte.min.js')  }}"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script> -->
    <script src="{{ asset('browers/js/libs/icheck.min.js')  }}"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script> -->
    <script src="{{ asset('browers/js/libs/select2.min.js')  }}"></script>

    @yield('scripts')
    <script>
    $('div.alert').not('.alert-important').delay(6000).fadeOut(350);
    </script>
  </body>
</html>
