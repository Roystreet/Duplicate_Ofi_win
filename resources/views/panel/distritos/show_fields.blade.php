<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $distrito->id }}</p>
</div> -->

<!-- Id City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_city', 'C&iacute;udad:') !!}
    <p>{!! $distrito->getCity->city !!}</p>
</div>

<!-- Distrito Field -->
<div class="form-group col-sm-6">
    {!! Form::label('distrito', 'Distrito:') !!}
    <p>{{ $distrito->distrito }}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Estatus:') !!}
    <p>{!! ($distrito->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Creado en:') !!}
    <p>{{ $distrito->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Actualizado en:') !!}
    <p>{{ $distrito->updated_at }}</p>
</div>
