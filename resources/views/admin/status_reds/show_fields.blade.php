<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
  {!! Form::label('id', 'Id:') !!}
  <p>{{ $statusRed->id }}</p>
</div> -->

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
  {!! Form::label('descripcion', 'Descripci&oacute;n:') !!}
  <p>{{ $statusRed->descripcion }}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{!! ($statusRed->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{{ $statusRed->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{{ $statusRed->updated_at }}</p>
</div>
