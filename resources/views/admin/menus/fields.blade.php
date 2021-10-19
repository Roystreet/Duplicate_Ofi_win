<!-- Menu Field -->
<div class="form-group">
  {!! Form::label('menu', 'Menú:') !!}
  <div class="input-group col-xs-12">
  {!! Form::text('menu', null, ['class' => 'form-control']) !!}
  </div>
  <div>
    <span class="help-block" id="error"></span>
  </div>
</div>

<!-- Section Field -->
<div class="form-group">
  {!! Form::label('section', 'Sección:') !!}
  <div class="input-group col-xs-12">
  {!! Form::select('section', $section, null, ['id'=>'section', 'placeholder' => 'Seleccione...',  'class'=>'form-control select2', 'style'=>'width: 100%',  ] ) !!}
  </div>
  <div>
    <span class="help-block" id="error"></span>
  </div>
</div>

<!-- Path Field -->
<div class="form-group">
  {!! Form::label('path', 'URL:') !!}
  <div class="input-group col-xs-12">
  {!! Form::text('path', null, ['class' => 'form-control']) !!}
  </div>
  <div>
    <span class="help-block" id="error"></span>
  </div>
</div>

<!-- Icon Field -->
<div class="form-group">
  {!! Form::label('icon', 'Icono:') !!}
  <div class="input-group col-xs-12">
  {!! Form::text('icon', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Note Field -->
<div class="form-group">
  {!! Form::label('orden', 'Orden:') !!}
  <div class="input-group col-xs-12">
  {!! Form::text('orden', null, ['class' => 'form-control']) !!}
</div><div><span class="help-block" id="error"></span></div></div>

<!-- Modified By Field -->
{!! Form::hidden('modified_by', null, ['class' => 'form-control']) !!}

<!-- Submit Field -->
<div class="form-group col-xs-12">
<div class="input-group col-xs-6">
  {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-block ']) !!}
  <a href="{!! route('menus.index') !!}" class="btn btn-primary btn-block ">Cancelar</a>
</div>
<div class="input-group col-xs-6">
  {{-- <a href="{!! route('menus.index') !!}" class="btn btn-primary btn-block ">Cancelar</a> --}}
</div>

<div>
  <span class="help-block" id="error"></span>
</div>
</div>
