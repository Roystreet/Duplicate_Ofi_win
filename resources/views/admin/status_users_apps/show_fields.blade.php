<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $statusUsersApp->id !!}</p>
</div> -->

<!-- Status User Offices Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status_users_app', 'Estatus usuarios:') !!}
  <p>{!! $statusUsersApp->status_users_app !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{!! ($statusUsersApp->status ==1)? 'ACTIVADO' : 'DESACTIVADO' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{!! $statusUsersApp->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{!! $statusUsersApp->updated_at !!}</p>
</div>
