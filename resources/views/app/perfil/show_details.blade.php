
    @if ($usersApp->id_status_users_app == 1)
      @include('app.perfil.fields')
    @else
        <div id="verPerfilDiv" >
          @include('app.perfil.show')
        </div>

        <div id="editarPerfilDiv" style="display:none">
          @include('app.perfil.fields')
        </div>
    @endif

    <hr>
    @if ($redUsersApp->id_status_red == 2)
      @include('app.red.fields')
    @else
        <div id="verRedDiv" >
          @include('app.red.show')
        </div>

        <div id="editarRedDiv" style="display:none">
          @include('app.red.fields')
        </div>
    @endif
