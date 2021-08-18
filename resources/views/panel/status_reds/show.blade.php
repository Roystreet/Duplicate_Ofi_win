@extends('layouts.app')
@section('title', 'Estatus Red')

@section('css')
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<section class="content-header">
  <h1>
    Estatus Red
  </h1>
</section>
<div class="content">
  <div class="box box-success">
    <div class="box-body">
      <div class="row" style="padding-left: 20px">
        @include('panel.status_reds.show_fields')
        <!-- <a href="{{ route('estatus-red.index') }}" class="btn btn-registro btn-default">Atrás</a> -->
        <a href="{{ route('estatus') }}" class="btn btn-registro btn-default">Atrás</a>

      </div>
    </div>
  </div>
</div>
@endsection
