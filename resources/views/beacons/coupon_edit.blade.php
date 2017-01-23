<?php $nivel = '../../../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar Menu
      </h3>
    </div>

    <div class="form">
      @if (session('status'))
         <span class="help-block">
           <strong>{{ session('status') }}</strong>
         </span>
       @endif
       <form class="form-horizontal" role="form" method="POST" action="{{ route('store_coupon') }}">
         {{ csrf_field() }}

         <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
           <input type="text" name="name" value="" required="">
           <label for="">
             <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
             <span class="text">Nombre</span>
           </label>
         </div>
         @if ($errors->has('name'))
           <div class="input_error">
               <span>{{ $errors->first('name') }}</span>
           </div>
         @endif

         <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
           <!-- <input type="text" name="description" value="" required=""> -->
           <textarea name="description" rows="8" cols="80" required=""></textarea>
           <label for="">
             <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
             <span class="text">Descripción</span>
           </label>
         </div>
         @if ($errors->has('description'))
           <div class="input_error">
               <span>{{ $errors->first('description') }}</span>
           </div>
         @endif
         <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}" id="divPrecioMenu">
           <input type="number" name="price" step="0.01" min="0" value="0"  id="price" min="1.00">
           <label for="">
             <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
             <span class="text">Ingresar Precio: 0,00</span>
           </label>
         </div>
         <div class="input_error" id="errorPrecioMenu" style="display: none;">
             <span>El monto debe ser mayor a cero</span>
         </div>
           <p>
         <input type="checkbox" class="filled-in" id="filled-in-box" />
         <label for="filled-in-box">Manejar Precio</label>
           </p>
         <!-- <label><input type="checkbox" id="cbox1" value="first_checkbox"> Este es mi primer checkbox</label><br> -->

         <div class="button">
           <center>
             <button type="submit" name="button" id="guardar">
               <span>Guardar</span>
             </button>
             <a href="#" class="" onclick="$('#agregarMenu').modal('close'); return false;">
               <span>Cancelar</span>
             </a>
           </center>
         </div>
       </form>

    </div>
  </div>
</div>

@endsection
