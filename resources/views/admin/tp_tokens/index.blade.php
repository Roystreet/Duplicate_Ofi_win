@extends('layout.app')
@section('title', 'Tipo de tokens')

@section('css')
<!-- Datatables -->
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
<!-- Alertify -->
<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
@endsection

@section('content')
@include('layout.page-header')

<!-- Container-fluid -->
<div class="container-fluid mt-n10">
    <!-- Card -->
    <div class="card mb-4">


      <div class="card-header">
        <div class="col-md-10 float-right">
          B&uacute;squeda d de tipos de token
        </div>

        <div class="col-md-2 float-right">
          <a class="btn float-right btn-primary" href="{!! route('token.create') !!}">Agregar</a>
        </div>
      </div>

      @if (session('status')) <!-- Si el tipo de token se creó/actualizó correctamente, mostrará el mensaje del controlador -->
          <div class="alert alert-success alert-icon mt-2 ml-2 mr-2" role="alert">
              <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
              <div class="alert-icon-aside">
                  <i class="fas fa-check"></i>
              </div>
              <div class="alert-icon-content">
                  <h6 class="alert-heading">{{ session('status') }}</h6>
              </div>
          </div>
      @endif

        <div class="card-body">
          <table class="table table-sm table-bordered table-hover"  width="100%" cellspacing="0" id="tpTokens-table">
                    <thead>
                      <tr>
                        <th>Acci&oacute;n</th>
                        <th>Descripci&oacute;n</th>
                        <th>Estado</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Acci&oacute;n</th>
                        <th>Descripci&oacute;n</th>
                        <th>Estado</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <!-- El cuerpo de la tabla lo genera el asset tp_tokens/index.js -->
                    </tbody>
                  </table>
        </div> <!-- END Card body -->
  </div> <!-- END Card -->
</div> <!-- END Container-fluid -->
@endsection

@section('scripts')
<!-- JS DataTable -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<!-- JS Alertify -->
<script src="{{ asset('alertify/js/alertify.min.js') }}"></script>
<!-- JS de la vista -->
<script src="{{ asset('js/panel/tp_tokens/index.js')}} "></script>
@endsection
