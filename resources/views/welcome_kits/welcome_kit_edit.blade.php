<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')


<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar Promoción
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


          <div class="input select no_icon _100 {{ $errors->has('type_promo') ? 'error' : '' }}">
            <select id="type_promo" class="form-control icons" name="type_promo" required>
              <option value="" disabled >Tipo de Promoción</option>
              <option value="1" {{ $welcome_kit->type == 1 ? 'selected':'' }} >Kit de Bienvenida</option>
              <option value="2" {{ $welcome_kit->type == 2 ? 'selected':'' }} >Kit de Fidelidad</option>       
            </select>
          </div>
          @if ($errors->has('type_promo'))
          <div class="input_error">
            <span>{{ $errors->first('type_promo') }}</span>
          </div>
          @endif

         <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
           <input type="text" name="name" value="{{$welcome_kit->name}}" required="">
           <label for="">
             <span class="text">Nombre</span>
           </label>
         </div>
         @if ($errors->has('name'))
           <div class="input_error">
               <span>{{ $errors->first('name') }}</span>
           </div>
         @endif

         <div class="input no_icon {{ $errors->has('num_visit') ? 'error' : '' }}">
           <input type="text" name="number_visits" value="{{$welcome_kit->number_visits}}" required="" class="num_mask">
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
    <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
      <textarea name="message" rows="8" cols="80" >{{$welcome_kit->message}}</textarea>
      <label for="">
        <span class="text">Mensaje de la Promoción (5 líneas máximo)</span>
      </label>
      </div>
      @if ($errors->has('description'))
    <div class="input_error">
      <span>{{ $errors->first('description') }}</span>
    </div>
      @endif       

          <div class="divide_cont files">
            <div class="file-field input-field input_file {{ $errors->has('imagenPromo') ? 'has-error' : '' }}">
              <div class="btn">
                <span class="icon"><img src="img/icons/subir_archivo.png" alt=""></span>
                <span>Subir Imagen Promo</span>
                <input type="file" name="imagenPromo" id="addImagenPromo">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" >
              </div>
              @if ($errors->has('imagenPromo'))
              <span class="input_error">
                <strong>{{ $errors->first('imagenPromo') }}</strong>
              </span>
              @endif
            </div>
            <div class="vista_previa">
              <center  id="vista_previa">
                <a href="#" class="vistaPreviaImg">
                  <div class="img active" id="vista_promo">
                    <img class="thumb" src="{{ asset($welcome_kit->imagenPromo) }}">
                  </div>
                </a>
              </center>
            </div>
            <div class="help">
              <a href="#">
                <i class="material-icons">help_outline</i>
              </a>
              <div class="inf none hidden">
                <p>
                  Por favor seleccione el imagenPromo del restaurante que quiere sea visto como imagen inicial en la aplicación del móvil y en la marquesina de la Web.
                </p>
              </div>
            </div>
          </div>


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
