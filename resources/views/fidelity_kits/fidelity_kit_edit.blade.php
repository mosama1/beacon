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

       <form class="form-horizontal" role="form" method="POST" action="{{ route('update_fidelity_kit', $fidelity_kit->promotion_id) }}" enctype="multipart/form-data">
         {{ csrf_field() }}
        {{ method_field('PUT') }}

         <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
           <input type="text" name="name" value="{{$fidelity_kit->name}}" required="">
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
           <textarea name="description" rows="8" cols="80" >{{$fidelity_kit->description}}</textarea>
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

         <div class="input no_icon {{ $errors->has('number_visits') ? 'error' : '' }}">
           <input type="text" name="number_visits" value="{{$fidelity_kit->number_visits}}" required="" class="num_mask">
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
         @if ($errors->has('number_visits'))
           <div class="input_error">
               <span>{{ $errors->first('number_visits') }}</span>
           </div>
         @endif

         <div class="divide_cont files">
           <div class="file-field input-field input_file {{ $errors->has('img') ? 'has-error' : '' }}">
             <div class="btn">
               <span class="icon"><img src="img/icons/subir_archivo.png" alt=""></span>
               <span>Subir Imagen de promoción</span>
               <input type="file" name="img" id="addKit_f">
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
                 <div class="img active" id="vista_kit_f">
                   <img class="thumb" src="{{ asset($fidelity_kit->img) }}">
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
