@extends('layout.app')
@section('title', 'Estatus Red')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<section class="content-header">
  <h1>
    Estatus Red
  </h1>
</section>
<div class="content">
  @include('adminlte-templates::common.errors')
  <div class="box box-success">
    <div class="box-body">
      <div class="row">
        {!! Form::open(['route' => 'estatus-red.store' , 'id'=>'formCreateStatusRed']) !!}
          @include('admin.status_reds.fields')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/panel/status_reds/create.js')}} "></script>
@endsection
