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

        <input type="hidden" name="_method" value="PUT">


        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="name" value="IdiomaDB" required="">
          <label for="">
            <span class="text">Idioma</span>
          </label>
          @if ($errors->has('name'))
            <span class="error_input">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
        </div>

        <div class="input no_icon {{ $errors->has('abreb') ? 'error' : '' }}">
          <input type="text" name="abreb" value="IdiomaDB" required="">
          <label for="">
            <span class="text">Abreviatura</span>
          </label>
          @if ($errors->has('abreb'))
            <span class="error_input">
                <strong>{{ $errors->first('abreb') }}</strong>
            </span>
          @endif
        </div>
        <div class="checkbox">
          <input type="checkbox" class="filled-in" id="filled-in-box" />
          <label for="filled-in-box">Habilitar</label>
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