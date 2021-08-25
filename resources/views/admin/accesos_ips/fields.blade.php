<!-- Ip Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('ip', 'IP:') !!}
  {!! Form::text('ip', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('status', 'Estatus:') !!}
  <div class="input-group" align="center">
    <label class="radio-inline">{!! Form::radio('status', '1') !!} PERMITIDO</label>
    <label class="radio-inline">{!! Form::radio('status', '0') !!} BLOQUEADO</label>
    </div><div><span class="help-block" id="error"></span></div>
  </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12"><div class="input-group col-xs-12">
  {!! Form::submit('Guardar', ['class' => 'btn btn-registro btn-default']) !!}
  <a href="{{ route('accesos-ip.index') }}" class="btn btn-registro btn-default">Cancelar</a>
</div><div><span class="help-block" id="error"></span></div></div>
