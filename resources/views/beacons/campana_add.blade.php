<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Agregar Planificacion
      </h3>
    </div>

    <div class="form">
      @if (session('status'))
        <span class="help-block">
          <strong>{{ session('status') }}</strong>
        </span>
      @endif
      <form class="form-horizontal" role="form" method="POST" action="{{ route('store_campana') }}">
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
        <div class="input no_icon {{ $errors->has('description') ? 'error' : '' }}">
          <input type="text" name="description" value="" required="">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Descripcion</span>
          </label>
          @if ($errors->has('description'))
            <span class="error_input">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
          @endif
        </div>

        <div class="input select {{ $errors->has('location_id') ? 'error' : '' }}">
          <!-- <img src="img/icons/idioma.png" alt="" class="icon"> -->
          <select id="location_id" class="form-control icons" name="location_id" required>
            <option value="" disabled selected>Seleccione una ubica&oacute;n</option>
            @foreach($locations as $location)
                <option value="{{$location->location_id}}">{{$location->name}}</option>
            @endforeach
          </select>

          @if ($errors->has('location_id'))
          <span class="error_input">
            <strong>{{ $errors->first('location_id') }}</strong>
          </span>
          @endif
        </div>

        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Guardar</span>
            </button>
            <a href="{{ route('show_campana') }}" class="">
              <span>Cancelar</span>
            </a>
          </center>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection
