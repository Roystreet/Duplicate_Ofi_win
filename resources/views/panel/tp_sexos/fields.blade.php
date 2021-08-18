<!-- Descripcion Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('descripcion', 'Descripci&oacute;n:') !!}
  {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Submit Field -->
<div class="form-group col-sm-12"><div class="input-group col-xs-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-registro btn-default']) !!}
  <a href="{!! route('sexos.index') !!}" class="btn btn-registro btn-default">Cancelar</a>
</div><div><span class="help-block" id="error"></span></div></div>
