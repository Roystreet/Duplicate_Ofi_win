
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
      <p class="mb-0">Patrocinante</p>
    </div>
    <div class="col-sm-9">
      {{ $redUsersApp->sp_first_name }}, {{ $redUsersApp->sp_last_name }}
    </div>
  </div>

  <hr>
  <div class="row">
    <div class="col-sm-3">
      <p class="mb-0">Estado</p>
    </div>
    <div class="col-sm-9">
      {{ $redUsersApp->status_red }}
    </div>
  </div>

  <hr>
  <div class="row">
    <div class="col-sm-3">
      <p class="mb-0">Mi C&oacute;digo</p>
    </div>
    <div class="col-sm-9">
      {{ $redUsersApp->codigo_invitado }}
    </div>
  </div>

  <hr>
  <div class="row">
    <div class="col-sm-3">
      <p class="mb-0">Mi Usuario</p>
    </div>
    <div class="col-sm-9">
      {{ $redUsersApp->usuario_invitado }}
    </div>
  </div>

  <hr>
  @if($redUsersApp->id_status_red == 2)
  <div class="col-xs-12 col-sm-12" align="center">
    <div class="box-footer">
      <div class="form-group">
        <div class="col-xs-12"><label for="Datos">Nota: <code>Debes indicar tu usuario, para comenzar a invitar nuevos amigos.</code></label></div>
      </div>
    </div>
  </div>
  @endif

  <br>
  <div class="row">
    <div class="col-sm-8">
    </div>

    <div class="col-sm-4">
      {!! Form::submit('Editar', ['id'=>'editarRedButton', 'class' => 'btn btn-registro pull-right btn-primary btn-block']) !!}
    </div>
  </div>

</div>
