@extends('layouts.app')
@section('title', 'Auditoria')

@section('css')
  <!-- Agregando Datos- -->
  <link rel="stylesheet" href="{{ asset('plugins/DataTable/Responsive-2.2.2/css/responsive.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/DataTable/DataTables-1.10.18/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css')                              }}">
@endsection

@section('content')
  <section class="content-header">
    <h1 class="pull-left">Auditoria</h1>
      <h1 class="pull-right">
    </h1>
  </section>
    <div class="content">
      <div class="clearfix"></div>
        <div class="clearfix"></div>
          <div class="box box-success">
            <div class="box-body">
              @include('auditoria.table')
            </div>
          </div>
        <div class="text-center">
      </div>
    </div>
@endsection

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js">           </script>
  <script src="{{ asset('plugins/DataTable/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/DataTable/Responsive-2.2.2/js/dataTables.responsive.js') }}">  </script>
  <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}">            </script>
  <script src="{{ asset('js/auditoria/index.js')}} ">                                           </script>
@endsection
