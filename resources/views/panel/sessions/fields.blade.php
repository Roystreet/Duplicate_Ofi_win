<!-- Token Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('token', 'Token:') !!}
  {!! Form::text('token', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- D Inicio Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('d_inicio', 'Día\Inicio:') !!}
  {!! Form::date('d_inicio', ($session)? date('Y-m-d', strtotime($session->d_inicio)) : '', ['class' => 'form-control','id'=>'d_inicio']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- H Inicio Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('h_inicio', 'Hora\Inicio:') !!}
  {!! Form::time('h_inicio', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- D Fin Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('d_fin', 'Día\Fin:') !!}
  {!! Form::date('d_fin', ($session)? date('Y-m-d', strtotime($session->d_fin)) : '', ['class' => 'form-control','id'=>'d_fin']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- H Fin Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('h_fin', 'Hora\Fin:') !!}
  {!! Form::time('h_fin', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Id Status Session Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('id_status_session', 'Estatus Sesión:') !!}
  {!! Form::select('id_status_session', $statusSessions, null, ['id'=>'id_status_session', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
  <!-- {!! Form::text('id_status_session', null, ['class' => 'form-control']) !!} -->
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Submit Field -->
<div class="form-group col-sm-12"><div class="input-group col-xs-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-registro btn-default']) !!}
  <a href="{!! route('sesiones.index') !!}" class="btn btn-registro btn-default">Cancelar</a>
</div><div><span class="help-block" id="error"></span></div></div>
