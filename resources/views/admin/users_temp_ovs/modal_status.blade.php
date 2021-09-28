<style type="text/css">
  hr {
    margin-top: 0.1rem;
    margin-bottom: 0.1rem;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
  }
</style>

<div class="modal fade" id="modal-show-status">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="panel-title pull-left">Información</h5>
      </div>
      <input type="hidden" id="nivelModal" name="nivelModal">

      <div class="modal-body" style="padding:3rem;">
        <div class="form-row">
          <div class="col-xs-12 col-sm-12">
            <label for="id_users_app">Estatus:</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-user"></i></div>
              </div>
              <select name="status_ov" id="status_ov">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="REVISADO">REVISADO</option>
                <option value="CERRADO">CERRADO</option>
                <option value="NO ENCONTRADO">NO ENCONTRADO</option>
              </select>
              <input type="hidden" name="id_users_temp_ovs" id="id_users_temp_ovs">
            </div>
            <div><span class="help-block" id="error"></span></div>
          </div>
        </div>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="saveStatus">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>
