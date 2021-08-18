<style>
  .nav-pills .nav-link,
  .nav-pills .nav-link.active,
  .nav-pills .nav-link:hover {
    border: 0;
    border-bottom: 1px solid grey;
    color: gray;
  }

  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    color: #08426a;
    background-color: #bbcbde;
    border-bottom: 2px solid blue;
  }
</style>

<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link active warning" href="#perfil" data-toggle="tab" role="tab" aria-controls="perfil" aria-selected="false" aria-current="page">Mi informaci&oacute;n</a>
  </li>
  <!-- <li class="nav-item">
    <a class="nav-link warning" href="#invitar" data-toggle="tab" role="tab" aria-controls="invitar" aria-selected="false">Invitar</a>
  </li> -->
</ul>
<div class="tab-content" id="pills-tabContent">

  <div class="tab-pane fade show active" id="perfil" role="tabpanel" aria-labelledby="overview-tab">

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

  </div>


  <div class="tab-pane fade" id="invitar" role="tabpanel" aria-labelledby="example-tab">
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
  </div>


</div>
