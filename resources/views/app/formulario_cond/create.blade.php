@extends('layouts.app')
@section('title', 'Formulario Conductores')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<!-- <link rel="stylesheet" href="{{ asset('css/inputs.css')}}"> -->
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<div class="panel panel-primary general">

  <div class="panel-body">
    <!-- agregar luego el form -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="panel panel-success">
      <div align="center" class="panel-heading">DATOS PERSONALES</div>
    </div>

    <div class="row busqueda" >

      <div class="col-sm-6">
        <div class="form-group">
          <label for="id_pay" class="control-label">DNI</label>
          <div class="">
            <div class=""></div>
            {!! Form::text('last_name', null,['id'=>'last_name', 'class'=>'form-control', 'style'=>'width: 100%',  ] ) !!}
          </div>
          <div><span class="help-block" id="error"></span></div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="form-group">
          <label for="id_pay" class="control-label">LICENCIA</label>
          <div class="">
            <div class=""></div>
            {!! Form::text('last_name', null,['id'=>'last_name', 'class'=>'form-control', 'style'=>'width: 100%',  ] ) !!}
          </div>
          <div><span class="help-block" id="error"></span></div>
        </div>
      </div>

      <div class="col-xs-12" align="center">
        <div class="form-group">
          {!! Form::button('Buscar',  ['id'=>'searchButton', 'class' => 'btn btn-registro btn-default']) !!}
        </div>
      </div>

    </div>

    <div class="row datos">

      <div class="table-responsive">
        <table class="stripe row-border order-column" style="width:100%">
          <tr>
            <td rowspan="2" align="center">
              <label id="name_sponsor_data_nombres"></label> ARIANA,
              <label id="name_sponsor_data_apellidos"></label> VALENZUELA
              <br>
              <label id="name_sponsor_data_nombres"></label> DNI:
              <label id="name_sponsor_data_apellidos"></label> 19185303
              <br>
              <label id="name_sponsor_data_nombres"></label> LICENCIA:
              <label id="name_sponsor_data_apellidos"></label> 1434000432
            </td>

            <td align="left"  style="padding-left: 10px;">
              <a id="confirm_sponsor"  ><i class="fa fa-square-o"> </i> <label id="confirm_case"></label></a>
            </td>
          </tr>
          <tr>
            <td align="left"  style="padding-left: 10px;">
              <a id="search_again"><i class="fa fa-repeat"> Buscar de nuevo</i></a>
            </td>
          </tr>
        </table>
      </div>

    </div>

    <div class="panel panel-success">
      <div align="center" class="panel-heading">DOCUMENTOS PERSONALES</div>
    </div>

    <div class="col-sm-6">
      <div class="card" align="center">
        <img class="card-img-top" id="cedulaa_img" src="{{ asset('img/noimage.jpeg') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">DNI (LADO A)</label><code>(*)</code>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn-registro btn btn-primary btn-file radioD">
                  SUBIR<input type='file' class="form-control" id="cedulaa" name="cedulaa" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="cedulaa_cap" data-new=true readonly="readonly" name="cedulaaa_cap" type="text" value="">
            </div>
            <div><span class="help-block" id="error"></span></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="card" align="center">
        <img class="card-img-top" id="cedulab_img" src="{{ asset('img/noimage.jpeg') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">DNI (LADO B)</label><code>(*)</code>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn-registro btn btn-primary btn-file radioD">
                  SUBIR<input type='file' class="form-control" id="cedulab" name="cedulab" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="cedulab_cap" data-new=true  readonly="readonly" name="cedulaab_cap" type="text" value="">
            </div>
            <div><span class="help-block" id="error"></span></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="card" align="center">
        <img class="card-img-top" id="licenciaa_img" src="{{ asset('img/noimage.jpeg') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">LICENCIA DE CONDUCIR (LADO A)</label><code>(*)</code>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn-registro btn btn-primary btn-file radioD">
                  SUBIR<input type='file' class="form-control" id="licenciaa" name="licenciaa" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="licenciaa_cap" data-new=true  readonly="readonly" name="licenciaa_cap" type="text" value="">
            </div>
            <div><span class="help-block" id="error"></span></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="card" align="center">
        <img class="card-img-top" id="licenciab_img" src="{{ asset('img/noimage.jpeg') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">LICENCIA DE CONDUCIR (LADO B)</label><code>(*)</code>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn-registro btn btn-primary btn-file radioD">
                  SUBIR<input type='file' class="form-control" id="licenciab" name="licenciab" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="licenciab_cap" data-new=true readonly="readonly" name="licenciab_cap" type="text" value="">
            </div>
            <div><span class="help-block" id="error"></span></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="card" align="center">
        <img class="card-img-top" id="licenciab_img" src="{{ asset('img/noimage.jpeg') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">TARJETA DE PROPIEDAD</label><code>(*)</code>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn-registro btn btn-primary btn-file radioD">
                  SUBIR<input type='file' class="form-control" id="licenciab" name="licenciab" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="licenciab_cap" data-new=true readonly="readonly" name="licenciab_cap" type="text" value="">
            </div>
            <div><span class="help-block" id="error"></span></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="card" align="center">
        <img class="card-img-top" id="tarjeton_img" src="{{ asset('img/noimage.jpeg') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">SOAT</label><code>(*)</code>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn-registro btn btn-primary btn-file radioD">
                  SUBIR<input type='file' class="form-control" id="tarjeton" name="tarjeton" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="tarjeton_cap" data-new=true  readonly="readonly" name="tarjeton_cap" type="text" value="">
            </div>
            <div><span class="help-block" id="error"></span></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="card" align="center">
        <img class="card-img-top" id="tarjeton_img" src="{{ asset('img/noimage.jpeg') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">TARJETA DE CIRCULACION</label><code>(*)</code>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn-registro btn btn-primary btn-file radioD">
                  SUBIR<input type='file' class="form-control" id="tarjeton" name="tarjeton" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="tarjeton_cap" data-new=true  readonly="readonly" name="tarjeton_cap" type="text" value="">
            </div>
            <div><span class="help-block" id="error"></span></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="card" align="center">
        <img class="card-img-top" id="tarjeton_img" src="{{ asset('img/noimage.jpeg') }}" style="width: 80px;height: 75px">
        <div class="card-body">
          <label for="text">CARNET DEL CONDUCTOR EMITIDO POR MUNICIPALIDAD (OPCIONAL)</label>
          <div class="form-group">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn-registro btn btn-primary btn-file radioD">
                  SUBIR<input type='file' class="form-control" id="tarjeton" name="tarjeton" accept="image/x-png,image/gif,image/jpeg">
                </span>
              </label>
              <input class="form-control" id="tarjeton_cap" data-new=true  readonly="readonly" name="tarjeton_cap" type="text" value="">
            </div>
            <div><span class="help-block" id="error"></span></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-12">
      <div class="form-group" align="center">
        {!! Form::button('Guardar', array('id'=>'pasob',   'class' => 'btn-registro btn btn-default generalbutton', 'type' => 'button')) !!}
    </div>

  </div>

  {!! Form::close() !!}

</div>

  <div class="box-footer">
    <div class="form-group">
      <div class="col-xs-12"><label for="Datos">Nota: <code>Los campos con (*) son obligatorios</code></label></div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/panel/accesos_ips/create.js')}} "></script>
@endsection
