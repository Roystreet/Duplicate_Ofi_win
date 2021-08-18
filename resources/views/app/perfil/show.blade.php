
<style type="text/css">
hr {
  margin-top: 0.4rem;
  margin-bottom: 0.4rem;
  border: 0;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
}
</style>

<div class="mt-4">


  <div class="row">
    <div class="col-sm-3">
      <p class="mb-0">Nombre</p>
    </div>
    <div class="col-sm-9">
      {{ $usersApp->first_name }} {{ $usersApp->middle_name }}, {{ $usersApp->last_name }}
    </div>
  </div>

  <hr>
  <div class="row">
    <div class="col-sm-3">
      <p class="mb-0">Sexo</p>
    </div>
    <div class="col-sm-9">
      {{ $usersApp->sexo }}
    </div>
  </div>

  <hr>
  <div class="row">
    <div class="col-sm-3">
      <p class="mb-0">Fecha de nacimiento</p>
    </div>
    <div class="col-sm-9">
      {{ $usersApp->birth }}
    </div>
  </div>

  <hr>
  <div class="row">
    <div class="col-sm-3">
      <p class="mb-0">Tel&eacute;fono</p>
    </div>
    <div class="col-sm-9">
      {{ $usersApp->phone }}
    </div>
  </div>

  <hr>
  <div class="row">
    <div class="col-sm-3">
      <p class="mb-0">Ubicaci&oacute;n</p>
    </div>
    <div class="col-sm-9">
      {{ $usersApp->country }}, {{ $usersApp->departament }}
    </div>
  </div>

  <hr>
  <div class="row">
    <div class="col-sm-3">
      <p class="mb-0">Direcci&oacute;n</p>
    </div>
    <div class="col-sm-9">
      {{ ($usersApp->address)? $usersApp->address : 'Sin registro'}}
    </div>
  </div>


  <hr>
  <div class="row">
    <div class="col-sm-3">
      <p class="mb-0">Identificaci&oacute;n</p>
    </div>
    <div class="col-sm-9">
      {{ ($usersApp->n_document)? $usersApp->tp_document_ab.' - '.$usersApp->n_document : 'Sin registro'}}
    </div>
  </div>


  <hr>
  <div class="row">
    <div class="col-sm-3">
      <p class="mb-0">Estatus</p>
    </div>
    <div class="col-sm-9">
      {{ $usersApp->status_users_app }}
    </div>
  </div>

  <hr>
  <div class="row">
    <div class="col-sm-3">
      <p class="mb-0">&Uacute;ltima Conexi&oacute;n</p>
    </div>
    <div class="col-sm-9">
      {{ $usersApp->ult_session }}
    </div>
  </div>
  <hr>
  <br>
  <div class="row">
    <div class="col-sm-8">
    </div>

    <div class="col-sm-4">
      {!! Form::submit('Editar', ['id'=>'editarPerfilButton', 'class' => 'btn btn-registro pull-right btn-primary btn-block']) !!}
    </div>
  </div>

</div>
