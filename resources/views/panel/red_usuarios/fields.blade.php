<!-- Id Users Sponsor Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
    {!! Form::label('id_users_sponsor', 'Usuario Sponsor:') !!}
    {!! Form::select('id_users_sponsor', $usersSponsor, null, ['id'=>'id_users_sponsor', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Id Users Invitado Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
    {!! Form::label('id_users_invitado', 'Usuario Invitado:') !!}
    {!! Form::select('id_users_invitado', $usersInvitado, null, ['id'=>'id_users_invitado', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Codigo Sponsor Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
    {!! Form::label('codigo_invitado', 'Codigo Invitado:') !!}
    {!! Form::text('codigo_invitado', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Usuario Sponsor Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
    {!! Form::label('usuario_invitado', 'Usuario:') !!}
    {!! Form::text('usuario_invitado', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Id Status Red Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
    {!! Form::label('id_status_red', 'Estatus Red:') !!}
    {!! Form::select('id_status_red', $statusReds, null, ['id'=>'id_status_red', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Submit Field -->
<div class="form-group col-sm-12"><div class="input-group col-xs-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-registro btn-default']) !!}
    <a href="{{ route('red-usuarios.index') }}" class="btn btn-registro btn-default">Cancelar</a>
</div><div><span class="help-block" id="error"></span></div></div>
