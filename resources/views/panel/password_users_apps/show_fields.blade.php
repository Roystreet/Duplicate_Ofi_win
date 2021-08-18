<!-- Id Users App Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_users_app', 'Id Usuarios:') !!}
  <p>{!! ($passwordUsersApp->id_users_app)? $passwordUsersApp->getUsersApp->nombres : '-' !!} {!! ($passwordUsersApp->id_users_app)? $passwordUsersApp->getUsersApp->apellidos : '-' !!}</p>
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
  {!! Form::label('password', 'Contrase&ntilde;a:') !!}
  <p>{!! $passwordUsersApp->password !!}</p>
</div>

<!-- Password Repeat Field -->
<div class="form-group col-sm-6">
  {!! Form::label('password_repeat', 'Repetir Contrase&ntilde;a:') !!}
  <p>{!! $passwordUsersApp->password_repeat !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{!! ($passwordUsersApp->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{!! $passwordUsersApp->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{!! $passwordUsersApp->updated_at !!}</p>
</div>
