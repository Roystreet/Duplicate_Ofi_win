
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
    {!! Form::select('id_tp_sexo', $sexo, null, ['id'=>'id_tp_sexo', 'placeholder' => 'Seleccione un sexo...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>

<div class="form-group col-sm-4">
  <label for="birth">Fecha de nacimiento:</label><code>*</code>
  <div class="input-group col-xs-12">
    {!! Form::date('birth', ($usersApp)? date('Y-m-d', strtotime($usersApp->birth)) : '', ['class' => 'form-control','id'=>'birth']) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>

<div class="form-group col-sm-4">
  {!! Form::label('email', 'E-mail:') !!}<code>*</code>
  <div class="input-group col-xs-12">
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>


<!-- Telefono Field -->
<div class="form-group col-sm-4">
  <label for="phone">Tel&eacute;fono:</label><code>*</code>
  <div class="input-group col-xs-12">
    {!! Form::text('phone', null, ['id'=> 'phone', 'class' => 'form-control']) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>


<!-- Id Country Field -->
<!-- Informacion direcciones -->
<div class="form-group col-sm-4">
  <label for="id_country">Pa&iacute;s:</label><code>*</code>
  <div class="input-group col-xs-12">
    {!! Form::select('id_country', $pais, null, ['id'=>'id_country', 'placeholder' => 'Seleccione un país...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>
<div class="form-group col-sm-4">
  <label for="id_departament">Departamento:</label><code>*</code>
  <div class="input-group col-xs-12">
    {!! Form::select('id_departament', $departamentos, null, ['id'=>'id_departament', 'placeholder' => 'Seleccione un departamento...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>
<div class="form-group col-sm-4">
  <label for="id_city">Ciudad:</label><code>*</code>
  <div class="input-group col-xs-12">
    {!! Form::select('id_city', $ciudad, null, ['id'=>'id_city', 'placeholder' => 'Seleccione una cíudad...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>
<div class="form-group col-sm-4">
  <label for="id_distrito">Distrito:</label>
  <div class="input-group col-xs-12">
    {!! Form::select('id_distrito', $distrito, null, ['id'=>'id_distrito', 'placeholder' => 'Seleccione un distrito...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
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
<div class="form-group col-sm-8">
</div>

<!-- Id Status Users App Field -->
<div class="form-group col-sm-4">
  {!! Form::label('id_status_users_app', 'Estatus:') !!}
  <div class="input-group col-xs-12">
  {!! Form::select('id_status_users_app', $estatus_users, null, ['id'=>'status_users_app', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
</div><div><span class="help-block" id="error"></span></div></div>
