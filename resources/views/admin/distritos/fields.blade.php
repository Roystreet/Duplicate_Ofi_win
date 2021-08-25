<!-- Id City Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
    {!! Form::label('id_city', 'C&iacute;udad:') !!}
    {!! Form::select('id_city', $city, null, ['id'=>'id_city', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Distrito Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
    {!! Form::label('distrito', 'Distrito:') !!}
    {!! Form::text('distrito', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Submit Field -->
<div class="form-group col-sm-12"><div class="input-group col-xs-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-registro btn-default']) !!}
    <a href="{{ route('distritos.index') }}" class="btn btn-registro btn-default">Cancelar</a>
</div><div><span class="help-block" id="error"></span></div></div>
