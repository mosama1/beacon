<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar Tipo de Plato
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
          <input type="text" name="name" value="{{$tipo_plato->name}}" required="">
          <label for="">
            <span class="text">Nombre</span>
          </label>
          @if ($errors->has('name'))
            <span class="error_input">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
        </div>

        <div class="input no_icon {{ $errors->has('description') ? 'error' : '' }}">
          <input type="text" name="description" value="{{$tipo_plato->description}}" required="">
          <label for="">
            <span class="text">Descripción</span>
          </label>
          @if ($errors->has('description'))
            <span class="error_input">
                <strong>{{ $errors->first('description') }}</strong>
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
