@extends('layout.app')
@section('title', 'Menú')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inputs_sin_icon.css')}}">
<link rel="stylesheet" href="{{ asset('css/botones.css') }}">
@endsection

@section('content')
<div class="container-fluid p-3">
  <div class="card">
    <div class="card-header">
      <h3>Men&uacute;</h3> 
    </div>
    <div class="card-body">
      <div class="row w-100">
        @include('adminlte-templates::common.errors')
      </div>
       <div class="row w-100">
        {!! Form::model($menu, ['route' => ['menus.update', $menu->id], 'method' => 'patch' , 'id'=>'formEditMenus','class'=>"w-100"]) !!}
          @include('admin.menus.fields')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
{{-- <section class="content-header">
  <h1>
    Men&uacute;
  </h1>
</section>
  <div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-success">
      <div class="box-body">
        <div class="row">
          {!! Form::model($menu, ['route' => ['menus.update', $menu->id], 'method' => 'patch' , 'id'=>'formEditMenus']) !!}
            @include('admin.menus.fields')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div> --}}
@endsection

@section('scripts')
<script src="{{ asset('plugins/jqueryvalidate/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/panel/menus/edit.js')}} "></script>
@endsection
