@extends('layouts.app')
@section('title', 'Auditoria')

@section('content')
<section class="content-header">
  <h1>
    Auditoria
  </h1>
</section>
 <div class="content">
   <div class="box box-success">
     <div class="box-body">
       <div class="row">
         {!! Form::model($auditoria, ['route' => ['auditoria.update', $auditoria->id], 'method' => 'patch']) !!}
          @include('auditoria.fields')
         {!! Form::close() !!}
       </div>
     </div>
   </div>
 </div>
@endsection
