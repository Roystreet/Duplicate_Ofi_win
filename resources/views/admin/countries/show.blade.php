@extends('layout.app')
@section('title', 'País')

@section('css')
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<section class="content-header">
  <h1>
    Pa&iacute;s
  </h1>
</section>
  <div class="content">
    <div class="box box-success">
      <div class="box-body">
        <div class="row" style="padding-left: 20px">
          @include('admin.countries.show_fields')
          <a href="{!! route('pais.index') !!}" class="btn btn-registro btn-default">Atrás</a>
        </div>
      </div>
    </div>
  </div>
@endsection
