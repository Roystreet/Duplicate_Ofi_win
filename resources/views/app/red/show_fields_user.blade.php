<div class="user-detalle-view">
  <div class="pl-3 pr-3">

    <div class="form-row">
      <!-- Sponsor -->
      <div class="col-xs-12 col-sm-6">
        <label>Sponsor:</label>
        <div class="bg-light border p-3 mb-3">{{ $redUsersApp->sponsor_first_name }}, {{ $redUsersApp->sponsor_last_name }}</div>
      </div>
      <!-- Estado -->
      <div class="col-xs-12 col-sm-6">
        <label>Estado:</label>
        <div class="bg-light border p-3 mb-3">{{ $redUsersApp->status_red }}</div>
      </div>
    </div>
    <div class="form-row">
      <!-- Código -->
      <div class="col-xs-12 col-sm-6">
        <label>Mi C&oacute;digo:</label>
        <div class="bg-light border p-3 mb-3">{{ $redUsersApp->codigo_invitado }}</div>
      </div>
      <!-- Usuario -->
      <div class="col-xs-12 col-sm-6">
        <label>Mi Usuario:</label>
        <div class="bg-light border p-3 mb-3">{{ $redUsersApp->usuario_invitado }}</div>
      </div>
    </div>
  </div>
  @if($redUsersApp->id_status_red == 2)
  <div class="col-xs-12 col-sm-12" align="center">
    <div class="box-footer">
      <div class="form-group">
        <div class="col-xs-12"><label for="Datos">Nota: <code>Debes indicar tu usuario, para comenzar a invitar nuevos amigos.</code></label></div>
      </div>
    </div>
  </div>
  @endif
</div>
