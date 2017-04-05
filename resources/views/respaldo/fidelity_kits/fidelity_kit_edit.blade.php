<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')


<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar Kit de Fidelidad
      </h3>
    </div>
    <div class="form">
      @if (session('status'))
         <span class="help-block">
           <strong>{{ session('status') }}</strong>
         </span>
       @endif

       <form class="form-horizontal form_send" role="form" method="POST" action="{{ route('update_fidelity_kit', $fidelity_kit->promotion_id) }}" enctype="multipart/form-data">
         {{ csrf_field() }}
         {{ method_field('PUT') }}

         <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
           <input type="text" name="name" value="{{$fidelity_kit->name}}" required="">
           <label for="">
             <span class="text">Nombre</span>
           </label>
         </div>
         @if ($errors->has('name'))
           <div class="input_error">
               <span>{{ $errors->first('name') }}</span>
           </div>
         @endif
         <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
           <textarea name="description" rows="8" cols="80" >{{$fidelity_kit->description}}</textarea>
           <label for="">
             <span class="text">Descripción (Opcional)</span>
           </label>
         </div>
         @if ($errors->has('description'))
           <div class="input_error">
               <span>{{ $errors->first('description') }}</span>
           </div>
         @endif


         <div class="input no_icon {{ $errors->has('num_visit') ? 'error' : '' }}">
           <input type="text" name="number_visits" value="{{$fidelity_kit->number_visits}}" required="" class="num_mask">
           <label for="">
             <span class="text">Número de Visitas</span>
           </label>
         </div>
         @if ($errors->has('num_visit'))
           <div class="input_error">
               <span>{{ $errors->first('num_visit') }}</span>
           </div>
         @endif

          <!-- Mensaje de la promoción -->
          <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="message" value="{{$fidelity_kit->message}}">
          <label for="">
            <span class="text">Mensaje Promoción</span>
          </label>
          </div>
          @if ($errors->has('name'))
          <div class="input_error">
            <span>{{ $errors->first('name') }}</span>
          </div>
          @endif         
          <div class="button">
           <center>
             <button type="submit" name="button" id="guardar" class="send_form">
               <span>Guardar</span>
             </button>
             <a href="{{ route('all_fidelity_kit') }}" class="">
               <span>Cancelar</span>
             </a>
           </center>
         </div>
       </form>

    </div>
  </div>
</div>

@endsection
