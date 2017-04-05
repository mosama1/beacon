<?php

use Beacon\Language;
use Beacon\LanguageUser;
$nivel = '../../'
?>

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
       <form class="form-horizontal form_send" role="form" method="POST" action="{{ route( 'update_section', $section->id ) }}">
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

        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}" id="divPrecioCarta" style="display: {{ (!empty($section->price)  ?  'block;' : '') }}" >
          <input type="number" name="price" step="0.01" min="0" value="{{ $section->price }}"  id="price" min="0.00"  onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)">

          <label for="">
            <span class="text"></span>
          </label>
          <div class="help">
            <a href="#">
              <i class="material-icons">help_outline</i>
            </a>
            <div class="inf none hidden">
              <p>
                Se debe seleccionar, cuando el precio es por la sección y no por plato (ejemplo el menú del día).
              </p>
            </div>
          </div>
        </div>
        <div class="input_error" id="errorPrecioCarta" style="display: none;">
            <span>El monto debe ser mayor a cero</span>
        </div>

        <p>
          <input type="checkbox"  {{ ($section->price > 0  ? 'checked' : '') }} class="filled-in" id="filled-in-box" />
          <label for="filled-in-box">Manejar Precio</label>
        </p>


        <div class="languages ppal">

            @for ($i = 1; $i < count($section->section_translation); $i++)
               @php
                   $language_user = LanguageUser::where([
                       ['language_id', '=', $section->section_translation[$i]->language_id],
                       ['user_id', '=', Auth::user()->user_id],
                       ['status', '=', 1],
                 ])->first();
               @endphp
               @if($language_user)
                   @php
                       $language = Language::where([
                           ['id', '=', $language_user->language_id],
                     ])->first();
                   @endphp
                   <div class="titulo">
                       <h5>
                           <img src="{{$language->icon}}" alt="" width="30px"> {{$language->name}}
                       </h5>
                   </div>
                   <input type="hidden" name="language_ids[]" value="{{$section->section_translation[$i]->language_id}}">
                   <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
                     <input type="text" name="language_name[]" value="{{ $section->section_translation[$i]->name }}" required="">
                     <label for="">
                       <span class="text">Nombre</span>
                     </label>
                   </div>
                   @if ($errors->has('name'))
                   <div class="input_error">
                     <span>{{ $errors->first('name') }}</span>
                   </div>
                   @endif

               @endif
            @endfor
        </div>

        <div class="button">
          <center>
            <button type="submit" name="button" id="guardar" class="send_form">
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
