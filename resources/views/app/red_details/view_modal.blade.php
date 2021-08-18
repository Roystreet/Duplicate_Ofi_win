
<style type="text/css">
hr {
  margin-top: 0.1rem;
  margin-bottom: 0.1rem;
  border: 0;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
}
</style>

<div class="modal fade" id="modal-show" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="panel-title pull-left">Información</h5>
          <h1 class="panel-title pull-right">
          <button type="button" class="btn btn-block btn-primary btn-xs" id="searchlevel">Nivel  <p class="nivel_html"></p></button>
          </h1>
      </div>
      <input type="hidden"  id="nivelModal" name="nivelModal">

      <div class="modal-body" style="padding:3rem;">

        <div class="row directosDetails"   style="display:none">

          <!-- col1 -->
          <!-- <div class="col-xs-12 col-sm-3 center">
            <div align="center" valign="middle" class="tdFoto" width="400px" height="293px">
              <img src="{{ asset('browers/img/usuario.png') }}" width="160px" height="160px" class="img-circle" alt=""><br><br><br>
            </div>
          </div> -->
          <div class="col-xs-12 col-sm-12">

            <!-- Nombre -->
            <div class="profile-user-info">

              <!--Sponsor  -->
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Nombre Completo</p>
                </div>
                <div class="col-sm-9">
                  <label class="nombres_html"></label>, <label class="apellidos_html"></label>
                </div>
              </div>
              <hr>



              <!-- Nivel -->
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Perfil</p>
                </div>
                <div class="col-sm-9">
                  <label class="rol_html"></label>
                </div>
              </div>
              <hr>



              <!-- E-mail -->
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0"> E-mail</p>
                </div>
                <div class="col-sm-9">
                  <label class="email_html"></label>
                </div>
              </div>
              <hr>

              <!-- Telefono -->
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0"> Tel&eacute;fono</p>
                </div>
                <div class="col-sm-9">
                  <label class="telefono_html"></label>
                </div>
              </div>
              <hr>



              <!-- USUARIO -->
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Usuario</p>
                </div>
                <div class="col-sm-9">
                  <label class="usuario_invitado_html"></label>
                </div>
              </div>
              <hr>

              <!-- CODIGO -->
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Código</p>
                </div>
                <div class="col-sm-9">
                  <label class="codigo_invitado_html"></label>
                </div>
              </div>
              <hr>


              <!--Registrado desde  -->
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Registrado</p>
                </div>
                <div class="col-sm-9">
                  <label class="creado_html"></label>
                </div>
              </div>
              <hr>

              <!-- Estatus  -->
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Estatus</p>
                </div>
                <div class="col-sm-9">
                  <label class="estatus_html"></label>
                </div>
              </div>

            </div>

        </div>
      </div>

      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>
