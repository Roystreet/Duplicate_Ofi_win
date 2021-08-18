@extends('layouts.app')
@section('title', 'Listado')

@section('content')
<section class="content-header">
  <h1>
    Usuarios
  </h1>
</section>
  <div class="content">
    <div class="box box-success">
      <div class="box-body">
        <div class="row" style="padding-left: 20px">
          @include('panel.users_apps.show_fields')
          <a href="{!! route('usuarios-app.index') !!}" class="btn btn-default">Atrás</a>
        </div>
      </div>
    </div>
  </div>
@endsection
