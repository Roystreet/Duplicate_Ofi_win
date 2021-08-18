<!-- Status Session Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status_session', 'Estatus Sesión:') !!}
  <p>{!! $statusSession->status_session !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{!! ($statusSession->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Credo en:') !!}
  <p>{!! $statusSession->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{!! $statusSession->updated_at !!}</p>
</div>
