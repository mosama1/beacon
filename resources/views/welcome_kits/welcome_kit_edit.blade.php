<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')


<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar Kit de Bienvenida
      </h3>
    </div>
    <div class="form">
      @if (session('status'))
         <span class="help-block">
           <strong>{{ session('status') }}</strong>
         </span>
       @endif

       <form class="form-horizontal form_send" role="form" method="POST" action="{{ route('update_welcome_kit', $welcome_kit->promotion_id) }}" enctype="multipart/form-data">
         {{ csrf_field() }}
         {{ method_field('PUT') }}

         <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
           <input type="text" name="name" value="{{$welcome_kit->name}}" required="">
           <label for="">
             <span class="text">Nombre</span>
           </label>
           <div class="help">
             <a href="#">
               <i class="material-icons">help_outline</i>
             </a>
             <div class="inf none hidden">
               <p>
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
               </p>
             </div>
           </div>
         </div>
         @if ($errors->has('name'))
           <div class="input_error">
               <span>{{ $errors->first('name') }}</span>
           </div>
         @endif
         <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
           <textarea name="description" rows="8" cols="80" >{{$welcome_kit->description}}</textarea>
           <label for="">
             <span class="text">Descripción (Opcional)</span>
           </label>
           <div class="help">
             <a href="#">
               <i class="material-icons">help_outline</i>
             </a>
             <div class="inf none hidden">
               <p>
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
               </p>
             </div>
           </div>
         </div>
         @if ($errors->has('description'))
           <div class="input_error">
               <span>{{ $errors->first('description') }}</span>
           </div>
         @endif


         <div class="input no_icon {{ $errors->has('num_visit') ? 'error' : '' }}">
           <input type="text" name="number_visits" value="{{$welcome_kit->number_visits}}" required="" class="num_mask">
           <label for="">
             <span class="text">Número de Visitas</span>
           </label>
           <div class="help">
             <a href="#">
               <i class="material-icons">help_outline</i>
             </a>
             <div class="inf none hidden">
               <p>
                 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
               </p>
             </div>
           </div>
         </div>
         @if ($errors->has('num_visit'))
           <div class="input_error">
               <span>{{ $errors->first('num_visit') }}</span>
           </div>
         @endif

          <!-- Mensaje de la promoción -->
          <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="message" value="{{$welcome_kit->message}}">
          <label for="">
            <span class="text">Mensaje Promoción</span>
          </label>
          <div class="help">
            <a href="#">
            <i class="material-icons">help_outline</i>
            </a>
            <div class="inf none hidden">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
            </p>
            </div>
          </div>
          </div>
          @if ($errors->has('name'))
          <div class="input_error">
            <span>{{ $errors->first('name') }}</span>
          </div>
          @endif         

          <!--
         <div class="divide_cont files">
           <div class="file-field input-field input_file {{ $errors->has('img') ? 'has-error' : '' }}">
             <div class="btn">
               <span class="icon"><img src="img/icons/subir_archivo.png" alt=""></span>
               <span>Subir Imagen de promoción</span>
               <input type="file" name="img" id="addKit_b">
             </div>
             <div class="file-path-wrapper">
               <input class="file-path validate" type="text">
             </div>
             <div class="help">
               <a href="#">
                 <i class="material-icons">help_outline</i>
               </a>
               <div class="inf none hidden">
                 <p>
                   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                 </p>
               </div>
             </div>
           </div>
           @if ($errors->has('img'))
           <div class="error_input">
             <span>{{ $errors->first('img') }}</span>
           </div>
           @endif
           <div class="vista_previa">
             <center  id="vista_previa">
                 <div class="img active" id="vista_kit_b">
                   <img src="{{ $welcome_kit->img }}" alt="">
                 </div>
             </center>
           </div>
         </div>
         -->

         <div class="button">
           <center>
             <button type="submit" name="button" id="guardar" class="send_form">
               <span>Guardar</span>
             </button>
             <a href="{{ route('all_welcome_kit') }}" class="">
               <span>Cancelar</span>
             </a>
           </center>
         </div>
       </form>

    </div>
  </div>
</div>

@endsection
