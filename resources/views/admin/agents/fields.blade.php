
<!-- Informacion personal -->
<div class="form-row">
  <div class="col-xs-12 col-sm-12">
  {!! Form::label('usuario', 'Usuario:') !!}<code>*</code>
  <div class="input-group mb-2">
    {!! Form::text('username', $username, ['id'=> 'username', 'class' => 'form-control']) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>
</div>

<div class="form-row">
  <div class="col-xs-12 col-sm-12">
  <label for="middle_name">Contraseña:</label><code>*</code>
  <div class="input-group mb-2">
    {!! Form::password('password', ['class' => 'form-control', 'id'=> 'password']) !!}
  </div>
  {!! $errors->first('password', '<span class="help-block"><strong>:message</strong></span>' ) !!}
</div>
</div>

<div class="form-row">
  <div class="col-xs-12 col-sm-12">
  <label for="middle_name">Repetir Contraseña:</label><code>*</code>
  <div class="input-group mb-2">
    {!! Form::password('password_confirm', ['id'=> 'password_confirm', 'class' => 'form-control']) !!}
  </div>
  {!! $errors->first('password_confirm', '<span class="help-block"><strong>:message</strong></span>' ) !!}
</div>
</div>

<div class="form-row">
  <div class="col-xs-12 col-sm-12">
  {!! Form::label('first_name', 'Nombre:') !!}<code>*</code>
  <div class="input-group mb-2">
    {!! Form::text('first_name', null, ['id'=> 'first_name', 'class' => 'form-control']) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>
</div>


<div class="form-row">
  <div class="col-xs-12 col-sm-12">
  <label for="last_name">Apellidos:</label><code>*</code>
  <div class="input-group mb-2">
    {!! Form::text('last_name', null, ['id'=> 'last_name', 'class' => 'form-control']) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>
</div>

<div class="form-row">
  <div class="col-xs-12 col-sm-12">
  <label for="id_tp_sexo">Sexo:</label><code>*</code>
  <div class="input-group mb-2">
    {!! Form::select('id_tp_sexo', $sexo, null, ['id'=>'id_tp_sexo', 'placeholder' => 'Seleccione un sexo...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>
</div>

<div class="form-row">
  <div class="col-xs-12 col-sm-12">
  <label for="birth">Fecha de nacimiento:</label><code>*</code>
  <div class="input-group mb-2">
    {!! Form::date('birth', ($usersApp)? date('Y-m-d', strtotime($usersApp->birth)) : '', ['class' => 'form-control','id'=>'birth']) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>
</div>

<div class="form-row">
  <div class="col-xs-12 col-sm-12">
  {!! Form::label('email', 'E-mail:') !!}<code>*</code>
  <div class="input-group mb-2">
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>
</div>


<!-- Telefono Field -->
<div class="form-row">
  <div class="col-xs-12 col-sm-12">
  <label for="phone">Tel&eacute;fono:</label><code>*</code>
  <div class="input-group mb-2">
    {!! Form::text('phone', null, ['id'=> 'phone', 'class' => 'form-control']) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>
</div>

<!-- Id Country Field -->
<!-- Informacion direcciones -->
<div class="form-row">
  <div class="col-xs-12 col-sm-12">
  <label for="id_country">Pa&iacute;s:</label><code>*</code>
  <div class="input-group mb-2">
    {!! Form::select('id_country', $pais, null, ['id'=>'id_country', 'placeholder' => 'Seleccione un país...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>
</div>
<div class="form-row">
  <div class="col-xs-12 col-sm-12">
  <label for="id_departament">Departamento:</label><code>*</code>
  <div class="input-group mb-2">
    {!! Form::select('id_departament', $departamentos, null, ['id'=>'id_departament', 'placeholder' => 'Seleccione un departamento...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>
</div>
<div class="form-row">
  <div class="col-xs-12 col-sm-12">
  <label for="id_city">Ciudad:</label><code>*</code>
  <div class="input-group mb-2">
    {!! Form::select('id_city', $ciudad, null, ['id'=>'id_city', 'placeholder' => 'Seleccione una cíudad...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>
</div>
<div class="form-row">
  <div class="col-xs-12 col-sm-12">
  <label for="id_distrito">Distrito:</label>
  <div class="input-group mb-2">
    {!! Form::select('id_distrito', $distrito, null, ['id'=>'id_distrito', 'placeholder' => 'Seleccione un distrito...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>
</div>
<div class="form-row">
  <div class="col-xs-12 col-sm-12">
  <label for="address">Dirección:</label>
  <div class="input-group mb-2">
    {!! Form::textarea('address', null, ['id'=> 'address', 'class' => 'form-control', 'rows'=>'2']) !!}
  </div>
  <div><span class="help-block" id="error"></span></div>
</div>
</div>
