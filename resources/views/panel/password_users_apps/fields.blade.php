<!-- Id Users App Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('id_users_app', 'Usuarios:') !!}
  {!! Form::select('id_users_app', $tpUsersAps, null, ['id'=>'id_users_app', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Password Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('password', 'Contrase&ntilde;a:') !!}
  {!! Form::text('password', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Password Repeat Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('password_repeat', 'Repetir Contrase&ntilde;a:') !!}
  {!! Form::text('password_repeat', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Status Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('status', 'Estatus:') !!}
  {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Submit Field -->
<div class="form-group col-sm-12"><div class="input-group col-xs-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-registro btn-default']) !!}
  <a href="{!! route('clave-usuarios-app.index') !!}" class="btn btn-registro btn-default">Cancelar</a>
</div><div><span class="help-block" id="error"></span></div></div>
