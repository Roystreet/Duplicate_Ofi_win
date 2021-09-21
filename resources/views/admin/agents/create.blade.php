@extends('layout.app')
@section('title', 'Listado')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<!-- <section class="content-header">
  <h1>
    Usuarios
  </h1>
</section>
  <div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-success">
      <div class="box-body">

      </div>
    </div>
  </div> -->
  <div class="page-header pb-8 page-header-dark">
    <div class="container-fluid">
        <div class="page-header-content">
        </div>
    </div>
  </div>
  <div class="container-fluid mt-n10">
    @include('adminlte-templates::common.errors')
    <div class="offset-lg-2 col-lg-6">
    <h6 class="small text-muted font-weight-500 card-header">
      Agentes
    </h6>
    <div class="card rounded mb-4">

      <div class="p-4 border-bottom">
        {!! Form::open(['route' => 'agentes.store' , 'id'=>'formCreateAgents']) !!}
        @include('admin.agents.fields')
        {!! Form::submit('Guardar', ['class' => 'btn btn-success btn-default']) !!}
        {!! Form::close() !!}
        <a href="{!!  route('agentes.index') !!}" class="btn btn-danger btn-default float-right">Cancelar</a>
      </div>
     </div>
     </div>
  </div>
@endsection


@section('scripts')
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/panel/agents/create.js')}} "></script>
@endsection
