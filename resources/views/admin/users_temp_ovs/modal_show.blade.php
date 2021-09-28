<style type="text/css">
  hr {
    margin-top: 0.1rem;
    margin-bottom: 0.1rem;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
  }
</style>

<div class="modal fade" id="modal-show">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="panel-title pull-left">Información</h5>
      </div>
      <input type="hidden" id="nivelModal" name="nivelModal">

      <div class="modal-body" style="padding:3rem;">

        <div class="row directosDetails">

          <div class="panel panel-body">

            @include('flash::message')
            <div class="container">

              <h1></h1>
              <div class="row">

                <!-- col1 -->
                <div class="col-xs-12 col-sm-3 center">
                  <!-- Foto -->
                  <div align="center" valign="middle" class="tdFoto" width="400px" height="293px">
                    <img src="../../browers/img/usuario.png" width="160px" height="160px" class="img-circle" alt=""><br><br><br>
                  </div>
                </div>

                <!-- col2 -->
                <div class="col-xs-12 col-sm-9">

                  <!-- Nombre -->
                  <h4 class="blue"><span class="middle"> <label class="nombres_html"></label>, <label class="apellidos_html"></label></span></h4>
                  <div class="profile-user-info">

                    <!-- E-mail -->
                    <div class="profile-info-row">
                      <div class="profile-info-name"> Documento </div>
                      <div class="profile-info-value">
                        <span class="middle"> <label class="documento_html"></label> </span>
                      </div>
                    </div>
                    <!-- E-mail -->
                    <div class="profile-info-row">
                      <div class="profile-info-name"> E-mail </div>
                      <div class="profile-info-value">
                        <span><label class="email_html"></label></span>
                      </div>
                    </div>


                    <!-- Telefono -->
                    <div class="profile-info-row">
                      <div class="profile-info-name"> Tel&eacute;fono</div>
                      <div class="profile-info-value">
                        <span><label class="telefono_html"></label></span>
                      </div>
                    </div>

                    <!-- Direccion -->
                    <div class="profile-info-row">
                      <div class="profile-info-name"> Direcci&oacute;n </div>
                      <div class="profile-info-value">
                        <i class="fa fa-map-marker light-orange bigger-110"></i>
                        <span><label class="pais_html"></label></span>
                      </div>
                    </div>



                    <!-- Utlima Conexion -->
                    <div class="profile-info-row">
                      <div class="profile-info-name"> Registrado: </div>
                      <div class="profile-info-value">
                        <span><label class="creado_html"></label></span>
                      </div>
                    </div>

                  </div>

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
