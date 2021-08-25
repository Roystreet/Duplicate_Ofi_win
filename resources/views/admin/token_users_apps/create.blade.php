@extends('layout.app')
@section('title', 'Agregar token de usuario')

@section('css')
@endsection

@section('content')
@include('layout.page-header')

<!-- Container-fluid -->
<div class="container-fluid mt-n10">
  <!-- Card -->
  <div class="card">
    <!-- Card Title -->
    <div class="card-header border-bottom">Agregar token de usuario</div>
    <!-- Card Body -->
    <div class="card-body">
      <!-- Form de CreateTokenUsersApp -->
      <form id="formCreateTokenUsersApp" method="POST" action="{{ route('token-usuarios-app.store') }}">
          {{ csrf_field() }}<!-- token del form -->
          <!-- SELECT tipo de token -->
          <div class="form-row justify-content-center">
            <div class="col-xs-12 col-sm-6">
              <label for="id_tp_token">Tipo de token de usuario:</label><code>*</code>
              <div class="input-group mb-2">
                <select id='id_tp_token' name="id_tp_token" class="form-control @error('id_tp_token') is-invalid @enderror">
                  <option selected disabled readonly>Seleccione...</option>
                  <!-- Por cada registro de tipo de token... -->
                  @foreach($tpTokens as $tpToken)
                  <option value="{{$tpToken->id}}" {{ ( $tpToken->id == old('id_tp_token')) ? 'selected' : '' }}>{{$tpToken->descripcion}}</option>
                  @endforeach
                </select>
                <!-- Mensaje de error de validación del campo -->
                @error('id_tp_token')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
              </div>
            </div>
          </div>
          <!-- INPUT llave del token -->
          <div class="form-row justify-content-center">
            <div class="col-xs-12 col-sm-6">
              <label for="token_llave">Llave del token de usuario:</label><code>*</code>
              <div class="input-group mb-2">
                <input class="form-control @error('token_llave') is-invalid @enderror" value="{{ old('token_llave') }}" id="token_llave" name="token_llave" type="text"/>
                <!-- Mensaje de error de validación del campo -->
                @error('token_llave')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
              </div>
            </div>
          </div>
          <!-- INPUT código del token -->
          <div class="form-row justify-content-center">
            <div class="col-xs-12 col-sm-6">
              <label for="token_code">C&oacute;digo del token de usuario:</label><code>*</code>
              <div class="input-group mb-2">
                <input class="form-control @error('token_code') is-invalid @enderror" value="{{ old('token_code') }}" id="token_code" name="token_code" type="text"/>
                <!-- Mensaje de error de validación del campo -->
                @error('token_code')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
              </div>
            </div>
          </div>
          <!-- SELECT estado del token -->
          <div class="form-row justify-content-center">
            <div class="col-xs-12 col-sm-6">
              <label for="status">Estado del token:</label><code>*</code>
              <div class="input-group mb-2">
                <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                  <option selected disabled readonly>Seleccione...</option>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
                <!-- Mensaje de error de validación del campo -->
                @error('status')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
              </div>
            </div>
          </div>
          <!-- BTN Guardar token -->
          <div class="col-xs-12 col-sm-6 pt-4 pl-1 pr-1 small mx-auto">
            <a href="{{ route('token-usuarios-app.index') }}" class="btn btn-danger">Cancelar</a>
            <input class="btn btn-primary float-right" type="submit" value="Guardar">
          </div>
      </form><!-- END Form de CreateTokenUsersApp -->
    </div><!-- END Card Body -->
  </div><!-- END Card -->
</div><!-- END Container-fluid -->
@endsection

@section('scripts')
<!-- Llamado del script de esta vista -->
<script src="{{ asset('js/panel/token_users_app/create.js')}} "></script>
@endsection
