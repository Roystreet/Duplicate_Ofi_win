<!-- Id Users App Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('id_user', 'email:') !!}
  <select id="id_user" name="id_user" class="js-data-example-ajax w-100">

  </select>
{{-- <input type="text" id="email" name="email" list="usuarios" >   --}}
<button class="btn btn-primary" id="buscar">Buscar</button>
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Id Tp Rol Field -->
<div class="form-group col-sm-6"><div class="input-group col-xs-12">
  {!! Form::label('id_tp_rol', 'Rol:') !!}
  {!! Form::select('id_tp_rol', $tpRols, null, ['id'=>'id_tp_rol', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
  <!-- {!! Form::text('id_tp_rol', null, ['class' => 'form-control']) !!} -->
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Submit Field -->
<div class="form-group col-sm-12"><div class="input-group col-xs-12">
  {!! Form::submit('Guardar', ['class' => 'btn  btn-primary']) !!}
  <a href="{!! route('rol-usuarios.index') !!}" class="btn  btn-primary">Cancelar</a>
</div><div><span class="help-block" id="error"></span></div></div>

{{-- <datalist id="usuarios">  

</datalist>   --}}