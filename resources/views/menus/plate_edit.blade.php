<?php

use Beacon\Language;
use Beacon\LanguageUser;
$nivel = '../../'
?>

@extends('layouts.app')

@section('content')

<script type="text/javascript">
function checkSubmit() {
    document.getElementById("guardar").value = "Enviando...";
    document.getElementById("guardar").disabled = true;
    return true;
}
</script>

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar Plato {{ $section->price }}
      </h3>
    </div>

    <div class="form">
      @if (session('status'))
         <span class="help-block">
           <strong>{{ session('status') }}</strong>
         </span>
       @endif
       <form class="form-horizontal" role="form" method="POST" action="{{ route( 'update_menu', $menu->id ) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
  				<input type="text" name="name" value="{{$menu->menu_translation[0]->name}}" required="">
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
        <div class="input select no_icon {{ $errors->has('type') ? 'error' : '' }}">
          <select id="type" class="form-control icons" name="type" @if(!isset($menu->type)) echo("selected") @endif >

  				@if( !empty($type_plates) )
            <option value="">Seleccion un tipo de plato</option>
  					@foreach ($type_plates as $type_plate)
  						<option value="{{$type_plate->id}}" @if($type_plate->id == $menu->type) echo(" selected ") @endif  >{{$type_plate->name}}</option>
  					@endforeach
  				@else
  					<option value="" disabled selected>No hay tipos de platos registrados</option>
  				@endif
  				</select>
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
        @if ($errors->has('type'))
        <div class="input_error">
          <span>{{ $errors->first('type') }}</span>
        </div>
        @endif

  			<div class="input no_icon {{ $errors->has('price') ? 'error' : '' }}">
  				<input type="text" name="price" value="{{ (!empty($section->price)) ? $section->price : $menu->price }}" required="" class="price_mask" {{ (!empty($section->price)) ? 'readonly' : '' }}>


  				<label for="">
  					<span class="text">Precio 0,00 €</span>
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
        @if ($errors->has('price'))
        <div class="input_error">
          <span>{{ $errors->first('price') }}</span>
        </div>
        @endif


        <div class="languages ppal">

            @for ($i = 1; $i < count($menu->menu_translation); $i++)
               @php
                   $language_user = LanguageUser::where([
                       ['language_id', '=', $menu->menu_translation[$i]->language_id],
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
                   <input type="hidden" name="language_id[]" value="{{$menu->menu_translation[$i]->language_id}}">
                   <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
                     <input type="text" name="language_name[]" value="{{ $menu->menu_translation[$i]->name }}" required="">
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
               @endif
            @endfor
        </div>



        <div class="button">
          <center>
            <button type="submit" name="button" id="guardar">
              <span>Guardar</span>
            </button>
            <a href="{{ route( 'all_menu', $menu->section_id ) }}" class="">
              <span>Cancelar</span>
            </a>
          </center>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection
