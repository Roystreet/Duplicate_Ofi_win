@extends('layout.app')
@section('title', 'Sexo')

@section('css')
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<section class="content-header">
  <h1>
    Sexo
  </h1>
</section>
  <div class="content">
    <div class="box box-success">
      <div class="box-body">
        <div class="row" style="padding-left: 20px">
          @include('admin.tp_sexos.show_fields')
          <a href="{!! route('sexos.index') !!}" class="btn btn-default btn-registro">Atrás</a>
        </div>
      </div>
    </div>
  </div>
@endsection
