@extends('layouts.app')
@section('title', 'Formulario Conductores')

@section('css')
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
<link rel="stylesheet" href="{{ asset('css/detallesred.css') }}">
<link rel="stylesheet" href="{{ asset('browers/css/perfil.css') }}">
<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">

@endsection

<div class="row">


  <div class="col-sm-4">
    <div class="card" align="center">
        <img class="card-img-top" id="cedulaa_img" src="{{ asset('imagenes/noimage.png') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">DNI(LADO A)</label><code>(*)</code>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn btn-primary btn-file radioD">
                SUBIR<input type='file' class="form-control" id="cedulaa" name="cedulaa" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="cedulaa_cap" data-new=true readonly="readonly" name="cedulaaa_cap" type="text" value="">
            </div><div><span class="help-block" id="error"></span></div>
          </div>
        </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card" align="center">
        <img class="card-img-top" id="cedulab_img" src="{{ asset('imagenes/noimage.png') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">DNI(LADO B)</label><code>(*)</code>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn btn-primary btn-file radioD">
                  SUBIR<input type='file' class="form-control" id="cedulab" name="cedulab" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="cedulab_cap" data-new=true  readonly="readonly" name="cedulaab_cap" type="text" value="">
            </div><div><span class="help-block" id="error"></span></div>
          </div>
        </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card" align="center">
        <img class="card-img-top" id="licenciaa_img" src="{{ asset('imagenes/noimage.png') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">LICENCIA DE CONDUCIR(LADO A)</label><code>(*)</code>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn btn-primary btn-file radioD">
                SUBIR<input type='file' class="form-control" id="licenciaa" name="licenciaa" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="licenciaa_cap" data-new=true  readonly="readonly" name="licenciaa_cap" type="text" value="">
            </div><div><span class="help-block" id="error"></span></div>
          </div>
        </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card" align="center">
        <img class="card-img-top" id="licenciab_img" src="{{ asset('imagenes/noimage.png') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">LICENCIA DE CONDUCIR(LADO B)</label><code>(*)</code>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn btn-primary btn-file radioD">
                SUBIR<input type='file' class="form-control" id="licenciab" name="licenciab" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="licenciab_cap" data-new=true readonly="readonly" name="licenciab_cap" type="text" value="">
            </div><div><span class="help-block" id="error"></span></div>
          </div>
        </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card" align="center">
        <img class="card-img-top" id="licenciab_img" src="{{ asset('imagenes/noimage.png') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">TARJETA DE PROPIEDAD</label><code>(*)</code>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn btn-primary btn-file radioD">
                SUBIR<input type='file' class="form-control" id="licenciab" name="licenciab" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="licenciab_cap" data-new=true readonly="readonly" name="licenciab_cap" type="text" value="">
            </div><div><span class="help-block" id="error"></span></div>
          </div>
        </div>
    </div>
  </div>


  <div class="col-sm-4">
    <div class="card" align="center">
        <img class="card-img-top" id="tarjeton_img" src="{{ asset('imagenes/noimage.png') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">SOAT</label><code>(*)</code>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn btn-primary btn-file radioD">
                SUBIR<input type='file' class="form-control" id="tarjeton" name="tarjeton" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="tarjeton_cap" data-new=true  readonly="readonly" name="tarjeton_cap" type="text" value="">
            </div><div><span class="help-block" id="error"></span></div>
          </div>
        </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card" align="center">
        <img class="card-img-top" id="tarjeton_img" src="{{ asset('imagenes/noimage.png') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">TARJETA DE CIRCULACION</label><code>(*)</code>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn btn-primary btn-file radioD">
                SUBIR<input type='file' class="form-control" id="tarjeton" name="tarjeton" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="tarjeton_cap" data-new=true  readonly="readonly" name="tarjeton_cap" type="text" value="">
            </div><div><span class="help-block" id="error"></span></div>
          </div>
        </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card" align="center">
        <img class="card-img-top" id="tarjeton_img" src="{{ asset('imagenes/noimage.png') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">CARNET DEL CONDUCTOR EMITIDO POR MUNICIPALIDAD(OPCIONAL)</label><code>(*)</code>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn btn-primary btn-file radioD">
                SUBIR<input type='file' class="form-control" id="tarjeton" name="tarjeton" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="tarjeton_cap" data-new=true  readonly="readonly" name="tarjeton_cap" type="text" value="">
            </div><div><span class="help-block" id="error"></span></div>
          </div>
        </div>
    </div>
  </div>

  <div class="col-sm-12">
    <div class="form-group">
      {!! Form::button('Siguiente y Guardar', array('id'=>'pasob',   'class' => 'btn btn-default generalbutton', 'type' => 'button')) !!}
      {!! Form::button('Volver',    array('id'=>'volvera', 'class' => 'btn btn-default pull-right', 'type' => 'button')) !!}
    </div>
  </div>
</div>

@section('content')


@endsection

@section('scripts')
<script src="{{ asset('plugins/DataTable/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/DataTable/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('alertify/js/alertify.min.js') }}"></script>

<script src="{{ asset('js/app/formulario_cond/validacioncond.js')}} "></script>

<script src="{{ asset('js/app/formulario_cond/perfil.js')}} "></script>
@endif
@endsection
