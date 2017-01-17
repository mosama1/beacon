<?php $nivel = '../' ?>
@extends('layouts.app')

@section('content')
<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Agregar Beacons
      </h3>
    </div>

    <div class="form">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('beacon_store_beacon') }}">
        {{ csrf_field() }}


        <div class="input no_icon {{ $errors->has('major') ? 'error' : '' }}">
          <input type="text" name="major" value="" required="">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Major</span>
          </label>
        </div>
        @if ($errors->has('major'))
          <div class="input_error">
              <span>{{ $errors->first('major') }}</span>
          </div>
        @endif
        <div class="input no_icon {{ $errors->has('minor') ? 'error' : '' }}">
          <input type="text" name="minor" value="" required="">
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
        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Guardar</span>
            </button>
            <a href="{{ route('list_beacons') }}" class="">
              <span>Cancelar</span>
            </a>
          </center>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection
