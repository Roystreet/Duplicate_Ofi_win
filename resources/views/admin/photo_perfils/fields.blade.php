<!-- Id Users App Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('id_users_app', 'Usuarios:') !!}
  {!! Form::select('id_users_app', $tpUsersAps, null, ['id'=>'id_users_app', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
    <!-- {!! Form::text('id_users_app', null, ['class' => 'form-control']) !!} -->
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Url Photo Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('url_photo', 'Foto:') !!}
  {!! Form::text('url_photo', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>
<!-- Submit Field -->
<div class="form-group col-sm-12"><div class="input-group col-xs-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-registro btn-default']) !!}
  <a href="{{ route('foto-perfil.index') }}" class="btn btn-registro btn-default">Cancelar</a>
</div><div><span class="help-block" id="error"></span></div></div>
