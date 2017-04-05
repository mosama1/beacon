<?php $nivel = '../../../' ?>
@extends('layouts.app')

@section('content')
<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar ubicación
      </h3>
    </div>

    <div class="form">
      @if (session('status'))
         <span class="help-block">
           <strong>{{ session('status') }}</strong>
         </span>
       @endif
       <form class="form-horizontal" role="form" method="POST" action="{{ route('location_update', $location->location_id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}


        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="name" value="{{$location->name}}" required="">
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
          <input type="text" name="city" value="{{$location->city}}" required="">
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
          <input type="text" name="street" value="{{$location->street}}" required="">
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

        <div class="input no_icon {{ $errors->has('minor') ? 'error' : '' }}">
          <input type="text" name="minor" value="{{$location->street_number}}" required="">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Minor</span>
          </label>
        </div>
        @if ($errors->has('minor'))
          <div class="input_error">
              <span>{{ $errors->first('minor') }}</span>
          </div>
        @endif

        <div class="input no_icon {{ $errors->has('zip') ? 'error' : '' }}">
          <input type="text" name="zip" value="{{$location->zip}}" required="">
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
              <div class="img" id="vista_logo">
              </div>
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
</div>

@endsection
