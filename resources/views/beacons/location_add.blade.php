<?php $nivel = '../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Agregar ubicación
      </h3>
    </div>

    <div class="form">
      <!-- @if (session('status'))
        <span class="help-block">
          <strong>{{ session('status') }}</strong>
        </span>
      @endif -->
      <form class="form-horizontal" role="form" method="POST" action="{{ route('store_locations') }}" enctype="multipart/form-data">
        {{ csrf_field() }}


        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="name" value="" required="" id="nombreEmpresa">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Name</span>
          </label>
        </div>
        @if ($errors->has('name'))
          <div class="input_error">
              <span>{{ $errors->first('name') }}</span>
          </div>
        @endif
        
        <div class="input no_icon {{ $errors->has('city') ? 'error' : '' }}">
          <input type="text" name="city" value="" required="">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">City</span>
          </label>
        </div>
        @if ($errors->has('city'))
          <div class="input_error">
              <span>{{ $errors->first('city') }}</span>
          </div>
        @endif

        <div class="input no_icon {{ $errors->has('street') ? 'error' : '' }}">
          <input type="text" name="street" value="" required="">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Street</span>
          </label>
        </div>
        @if ($errors->has('street'))
          <div class="input_error">
              <span>{{ $errors->first('street') }}</span>
          </div>
        @endif

        <div class="input no_icon {{ $errors->has('street_number') ? 'error' : '' }}">
          <input type="text" name="street_number" value="" required="">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Street Number</span>
          </label>
        </div>
        @if ($errors->has('street_number'))
          <div class="input_error">
              <span>{{ $errors->first('street_number') }}</span>
          </div>
        @endif

        <div class="input no_icon {{ $errors->has('zip') ? 'error' : '' }}">
          <input type="text" name="zip" value="" required="">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Zip</span>
          </label>
        </div>
        @if ($errors->has('zip'))
          <div class="input_error">
              <span>{{ $errors->first('zip') }}</span>
          </div>
        @endif
        <!-- <div class="input no_icon {{ $errors->has('lat') ? 'error' : '' }}">
          <input type="text" name="lat" value="" required="">
          <label for="">
            <span class="text">Lat</span>
          </label>
        </div>-->
        <!-- @if ($errors->has('lat'))
          <div class="input_error">
              <span>{{ $errors->first('lat') }}</span>
          </div>
        @endif -->
        <!-- <div class="input no_icon {{ $errors->has('lng') ? 'error' : '' }}">
          <input type="text" name="lng" value="" required="">
          <label for="">
            <span class="text">Lng</span>
          </label>
          @if ($errors->has('lng'))
            <span class="error_input">
                <strong>{{ $errors->first('lng') }}</strong>
            </span>
          @endif
        </div> -->
        <div class="divide_cont files">
          <div class="file-field input-field input_file {{ $errors->has('logo') ? 'has-error' : '' }}">
            <div class="btn">
              <span class="icon"><img src="img/icons/subir_archivo.png" alt=""></span>
              <span>Subir Logo</span>
              <input type="file" name="logo" id="addLogo">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
            @if ($errors->has('logo'))
            <span class="error_input">
              <strong>{{ $errors->first('logo') }}</strong>
            </span>
            @endif
          </div>
          <div class="vista_previa">
            <center  id="vista_previa">
              <a href="#" class="vistaPreviaImg">
                <div class="img" id="vista_logo">
                </div>
              </a>

            </center>
          </div>
        </div>
        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Guardar</span>
            </button>
            <a href="{{ route('location_beacons') }}" class="">
              <span>Cancelar</span>
            </a>
          </center>
        </div>
      </form>

    </div>
  </div>

@endsection
