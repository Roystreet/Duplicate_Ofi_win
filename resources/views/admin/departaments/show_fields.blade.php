<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $departament->id !!}</p>
</div> -->

<!-- Id Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_country', 'Pa&iacute;s:') !!}
  <p>{!! $departament->getCountry->country  !!}</p>
</div>

<!-- Departament Field -->
<div class="form-group col-sm-6">
  {!! Form::label('departament', 'Departamento:') !!}
  <p>{!! $departament->departament !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{!! ($departament->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{!! $departament->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{!! $departament->updated_at !!}</p>
</div>
