@extends('layout.app')
@section('title', 'Rol Usuario')

@section('css')
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">


{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-flexdatalist/2.3.0/jquery.flexdatalist.min.js" integrity="sha512-JEX6Es4Dhu4vQWWA+vVBNJzwejdpqeGeii0sfiWJbBlAfFzkeAy6WOxPYA4HEVeCHwAPa+8pDZQt8rLKDDGHgw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-flexdatalist/2.3.0/jquery.flexdatalist.css" integrity="sha512-mVj7k7kIC4+FkO7xQ04Di4Q4vSg8BP3HA7Pzss2ib+EqufKS5GuJW1mGtVo70i9hHTgEv6UmxcPb6tddRdk89A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
@endsection

@section('content')

<div class="container-fluid p-3">
  <div class="card">
    <div class="card-header">
      <h3>Ver Rol Usuario</h3> 
    </div>
    <div class="card-body">
 
       <div class="row w-100">
        @include('admin.rol_users.show_fields')
          <a href="{!! route('rol-usuarios.index') !!}" class="btn  btn-primary">Atrás</a>
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
    <div class="box box-success">
      <div class="box-body">
        <div class="row" style="padding-left: 20px">
          @include('admin.rol_users.show_fields')
          <a href="{!! route('rol-usuarios.index') !!}" class="btn btn-registro btn-default">Atrás</a>
        </div>
      </div>
    </div>
  </div> --}}
@endsection
