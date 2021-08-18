@extends('layout.app')
@section('title', 'Red Usuarios')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}"> --}}
<style>

.node {
    cursor: pointer;
}
.overlay {
    background-color:rgba(168, 218, 205, 0.763);
}
/* .node circle {
    fill: rgba(65, 70, 215, 0.763);
    stroke: rgba(65, 70, 215, 0.763);
    stroke-width: 1.5px;
} */
.node text {
    font-size:10px;
    font-family:sans-serif;
    /* color: rgb(244, 0, 0); */
}
.link {
    fill: none;
    stroke: rgba(66, 50, 212, 0.194);
    stroke-width: 1.5px;
}
.templink {
    fill: none;
    /* stroke: red; */
    stroke-width: 3px;
}
.ghostCircle.show {
    display:block;
}
.ghostCircle, .activeDrag .ghostCircle {
    display: none;
}

</style>
<link rel="stylesheet" href="{{asset('/css/theme_admin.css')}}"/>
<link rel="stylesheet" href="{{asset('/css/style_ov_admin.css')}}">
@endsection
@section('content')

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <div id="tree-container"  ></div>
  <div id="loader-container" class="loader-container" style=" display:none; color: black; z-index: 10; position: fixed; padding-top: 20%;padding-left: 40%;padding-top: 20%;padding-right: 50%; padding-bottom: 50%; left: 0; top: 0; width: 100%; height: 100%;  background-color: rgb(0,0,0); background-color: rgba(255,255,255,0.4);">
    <div class="loader-container">
      <div class="loader"></div>
      <div style=" padding-top: 20%;padding-left: 33%;padding-top: 43%;padding-right: 50%; padding-bottom: 50%;"><b>Procesando</b></div>
      <div class="loader2"></div>
    </div>
  </div>

@endsection

@section('scripts')
<!-- load the d3.js library -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://d3js.org/d3.v3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js"></script>
<script src="{{ asset('js/app/red_details/view_circular.js') }}"></script>
@endsection
