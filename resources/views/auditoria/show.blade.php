@extends('layouts.app')
@section('title', 'Auditoria')
@section('css')
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css" />
<!-- include a theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/default.min.css" />

@endsection
@section('content')
  <section class="content-header">
    <h1>
      Auditoria
    </h1>
  </section>
    <div class="content">
      <div class="box box-success">
        <div class="box-body">
          <div class="row" style="padding-left: 20px">
            @include('auditoria.show_fields')
              <div class="form-group col-sm-12">
                <a href="{!! route('auditoria.index') !!}" class="btn btn-default">Volver</a>
              </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('js')
  <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase.js"></script>
  <script>
    // Initialize Firebase
      var config = {
        apiKey: "AIzaSyDQCZESZB5v0-ReeZYUcXWRbOb2IDaJR_8",
        authDomain: "voucher-img-fb702.firebaseapp.com",
        databaseURL: "https://voucher-img-fb702.firebaseio.com",
        projectId: "voucher-img-fb702",
        storageBucket: "voucher-img-fb702.appspot.com",
        messagingSenderId: "807276908227"
      };

      firebase.initializeApp(config);
      var storage = firebase.storage();
  </script>

<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}">         </script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js">                                         </script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js">                                         </script>
<script src="https://adminlte.io/themes/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js">                           </script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('plugins/jquery/jQuery.print.js') }}">                      </script>
<script src="{{ asset('js/auditoria/index.js')}} ">                               </script>

@endsection
