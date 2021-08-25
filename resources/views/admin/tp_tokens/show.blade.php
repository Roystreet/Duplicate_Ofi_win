@extends('layout.app')
@section('title', 'Mostrar tipo de token')

@section('css')
@endsection

@section('content')
@include('layout.page-header')

<!-- Container-fluid -->
<div class="container-fluid mt-n10">
  <!-- Card -->
  <div class="card">
    <!-- Card Title -->
    <div class="card-header border-bottom">Mostrar tipo de token</div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="form-row">
        <!-- Descripción del tipo de token -->
        <div class="col-xs-12 col-sm-6">
          <label>Descripci&oacute;n del tipo de token:</label>
          <div class="bg-light border p-3 mb-3">{{ $tpToken->descripcion }}</div>
        </div>
        <!-- Estado del tipo de token -->
        <div class="col-xs-12 col-sm-6">
          <label>Estado del token:</label>
          <div class="bg-light border p-3 mb-3">{{ ($tpToken->status ==1)? 'ACTIVADO' : 'DESACTIVADO' }}</div>
        </div>
      </div>
      <div class="form-row">
        <!-- Creado en -->
        <div class="col-xs-12 col-sm-6">
          <label>Creado en:</label>
          <div class="bg-light border p-3 mb-3">{{ $tpToken->created_at }}</div>
        </div>
        <!-- Modificado en -->
        <div class="col-xs-12 col-sm-6">
          <label>Modificado en:</label>
          <div class="bg-light border p-3 mb-3">{{ $tpToken->updated_at }}</div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 pt-4 pl-1 pr-1 small mx-auto">
        <a href="{!! route('token.index') !!}" class="btn btn-primary btn-block">Atrás</a>
      </div>
    </div><!-- END Card Body -->
  </div><!-- END Card -->
</div><!-- END Container-fluid -->
@endsection
