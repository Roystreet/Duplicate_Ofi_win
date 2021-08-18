@extends('layouts.app')
@section('title', 'Auditoria')

@section('content')
  <section class="content-header">
    <h1>
      Auditorias
    </h1>
  </section>
    <div class="content">
      <div class="box box-success">
        <div class="box-body">
          <div class="row">
            {!! Form::open(['route' => 'auditoria.store',  'method'=> 'POST', 'enctype'=> 'multipart/form-data']) !!}
              @include('auditoria.fields')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
@endsection
