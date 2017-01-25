<?php $nivel = '../../' ?>

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
       <form class="form-horizontal" role="form" method="POST" action="{{ route('update_coupon', $coupon->coupon_id ) }}">
         {{ csrf_field() }}
         {{ method_field('PUT') }}

         <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
           <input type="text" name="name" value="{{ $coupon->coupon_translation[0]->name }}" required="">
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
           <textarea name="description" rows="8" cols="80"> {{ $coupon->coupon_translation[0]->description }}</textarea>
           <label for="">
             <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
             <span class="text">Descripción (Opcional)</span>
           </label>
         </div>
         @if ($errors->has('description'))
           <div class="input_error">
               <span>{{ $errors->first('description') }}</span>
           </div>
         @endif
         <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}" id="divPrecioMenu">
           <input type="number" name="price" step="0.01" min="0" value="{{ $coupon->price }}"  id="price" min="1.00">
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
