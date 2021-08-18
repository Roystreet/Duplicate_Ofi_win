<!-- Id Field -->
<!-- <div class="form-group col-sm-6">
  {!! Form::label('id', 'Id:') !!}
  <p>{{ $accesosIp->id }}</p>
</div> -->

<!-- Ip Field -->
<div class="form-group col-sm-6">
  {!! Form::label('ip', 'IP') !!}
  <p>{{ $accesosIp->ip }}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{{ ($accesosIp->status ==1)? 'PERMITIDO' : 'BLOQUEADO' }}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{{ $accesosIp->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{{ $accesosIp->updated_at }}</p>
</div>
