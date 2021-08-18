@extends('layout.app')
@section('title', 'Mi Perfil')

@section('css')
<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
@endsection

@section('content')

@include('app.page-header')

<div class="container-fluid mt-n10">
  <!-- Mensaje de carga -->
  <div class="waiting_ov"></div>
  <div class="card">
    <div class="card-header border-bottom">Informaci&oacute;n Detallada</div>
    <div class="card-body">
      <div class="row box box-success">
        <div class="col-md-12">
          @include('flash::message')
        </div>
      </div>
      <div class="row" style="padding:0">
        <div class="col-md-3" style="padding:0.1rem">
          @include('app.perfil.red_simple')
        </div>
        <div class="col-md-9" style="padding:0.1rem">
          @if ($usersApp->id_status_users_app == 1)
            @include('app.perfil.fields')
          @else
            @include('app.perfil.show_details')
          @endif
        </div>
      </div>
    </div>
  </div>


</div>
@endsection

@section('scripts')

<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/app/perfil/index.js')}} "></script>
<script src="{{ asset('alertify/js/alertify.min.js') }}"></script>
@endsection
