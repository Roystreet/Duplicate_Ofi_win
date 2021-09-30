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
                 <td><div class="btn-group"><a href="/red-usuarios/{{ $row->id }}" class="btn btn-outline-blue btn-sm"><i class="fa fa-eye"></i></a><a href="/red-usuarios/{{ $row->id }}/edit" class="btn btn-outline-blue btn-sm"><i class="fa fa-edit"></i></a></div></td>
                 <td>{{ $row->username }}</td>
                 <td>{{ ($row->getUsersInvitado) ? $row->getUsersInvitado->first_name : '-' }}</td>
                 <td>{{ ($row->getUsersInvitado) ? $row->getUsersInvitado->last_name : '-' }}</td>
                 <td>{{ ($row->getUsersInvitado) ? $row->getUsersInvitado->email : '-' }}</td>
                 <td>{{ ($row->getUsersSponsorCodigo) ? $row->getUsersSponsorCodigo->username : '-' }}</td>
                 <td>{{ $row->getStatusRed->descripcion }}</td>
                 <td>({{ $row->status }} == true) ? <a onclick="estatusUpload('{{ $row->id }}')" class="btn btn-outline-green btn-sm"><i class="fa fa-check-circle"></i><a> : <a onclick="estatusUpload({{ $row->id }})" class="btn btn-outline-red  btn-sm"><i class="fa fa-close-circle"></i><a></td>
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
