<!-- Descripcion Field -->
<div class="form-group col-xs-6 col-sm-6 col-md-6 col-md-6 col-xl-6 col-xxl-6">
  {!! Form::label('descripcion', 'Descripci&oacute;n:') !!}
  {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('roles.index') !!}" class="btn btn-primary">Cancelar</a>
</div>
