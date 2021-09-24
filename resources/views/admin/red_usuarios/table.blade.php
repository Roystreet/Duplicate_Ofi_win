<div class=" data-table table-responsive">
    <table class="table table-sm table-bordered table-hover" style="width:100%" id="redUsuarios-table" cellspacing="0">
        <thead>
            <tr>
                <th>Acci&oacute;n</th>
                <th>Usuario</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Usuario Sponsor</th>
                <th>Estatus Red</th>
                <th>Estatus</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $row)
                <tr>
                 <td>{{ $row->id }}</td>
                 <td>{{ $row->username }}</td>
                 <td>{{ ($row->getUsersInvitado) ? $row->getUsersInvitado->first_name : '-' }}</td>
                 <td>{{ ($row->getUsersInvitado) ? $row->getUsersInvitado->last_name : '-' }}</td>
                 <td>{{ ($row->getUsersInvitado) ? $row->getUsersInvitado->email : '-' }}</td>
                 <td>{{ ($row->getUsersSponsorCodigo) ? $row->getUsersSponsorCodigo->username : '-' }}</td>
                 <td>{{ $row->getStatusRed->descripcion }}</td>
                 <td>{{ $row->id }}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>Acci&oacute;n</th>
                <th>Usuario</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Usuario Sponsor</th>
                <th>Estatus Red</th>
                <th>Estatus</th>
              </tr>
            </tfoot>
          </table>

          {!! $data->links() !!}
        </div>
