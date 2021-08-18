<div class="col-md-12 box-body box-profile text-center">
  <img class="profile-user-img img-responsive img-circle" src="../../browers/img/usuario.png" alt="Imagen de Perfil">
  <p class="text-muted text-center">{{ $usersApp->tp_rol }}</p>
</div>

<div class="col-md-12 box-body box-profile text-center">
  <ul class="list-group list-group-flush text-justify">
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <b>Activos</b>
      <span class="badge badge-success badge-pill">{{ $redUsersApp->redUserMeActv }}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <b>Inactivos</b>
      <span class="badge badge-warning badge-pill">{{ $redUsersApp->redUserMeInactv }}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <b>Total</b>
      <span class="badge badge-primary badge-pill">{{ $redUsersApp->redUserMe }}</span>
    </li>
  </ul>
</div>