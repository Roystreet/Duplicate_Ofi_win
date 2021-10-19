@extends('layout.app')
@section('title', 'Rol Usuario')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')

<div class="container-fluid p-3">
  <div class="card">
    <div class="card-header">
      <h3>Crear Rol Usuarios</h3> 
    </div>
    <div class="card-body">
       <div class="row w-100">
        {!! Form::open(['route' => 'rol-usuarios.store' , 'id'=>'formCreateRolUsers',"class"=>'w-100']) !!}
        @include('admin.rol_users.fields')
      {!! Form::close() !!} 
      </div>
    </div>
  </div>
</div>
{{-- <section class="content-header">
  <h1>
    Rol Usuarios
  </h1>
</section>
  <div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-success">
      <div class="box-body">
        <div class="row">
          {!! Form::open(['route' => 'rol-usuarios.store' , 'id'=>'formCreateRolUsers']) !!}
            @include('admin.rol_users.fields')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div> --}}
@endsection

@section('scripts')
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="{{ asset('js/panel/rol_users/create.js')}} "></script>
@endsection
