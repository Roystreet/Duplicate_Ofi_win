<!-- Id Field -->
<!-- <div class="form-group"><div class="form-group col-sm-6">
  {!! Form::label('id', 'Id:') !!}
  <p>{{ $redUsuarios->id }}</p>
</div> -->


<!-- Id Users Sponsor Field -->
<div class="form-group"><div class="form-group col-sm-6">
  {!! Form::label('id_users_sponsor', 'Usuario Sponsor:') !!}
  <p>{{ ($redUsuarios->id_users_sponsor)? $redUsuarios->getUsersSponsor->nombres.' '.$redUsuarios->getUsersSponsor->apellidos : '-' }}</p>
</div>

<!-- Id Users Invitado Field -->
<div class="form-group"><div class="form-group col-sm-6">
  {!! Form::label('id_users_invitado', 'Usuario Invitado:') !!}
  <p>{{ ($redUsuarios->id_users_invitado)? $redUsuarios->getUsersInvitado->nombres.' '.$redUsuarios->getUsersInvitado->apellidos : '-'  }}</p>
</div>

<!-- Codigo Sponsor Field -->
<div class="form-group"><div class="form-group col-sm-6">
  {!! Form::label('codigo_invitado', 'Codigo Invitado:') !!}
  <p>{{ $redUsuarios->codigo_invitado }}</p>
</div>

<!-- Usuario Sponsor Field -->
<div class="form-group"><div class="form-group col-sm-6">
  {!! Form::label('usuario_invitado', 'Usuario:') !!}
  <p>{{ $redUsuarios->usuario_invitado }}</p>
</div>

<!-- Id Status Red Field -->
<div class="form-group"><div class="form-group col-sm-6">
  {!! Form::label('id_status_red', 'Estatus Red:') !!}
  <p>{{ ($redUsuarios->id_status_red)? $redUsuarios->getStatusRed->descripcion : '-' }}</p>
</div>

<!-- Status Field -->
<div class="form-group"><div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{{ ($redUsuarios->status ==1)? 'ACTIVADO' : 'DESACTIVADO' }}</p>
</div>

<!-- Created At Field -->
<div class="form-group"><div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{{ $redUsuarios->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group"><div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{{ $redUsuarios->updated_at }}</p>
</div>
