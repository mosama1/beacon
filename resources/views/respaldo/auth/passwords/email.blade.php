<?php $nivel = '../';?>
@extends('layouts.app')

<!-- Main Content -->
@section('content')

<div class="contenedor">
  <div class="section_ authenticate" id="recuperar">
    <!-- <div class="fondo_mitad fondo_recuperar"></div> -->
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
      {{ csrf_field() }}

      <div class="divide">
        <div class="titulo">
          <h5>Recuperar Contraseña</h5>
        </div>
        <div class="divide_cont">




          <div class="input {{ $errors->has('email') ? 'error' : '' }}">
            <input type="email" name="email" value="{{ old('email') }}" required="">
            <label for="">
              <span class="icon"><img src="img/icons/correo.png" alt=""></span>
              <span class="text">Correo</span>
            </label>
          </div>
          @if ($errors->has('email'))
          <div class="input_error">
            <span>{{ $errors->first('email') }}</span>
          </div>
          @endif
        </div>
        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Enviar</span>
            </button>
            <a href="{{ url('/login') }}" class="">
              <span>Cancelar</span>
            </a>
          </center>
        </div>
      </div>

    </form>



  </div>

</div>

@endsection
