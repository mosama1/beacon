<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar Idioma
      </h3>
    </div>

    <div class="form">
      @if (session('status'))
         <span class="help-block">
           <strong>{{ session('status') }}</strong>
         </span>
       @endif
       <form class="form-horizontal" role="form" method="POST" action="#">
        {{ csrf_field() }}

        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
  				<input type="text" name="name" value="" required="">
  				<label for="">
  					<!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
  					<span class="text">Nombre</span>
  				</label>
  				@if ($errors->has('name'))
  					<span class="error_input">
  							<strong>{{ $errors->first('name') }}</strong>
  					</span>
  				@endif
  			</div>

  			<div class="input select no_icon {{ $errors->has('type') ? 'error' : '' }}">
  				<!-- <img src="img/icons/idioma.png" alt="" class="icon"> -->
  				<select id="type" class="form-control icons" name="type">

  				@if( !empty($type_plates) )
            <option value="" disabled selected>Seleccion un tipo de plato</option>
  					@foreach ($type_plates as $type_plate)
  						<option value="{{$type_plate->id}}">{{$type_plate->name}}</option>
  					@endforeach
  				@else
  					<option value="" disabled selected>No hay tipos de platos registrados</option>
  				@endif
  				</select>

  				@if ($errors->has('type'))
  				<span class="error_input">
  					<strong>{{ $errors->first('type') }}</strong>
  				</span>
  				@endif
  			</div>

  			<div class="input no_icon {{ $errors->has('price') ? 'error' : '' }}">
  				<input type="number" name="price" value="" required=""  max="99999" step="any">
  				<label for="">
  					<!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
  					<span class="text">Precio</span>
  				</label>
  				@if ($errors->has('price'))
  					<span class="error_input">
  							<strong>{{ $errors->first('price') }}</strong>
  					</span>
  				@endif
  			</div>


        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Guardar</span>
            </button>
            <a href="{{ URL::previous() }}" class="">
              <span>Cancelar</span>
            </a>
          </center>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection
