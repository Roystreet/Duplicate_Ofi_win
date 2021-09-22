<!-- Nombres Field -->
<div class="form-group col-sm-6">
  {!! Form::label('nombres', 'Nombres:') !!}
  <p>{!! $usersApp->nombres !!}</p>
</div>

<!-- Apellidos Field -->
<div class="form-group col-sm-6">
  {!! Form::label('apellidos', 'Apellidos:') !!}
  <p>{!! $usersApp->apellidos !!}</p>
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
  {!! Form::label('email', 'E-mail:') !!}
  <p>{!! $usersApp->email !!}</p>
</div>

<!-- Id Tp Sexo Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_tp_sexo', 'Sexo:') !!}
  <p>{!! $usersApp->getSexo->descripcion !!}</p>
</div>

<!-- Telefono Field -->
<div class="form-group col-sm-6">
  {!! Form::label('phone', 'Tel&eacute;fono:') !!}
  <p>{!! $usersApp->phone !!}</p>
</div>

<!-- Id Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_country', 'Pa&iacute;s:') !!}
  <p>{!! $usersApp->getCountry->country !!}</p>
</div>

<!-- Id Departament Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_departament', 'Departamento:') !!}
  <p>{!! $usersApp->getDepartament->departament !!}</p>
</div>

<!-- Id City Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_city', 'C&iacute;udad:') !!}
  <p>{!! $usersApp->getCity->city !!}</p>
</div>

<!-- Id Distrito Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_distrito', 'Distrito:') !!}
  <p>{!! $usersApp->getDistrito->distrito !!}</p>
</div>

<!-- F Nacimiento Field -->
<div class="form-group col-sm-6">
  {!! Form::label('f_nacimiento', 'Fecha\Nacimiento:') !!}
  <p>{!! date('d-m-Y', strtotime($usersApp->f_nacimiento)); !!}</p>
</div>

<!-- Id Status Users App Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_status_users_app', 'Estatus Usuarios:') !!}
  <p>{!! $usersApp->getStatusUsersApp->status_users_app !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{!! $usersApp->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{!! $usersApp->updated_at !!}</p>
</div>
