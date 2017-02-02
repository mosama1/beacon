<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar Sección
      </h3>
    </div>

    <div class="form">
      @if (session('status'))
         <span class="help-block">
           <strong>{{ session('status') }}</strong>
         </span>
       @endif
       <form class="form-horizontal" role="form" method="POST" action="{{ route( 'update_section', $section->id ) }}">
        {{ csrf_field() }}

        {{ method_field('PUT') }}

        <input type="hidden" name="coupon_id" value="{{ $coupon_id }}">
        <input type="hidden" name="language_id" value="1">

        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="name" value="{{ $section->section_translation[0]->name }}" required="">
          <label for="">
            <span class="text">Nombre</span>
          </label>
        </div>
        @if ($errors->has('name'))
        <div class="input_error">
          <span>{{ $errors->first('name') }}</span>
        </div>
        @endif

        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}" id="divPrecioCarta" style="{{($coupon->price != 0) ? 'display: block' : ''}}">
          <input type="number" name="price" step="0.01" min="0" value="{{($coupon->price != 0) ? $coupon->price : ''}}"  id="price" min="1.00">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Ingresar Precio: 0,00</span>
          </label>
        </div>
        <div class="input_error" id="errorPrecioCarta" style="display: none;">
            <span>El monto debe ser mayor a cero</span>
        </div>
          <p>
        <input type="checkbox" class="filled-in" id="filled-in-box" {{($coupon->price != 0) ? 'checked' : ''}}/>
        <label for="filled-in-box">Manejar Precio</label>
          </p>



        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Guardar</span>
            </button>
            <a href="{{ route( 'all_section', $coupon_id ) }}" class="">
              <span>Cancelar</span>
            </a>
          </center>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection
