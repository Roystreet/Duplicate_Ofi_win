<!-- Nombres Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('nombres', 'Nombres:') !!}
  {!! Form::text('nombres', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Apellidos Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('apellidos', 'Apellidos:') !!}
  {!! Form::text('apellidos', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Email Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('email', 'E-mail:') !!}
  {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- F Nacimiento Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('f_nacimiento', 'Fecha\Nacimiento:') !!}
  {!! Form::date('f_nacimiento', ($usersApp)? date('Y-m-d', strtotime($usersApp->f_nacimiento)) : '', ['class' => 'form-control','id'=>'f_nacimiento']) !!}
</div><div><span class="help-block" id="error"></span></div></div>


<!-- Id Tp Sexo Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('id_tp_sexo', 'Sexo:') !!}
  {!! Form::select('id_tp_sexo', $sexo, null, ['id'=>'id_tp_sexo', 'placeholder' => 'Seleccione un sexo...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Telefono Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('telefono', 'Tel&eacute;fono:') !!}
  {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Id Country Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('id_country', 'Pa&iacute;s:') !!}
  {!! Form::select('id_country', $pais, null, ['id'=>'id_country', 'placeholder' => 'Seleccione un país...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Id Departament Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('id_departament', 'Departamento:') !!}
  {!! Form::select('id_departament', $departamentos, null, ['id'=>'id_departament', 'placeholder' => 'Seleccione un departamento...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Id City Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('id_city', 'C&iacute;udad:') !!}
  {!! Form::select('id_city', $ciudad, null, ['id'=>'id_city', 'placeholder' => 'Seleccione una cíudad...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Id Distrito Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label ('id_distrito', 'Distrito:') !!}
  {!! Form::select('id_distrito', $distrito, null, ['id'=>'id_distrito', 'placeholder' => 'Seleccione un distrito...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Id Status Users App Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('id_status_users_app', 'Estatus Usuarios:') !!}
  {!! Form::select('id_status_users_app', $estatus_users, null, ['id'=>'status_users_app', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
</div><div><span class="help-block" id="error"></span></div></div>

     <!-- Card  -->
     <div class="card mt-3">
      <!-- Card Title Perfil -->
      <div class="card-header border-bottom">Login</div>
      <!-- Card Body Perfil -->
      <div class="card-body">
          <div class="box box-success">
                <div class="row tema-back">

                    <div class="row w-100 p-2">
                      <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <input type="text" class="form-control" placeholder="Contraseña" id="password" >
                      </div>
                      {{-- <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <input type="text" class="form-control" placeholder="Repetir contraseña" id="password_repedida">
                      </div> --}}

                      <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <button class="btn btn-primary" onclick="restaurar()">Cambiar contraseña</button>
                      </div>
                    </div>

                    <div class="row w-100 p-2">
                      <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                        <button class="btn btn-primary" onclick="restaurar_x_correo()">Restaurar contraseña por correo</button>
                      </div>

                    </div>
                </div>
          </div>
      </div><!-- END Card Body  -->
    </div><!-- END Card  -->

