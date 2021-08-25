<!-- Id Departament Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('id_departament', 'Departamento:') !!}
  {!! Form::select('id_departament', $departament, null, ['id'=>'id_departament', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- City Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('city', 'Cíudad:') !!}
  {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Submit Field -->
<div class="form-group col-sm-12"><div class="input-group col-xs-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-registro btn-default']) !!}
  <a href="{!! route('ciudad.index') !!}" class="btn btn-registro btn-default">Cancelar</a>
</div><div><span class="help-block" id="error"></span></div></div>
