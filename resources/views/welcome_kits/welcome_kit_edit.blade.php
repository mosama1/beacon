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

       <form class="form-horizontal" role="form" method="POST" action="{{ route('update_welcome_kit', $welcome_kit->promotion_id) }}">
         {{ csrf_field() }}
         {{ method_field('PUT') }}

         <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
           <input type="text" name="name" value="" required="">
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
           <textarea name="description" rows="8" cols="80" ></textarea>
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
         <div class="input no_icon {{ $errors->has('start_time') ? 'error' : '' }}">
           <input type="text" name="start_time" value="" required="" class="datetimepicker date_mask">
           <label for="">
             <span class="text">Inicio (dd/mm/yy hh:mm)</span>
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
         @if ($errors->has('start_time'))
           <div class="input_error">
               <span>{{ $errors->first('start_time') }}</span>
           </div>
         @endif

         <div class="input no_icon {{ $errors->has('end_time') ? 'error' : '' }}">
           <input type="text" name="end_time" value="" required="" class="datetimepicker date_mask">
           <label for="">
             <span class="text">Final (dd/mm/yy hh:mm)</span>
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
         @if ($errors->has('end_time'))
           <div class="input_error">
               <span>{{ $errors->first('end_time') }}</span>
           </div>
         @endif

         <div class="input no_icon {{ $errors->has('num_visit') ? 'error' : '' }}">
           <input type="text" name="number_visits" value="" required="" class="num_mask">
           <label for="">
             <span class="text">Numero de Visitas</span>
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
               <!-- <a href="#" class="vistaPreviaImg"> -->
                 <div class="img" id="vista_kit_b">
                 </div>
               <!-- </a> -->

             </center>
           </div>
         </div>




         <div class="button">
           <center>
             <button type="submit" name="button" id="guardar">
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
