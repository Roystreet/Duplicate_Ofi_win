@extends('layout.app')
@section('title', 'Panel')

@section('css')
<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
<style media="screen">

</style>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
{{ csrf_field() }}

<!-- Cabecera del contenedor de la vista -->
@include('layout.page-header')

<!-- Container-fluid -->
<div class="container-fixed mt-n10 row justify-content-center" >
    @include('flash::message')
  
    <div class="card mb-4 col-xs-12 col-lg-10">
        <!-- Card Title -->
        <div class="card-header">Bienvenido(a), tu oficina virtual está lista!</div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="position-relative">
              <div class="row align-items-center justify-content-between">
                <div class="col-xl col-lg-12 text-justify">
                    <p class="text-gray-700">Recibe una cordial bienvenida a tu Oficina Virtual. Hemos diseñado una interfaz más intuitiva y fácil de navegar. Aquí podrás ver a toda tu organización (tu red social) además de contar con capacitación constante.
                      Para cualquier consulta tienes a tu disposición nuestro canal de comunicación al cual puedes acceder desde el menú en la parte izquierda link "información".</p>
                    <p class="text-gray-700">¡Gracias por ser parte de la gran familia Win Rideshare!</p>
                    <p class="text-gray-700">Somos la primera red social monetizada de transporte. Somos WINRIDES</p>
                </div> <!-- END col -->
                <div class="col d-none d-md-block text-right pt-3 text-center"><img class="img-fluid mt-n5" src="https://i.postimg.cc/PrM7hmgB/Comunicados-DEVWIN-BO-2.png" style="max-width: 20rem;" /></div>
              </div> <!-- END row -->
           </div>
        </div> <!-- END Card Body -->
    </div> <!-- END Card -->
</div> <!-- END Container-fluid -->
@endsection

@section('scripts')
<!-- Llamado del script de esta vista -->
<script src="{{ asset('alertify/js/alertify.min.js') }}"></script>
<script src="{{ asset('plugins/jqueryvalidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/app/home.js')}} "></script>
@endsection
