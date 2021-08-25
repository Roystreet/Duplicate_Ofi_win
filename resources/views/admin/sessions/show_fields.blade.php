<!-- Token Field -->
<div class="form-group col-sm-6">
  {!! Form::label('token', 'Token:') !!}
  <p>{!! $session->token !!}</p>
</div>

<!-- D Inicio Field -->
<div class="form-group col-sm-6">
  {!! Form::label('d_inicio', 'Día\Inicio:') !!}
  <p>{!! date('d-m-Y', strtotime($session->d_inicio)); !!}</p>
</div>

<!-- H Inicio Field -->
<div class="form-group col-sm-6">
  {!! Form::label('h_inicio', 'Hora\Inicio:') !!}
  <p>{!! $session->h_inicio !!}</p>
</div>

<!-- D Fin Field -->
<div class="form-group col-sm-6">
  {!! Form::label('d_fin', 'Día\Fin:') !!}
  <p>{!! date('d-m-Y', strtotime($session->d_fin)); !!}</p>
</div>

<!-- H Fin Field -->
<div class="form-group col-sm-6">
  {!! Form::label('h_fin', 'Hora\Fin:') !!}
  <p>{!! $session->h_fin !!}</p>
</div>

<!-- Id Status Session Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_status_session', 'Estatus Sesión:') !!}
  <p>{!! ($session->id_status_session)? $session->getStatusSession->status_session : '-' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{!! $session->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{!! $session->updated_at !!}</p>
</div>
