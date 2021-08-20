<!-- Id Users App Field -->
<div class="form-group col-sm-6">
  {!! Form::label('id_users_app', 'Usuarios:') !!}
  <p>{!! ($photoPerfil->id_users_app)? $photoPerfil->getUsersApp->nombres : '-' !!} {!! ($photoPerfil->id_users_app)? $photoPerfil->getUsersApp->apellidos : '-' !!}</p>
</div>

<!-- Url Photo Field -->
<div class="form-group col-sm-6">
  {!! Form::label('url_photo', 'Foto:') !!}
  <p>{{ $photoPerfil->url_photo }}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
  {!! Form::label('status', 'Estatus:') !!}
  <p>{{ ($photoPerfil->status ==1)? 'ACTIVADO' : 'DESACTIVADO' }}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('created_at', 'Creado en:') !!}
  <p>{{ $photoPerfil->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
  {!! Form::label('updated_at', 'Actualizado en:') !!}
  <p>{{ $photoPerfil->updated_at }}</p>
</div>
