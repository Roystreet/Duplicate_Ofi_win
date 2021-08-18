<li class="treeview">
  <a href="">
    <i class="fa  fa-briefcase"></i>
      <span>Gestion Administrativa</span>
      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
  <ul class="treeview-menu" style="display: none;">
<li>

<!-- MENUS NECESARIOS -->

<li class="{{ Request::is('tpSexos*') ? 'active' : '' }}">
  <a href="{!! route('tpSexos.index') !!}"><i class="fa fa-venus-mars"></i><span>Sexo</span></a>
</li>

<li class="{{ Request::is('tpServicios*') ? 'active' : '' }}">
  <a href="{!! route('tpServicios.index') !!}"><i class="fa fa-cogs"></i><span>Servicios</span></a>
</li>

<li class="{{ Request::is('tpDias*') ? 'active' : '' }}">
  <a href="{!! route('tpDias.index') !!}"><i class="fa fa-calendar"></i><span>D&iacute;as</span></a>
</li>

<li class="{{ Request::is('tpAtencions*') ? 'active' : '' }}">
  <a href="{!! route('tpAtencions.index') !!}"><i class="fa fa-tags"></i><span>Atenci&oacute;n</span></a>
</li>

<li class="{{ Request::is('tpCalificacions*') ? 'active' : '' }}">
  <a href="{!! route('tpCalificacions.index') !!}"><i class="fa fa-star-o"></i><span>Calificaci&oacute;n</span></a>
</li>

<!-- MENUS NECESARIOS -->

</li>
  </ul>
    </li>
      <li class="treeview">
        <a href="">
          <i class="fa fa-globe"></i>
            <span>Ubicaci&oacute;n</span>
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
   <ul class="treeview-menu" style="display: none;">
 <li>

<!-- MENUS NECESARIOS -->

<li class="{{ Request::is('countries*') ? 'active' : '' }}">
  <a href="{!! route('countries.index') !!}"><i class="fa fa-map-marker"></i><span>Pa&iacute;s</span></a>
</li>

<li class="{{ Request::is('departaments*') ? 'active' : '' }}">
  <a href="{!! route('departaments.index') !!}"><i class="fa fa-map-pin"></i><span>Departamento</span></a>
</li>

<li class="{{ Request::is('cities*') ? 'active' : '' }}">
  <a href="{!! route('cities.index') !!}"><i class="fa fa-thumb-tack"></i><span>C&iacute;udad</span></a>
</li>

<!-- MENUS NECESARIOS -->

</li>
  </ul>
    </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-refresh"></i>
          <span>Estatus</span>
      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
  <ul class="treeview-menu" style="display: none;">
<li>

<!-- MENUS NECESARIOS -->

<li class="{{ Request::is('statusUsersApps*') ? 'active' : '' }}">
  <a href="{!! route('statusUsersApps.index') !!}"><i class="fa fa-spinner"></i><span>Estatus Usuarios</span></a>
</li>

<li class="{{ Request::is('statusReservaciones*') ? 'active' : '' }}">
  <a  href="{!! route('statusReservaciones.index') !!}"><i class="fa fa-spinner"></i><span>Estatus Reservaciones</span></a>
</li>

<li class="{{ Request::is('statusSessions*') ? 'active' : '' }}">
  <a href="{!! route('statusSessions.index') !!}"><i class="fa fa-spinner"></i><span>Estatus Sesi&oacute;n</span></a>
</li>

<li class="{{ Request::is('sessions*') ? 'active' : '' }}">
  <a href="{!! route('sessions.index') !!}"><i class="fa fa-arrow-circle-o-right"></i><span>Sesi&oacute;n</span></a>
</li>

<!-- MENUS NECESARIOS -->

</li>
  </ul>
    </li>
      <li class="treeview">
        <a href="">
          <i class="fa fa-group"></i>
            <span>Usuarios</span>
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
      <ul class="treeview-menu" style="display: none;">
    <li>

<!-- MENUS NECESARIOS -->

<li class="{{ Request::is('usersApps*') ? 'active' : '' }}">
  <a href="{!! route('usersApps.index') !!}"><i class="fa fa-reorder"></i><span>Listado</span></a>
</li>

<li class="{{ Request::is('serviciosManicuristas*') ? 'active' : '' }}">
  <a href="{!! route('serviciosManicuristas.index') !!}"><i class="fa fa-share-square-o"></i><span>Servicios Manicuristas</span></a>
</li>

<li class="{{ Request::is('horarioManicuristas*') ? 'active' : '' }}">
  <a href="{!! route('horarioManicuristas.index') !!}"><i class="fa fa-calendar"></i><span>Horario Manicuristas</span></a>
</li>

<li class="{{ Request::is('reservaciones*') ? 'active' : '' }}">
  <a href="{!! route('reservaciones.index') !!}"><i class="fa fa-calendar-check-o"></i><span>Reservaciones</span></a>
</li>

<!-- MENUS NECESARIOS -->

</li>
  </ul>
    </li>
      <li class="treeview">
        <a href="">
          <i class="fa fa-wrench"></i>
        <span>Accesos</span>
      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
  <ul class="treeview-menu" style="display: none;">
<li>

<!-- MENUS NECESARIOS -->

<li class="{{ Request::is('passwordUsersApps*') ? 'active' : '' }}">
  <a href="{!! route('passwordUsersApps.index') !!}"><i class="fa fa-expeditedssl"></i><span>Contrase&ntilde;a Usuarios</span></a>
</li>

<li class="{{ Request::is('tokenUsersApps*') ? 'active' : '' }}">
  <a href="{!! route('tokenUsersApps.index') !!}"><i class="fa fa-sun-o"></i><span>Token Usuarios</span></a>
</li>

<li class="{{ Request::is('tpTokens*') ? 'active' : '' }}">
  <a href="{!! route('tpTokens.index') !!}"><i class="fa fa-yelp"></i><span>Token</span></a>
</li>

<!-- MENUS NECESARIOS -->

</li>
  </ul>
    </li>
      <li class="treeview">
        <a href="">
          <i class="fa fa-th-list"></i>
        <span>Items</span>
      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
  <ul class="treeview-menu" style="display: none;">
<li>

<!-- MENUS NECESARIOS -->

<li class="{{ Request::is('rolMenus*') ? 'active' : '' }}">
  <a href="{!! route('rolMenus.index') !!}"><i class="fa fa-rotate-right"></i><span>Rol Men&uacute;</span></a>
</li>

<li class="{{ Request::is('rolUsers*') ? 'active' : '' }}">
  <a href="{!! route('rolUsers.index') !!}"><i class="fa fa-user"></i><span>Rol Usuarios</span></a>
</li>

<li class="{{ Request::is('tpRols*') ? 'active' : '' }}">
  <a href="{!! route('tpRols.index') !!}"><i class="fa fa-child"></i><span>Rol</span></a>
</li>

<li class="{{ Request::is('menus*') ? 'active' : '' }}">
  <a href="{!! route('menus.index') !!}"><i class="fa fa-th-large"></i><span>Men&uacute;</span></a>
</li>

<li class="{{ Request::is('permisos*') ? 'active' : '' }}">
  <a href="{!! route('permisos.index') !!}"><i class="fa fa-folder-open-o"></i><span>Permisos</span></a>
</li>

<!-- MENUS NECESARIOS -->

</li>
  </ul>
    </li>
      <li class="treeview">
        <a href="">
          <i class="fa fa-file-image-o"></i>
        <span>Imagen</span>
      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
  <ul class="treeview-menu" style="display: none;">
<li>

<!-- MENUS NECESARIOS -->

<li class="{{ Request::is('photoPerfils*') ? 'active' : '' }}">
  <a href="{{ route('photoPerfils.index') }}"><i class="fa fa-photo"></i><span>Foto Perfil</span></a>
</li>

<!-- MENUS NECESARIOS -->

</li>
  </ul>
    </li>
      <li class="treeview">
        <a href="">
          <i class="fa fa- fa-money"></i>
        <span>Moneda</span>
      <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
    </a>
  <ul class="treeview-menu" style="display: none;">
<li>

<!-- MENUS NECESARIOS -->

<li class="{{ Request::is('precioServicios*') ? 'active' : '' }}">
  <a href="{!! route('precioServicios.index') !!}"><i class="fa fa-usd"></i><span>Precio Servicios</span></a>
</li>

<li class="{{ Request::is('precios*') ? 'active' : '' }}">
  <a href="{!! route('precios.index') !!}"><i class="fa fa-cc-mastercard"></i><span>Precios</span></a>
</li>

<li class="{{ Request::is('tpPagos*') ? 'active' : '' }}">
  <a href="{!! route('tpPagos.index') !!}"><i class="fa fa-cc-visa"></i><span>Pagos</span></a>
</li>

<!-- MENUS NECESARIOS -->
<li class="{{ Request::is('servicioManicuristaDetalles*') ? 'active' : '' }}">
  <a href="{{ route('servicioManicuristaDetalles.index') }}"><i class="fa fa-edit"></i><span>Servicio Manicurista Detalles</span></a>
</li>

<li class="{{ Request::is('servicioAtencions*') ? 'active' : '' }}">
  <a href="{{ route('servicioAtencions.index') }}"><i class="fa fa-edit"></i><span>Servicio Atencions</span></a>
</li>

<li class="{{ Request::is('servicioManicuristaFotos*') ? 'active' : '' }}">
  <a href="{{ route('servicioManicuristaFotos.index') }}"><i class="fa fa-edit"></i><span>Servicio Manicurista Fotos</span></a>
</li>

<li class="{{ Request::is('servicioManicuristaAtencions*') ? 'active' : '' }}">
  <a href="{{ route('servicioManicuristaAtencions.index') }}"><i class="fa fa-edit"></i><span>Servicio Manicurista Atencions</span></a>
</li>
<li class="{{ Request::is('distritos*') ? 'active' : '' }}">
    <a href="{{ route('distritos.index') }}"><i class="fa fa-edit"></i><span>Distritos</span></a>
</li>

