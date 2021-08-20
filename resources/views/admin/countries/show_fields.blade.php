<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $country->id !!}</p>
</div> -->

<!-- Country Field -->
<div class="form-group col-sm-6">
  {!! Form::label('country', 'Pa&iacute;s:') !!}
  <p>{!! $country->country !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{!! ($country->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{!! $country->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{!! $country->updated_at !!}</p>
</div>
