<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar Plato
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
  				<input type="text" name="price" value="{{$menu->price}}" required="" class="price_mask">
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


        <div class="button">
          <center>
            <button type="submit" name="button">
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
