@extends('layout.app')
@section('title', 'Sexo')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<section class="content-header">
  <h1>
    Sexo
  </h1>
</section>
  <div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-success">
      <div class="box-body">
        <div class="row">
          {!! Form::model($tpSexo, ['route' => ['sexos.update', $tpSexo->id], 'method' => 'patch' , 'id'=>'formEditTpSexos']) !!}
            @include('admin.tp_sexos.fields')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/panel/tp_sexo/edit.js')}} "></script>
@endsection
