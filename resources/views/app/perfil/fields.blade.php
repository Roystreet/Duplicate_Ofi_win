
<div class="p-4">
  {!! Form::model($usersApp, ['route' => ['profile-save'], 'method' => 'post', 'id' => 'formPerfil']) !!}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {!! Form::hidden('id_users_app', $usersApp->id, ['id'=>'id_users_app', 'class' => 'form-control']) !!}
  <div class="form-row">

    <div class="form-group col-sm-12">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
    </div>

    <!-- Informacion personal -->
    <div class="form-group col-sm-4">
      {!! Form::label('first_name', 'Primer Nombre:') !!}<code>*</code>
      <div class="input-group col-xs-12">
        {!! Form::text('first_name', null, ['id'=> 'first_name', 'class' => 'form-control']) !!}
      </div>
      <div><span class="help-block" id="error"></span></div>
    </div>

    <div class="form-group col-sm-4">
      <label for="middle_name">Segundo Nombre:</label>
      <div class="input-group col-xs-12">
        {!! Form::text('middle_name', null, ['id'=> 'middle_name', 'class' => 'form-control']) !!}
      </div>
      <div><span class="help-block" id="error"></span></div>
    </div>

    <div class="form-group col-sm-4">
      <label for="last_name">Apellidos:</label><code>*</code>
      <div class="input-group col-xs-12">
        {!! Form::text('last_name', null, ['id'=> 'last_name', 'class' => 'form-control']) !!}
      </div>
      <div><span class="help-block" id="error"></span></div>
    </div>

    <div class="form-group col-sm-4">
      <label for="id_tp_sexo">Sexo:</label><code>*</code>
      <div class="input-group col-xs-12">
        {!! Form::select('id_tp_sexo', $usersApp->sexo_select, $usersApp->id_tp_sexo,['id'=>'id_tp_sexo', 'placeholder' => 'Seleccione...', 'class'=>'form-control select2', 'style'=>'width: 100%', ] ) !!}
      </div>
      <div><span class="help-block" id="error"></span></div>
    </div>

    <div class="form-group col-sm-4">
      <label for="birth">Fecha de nacimiento:</label><code>*</code>
      <div class="input-group col-xs-12">
        {!! Form::date('birth', $usersApp->birth, ['class' => 'form-control','id'=>'birth']) !!}
      </div>
      <div><span class="help-block" id="error"></span></div>
    </div>

    <div class="form-group col-sm-4">
      <label for="phone">Tel&eacute;fono:</label><code>*</code>
      <div class="input-group col-xs-12">
        {!! Form::text('phone', null, ['id'=> 'phone', 'class' => 'form-control']) !!}
      </div>
      <div><span class="help-block" id="error"></span></div>
    </div>


    <!-- Informacion direcciones -->
    <div class="form-group col-sm-6">
      <label for="id_country">Pa&iacute;s:</label><code>*</code>
      <div class="input-group col-xs-12">
        {!! Form::select('id_country', $usersApp->country_select, $usersApp->id_country, ['id'=>'id_country', 'placeholder' => 'Seleccione un país', 'class'=>'form-control select2', 'style'=>'width: 100%', ] ) !!}
      </div>
      <div><span class="help-block" id="error"></span></div>
    </div>

    <div class="form-group col-sm-6">
      <label for="id_departament">Departamento:</label><code>*</code>
      <div class="input-group col-xs-12">
        {!! Form::select('id_departament', $usersApp->departament_select, ($usersApp)? $usersApp->id_departament : null, ['id'=>'id_departament', 'placeholder' => 'Seleccione un departamento', 'class'=>'form-control select2', 'style'=>'width: 100%', ] ) !!}
      </div>
      <div><span class="help-block" id="error"></span></div>
    </div>

    <div class="form-group col-sm-6">
      <label for="id_city">Ciudad:</label><code>*</code>
      <div class="input-group col-xs-12">
        {!! Form::select('id_city', $usersApp->city_select, ($usersApp)? $usersApp->id_city : null, ['id'=>'id_city', 'placeholder' => 'Seleccione una ciudad', 'class'=>'form-control select2', 'style'=>'width: 100%', ] ) !!}
      </div>
      <div><span class="help-block" id="error"></span></div>
    </div>

    <div class="form-group col-sm-6">
      <label for="id_distrito">Distrito:</label>
      <div class="input-group col-xs-12">
        {!! Form::select('id_distrito', $usersApp->distrito_select, ($usersApp)? $usersApp->id_distrito : null, ['id'=>'id_distrito', 'placeholder' => 'Seleccione un distrito', 'class'=>'form-control select2', 'style'=>'width: 100%', ] ) !!}
      </div>
      <div><span class="help-block" id="error"></span></div>
    </div>

    <div class="form-group col-sm-12">
      <label for="address">Dirección:</label>
      <div class="input-group col-xs-12">
        {!! Form::textarea('address', null, ['id'=> 'address', 'class' => 'form-control', 'rows'=>'2']) !!}
      </div>
      <div><span class="help-block" id="error"></span></div>
    </div>


    <!-- Informacion documentos -->
    <div class="form-group col-sm-6">
      <label for="id_tp_document">Tipo de documento:</label><code>*</code>
      <div class="input-group col-xs-12">
        {!! Form::select('id_tp_document_identies', $usersApp->tp_document_select, $usersApp->id_tp_document_identies,['id'=>'id_tp_document_identies', 'placeholder' => 'Seleccione...', 'class'=>'form-control select2', 'style'=>'width: 100%', ] ) !!}
      </div>
      <div><span class="help-block" id="error"></span></div>
    </div>

    <div class="form-group col-sm-6">
      <label for="nro_document">Numero de documento:</label><code>*</code>
      <div class="input-group col-xs-12">
        {!! Form::text('n_document', null, ['class' => 'form-control']) !!}
      </div>
      <div><span class="help-block" id="error"></span></div>
    </div>
    <br>

    <hr class="sidebar-divider my-0"><br>
  </div>

  <br>
  <hr class="sidebar-divider my-0"><br>

  @if($usersApp->id_status_users_app == 1)
  <div class="form-group col-sm-12" align="center">
    <div class="box-footer">
      <div class="form-group">
        <div class="col-xs-12"><label for="Datos">Nota: <code>Debes completar tu registro en un lapso mínimo de treinta (30) días,<br> de lo contrario tu cuenta será inhabilitada.</code></label></div>
      </div>
    </div>
  </div>
  @endif
  <hr class="sidebar-divider my-0"><br>

  <div class="row">
    <div class="col-sm-4">
    </div>

    <div class="col-sm-4">
      @if($usersApp->id_status_users_app != 1)
      {!! Form::button('Cancelar', ['id'=>'verPerfilButton', 'class' => 'btn btn-registro btn-danger btn-block']) !!}
      @endif
    </div>

    <div class="col-sm-4">
      {!! Form::submit('Guardar', ['id'=>'guardarPerfilButton', 'class' => 'btn btn-registro pull-right btn-primary btn-block']) !!}
    </div>

  </div>
  <br>





  <hr>
  <div class="form-row">

    <div class="form-group col-sm-6">
      <label for="photo_front_document">Documento Frontal:</label><code>*</code>
      <div class="input-group col-xs-12">
        {!! Form::file('photo_front_document', null, ['id'=> 'photo_front_document', 'class' => 'form-control']) !!}
      </div>
      <div><span class="help-block" id="error"></span></div>
    </div>

    <div class="form-group col-sm-6">
      <label for="photo_post_document">Documento Posterior:</label><code>*</code>
      <div class="input-group col-xs-12">
        {!! Form::file('photo_post_document', null, ['id'=> 'photo_post_document', 'class' => 'form-control']) !!}
      </div>
      <div><span class="help-block" id="error"></span></div>
    </div>
  </div>
  <hr class="sidebar-divider my-0"><br>
  <div class="form-group col-sm-12" align="center">
    <div class="box-footer">
      <div class="form-group">
        <div class="col-xs-12"><label for="Datos">Nota: <code>Esta información es para verificar tu cuenta,<br> no es necesaria hasta que tu perfil este verificado por la compañia.</code></label></div>
      </div>
    </div>
  </div>
  <hr class="sidebar-divider my-0"><br>

  <div class="row">
    <div class="col-sm-8">
    </div>

    <div class="col-sm-4">
      {!! Form::submit('Guardar', ['id'=>'saveFile', 'class' => 'btn btn-registro pull-right btn-primary btn-block']) !!}
    </div>

  </div>

  {!! Form::close() !!}
</div>
