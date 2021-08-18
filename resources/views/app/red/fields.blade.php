<div class="p-4">
  {!! Form::open(['route' => 'red-save', 'id' => 'formRed']) !!}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {!! Form::hidden('id_red_users_app', $redUsersApp->id, ['id'=>'id_red_users_app', 'class' => 'form-control']) !!}


  <div class="form-row">

    <div class="col-sm-12">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
    </div>

    <div class="col-sm-12">

      <div class="row">
        <div class="col-sm-3">
          <p class="mb-0">Patrocinante</p>
        </div>
        <div class="col-sm-9">
          {{ $redUsersApp->sp_first_name }} {{ $redUsersApp->sp_middle_name }}, {{ $redUsersApp->sp_last_name }}
        </div>
      </div>

      <hr>
      <div class="row">
        <div class="col-sm-3">
          <p class="mb-0">Estado</p>
        </div>
        <div class="col-sm-9">
          {{ $redUsersApp->status_red }}
        </div>
      </div>

      <hr>
      <div class="row">
        <div class="col-sm-3">
          <p class="mb-0">Mi C&oacute;digo</p>
        </div>
        <div class="col-sm-9">
          {{ $redUsersApp->codigo_invitado }}
        </div>
      </div>

      <hr/>
      <div class="form-group col-sm-12 mt-4" align="center">
        <div class="box-footer">
          <div class="form-group">
            <div class="col-xs-12"><label for="Datos">Nota: <code>Coloca un usuario para que compartas con tus amigos y familiares.</code></label></div>
          </div>
        </div>
      </div>

      <hr/>
      <div class="row mt-4">
        <div class="col-sm-3">
          <label for="usuario_invitado">Mi Usuario:</label><code>*</code>
        </div>
        <div class="col-sm-9">
          <div class="form-group col-sm-12">
            <div class="input-group col-xs-12">
              {!! Form::text('usuario_invitado', $redUsersApp->usuario_invitado, ['id'=> 'usuario_invitado', 'class' => 'form-control',  'placeholder'=> 'Indica tu usuario.']) !!}
            </div>
            <div><span class="help-block" id="error"></span></div>
          </div>
        </div>
      </div>
      <hr/>
      <br>


      <div class="row">
        <div class="col-sm-4">
        </div>

        <div class="col-sm-4">
          {!! Form::button('Cancelar', ['id'=>'verRedButton', 'class' => 'btn btn-registro btn-danger btn-block']) !!}
        </div>
        <div class="col-sm-4">
          {!! Form::submit('Guardar', ['id'=>'editarRedButton', 'class' => 'btn btn-registro pull-right btn-primary btn-block']) !!}
        </div>

      </div>

    </div>

  </div>

</div>
