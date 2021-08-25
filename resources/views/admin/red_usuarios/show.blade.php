@extends('layout.app')
@section('title', 'Red Usuarios')

@section('css')
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
@include('layout.page-header')

 <div class="content">
   <div class="box box-success">
     <div class="box-body">
       <div class="row" style="padding-left: 20px">
         @include('admin.red_usuarios.show_fields')
         <a href="{{ route('red-usuarios.index') }}" class="btn btn-registro btn-default">Atrás</a>
       </div>
     </div>
   </div>
 </div>
@endsection
