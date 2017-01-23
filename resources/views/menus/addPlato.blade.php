<?php $nivel = '../../' ?>
@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Descripción del Platos
      </h3>
    </div>

    <div class="form">
      @if (session('status'))
        <span class="help-block">
          <strong>{{ session('status') }}</strong>
        </span>
      @endif
      <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"  action="{{ route('store_plate', $menu_id) }}">
        {{ csrf_field() }}
        <input type="hidden" name="menu_id" value="{{$menu_id}}" required>


        <div class="input no_icon textarea {{ $errors->has('description') ? 'error' : '' }}">
          <!-- <input type="text" name="description" value="" required=""> -->
          <textarea name="description" rows="8" cols="80"></textarea>
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Descripción (Opcional)</span>
          </label>
          @if ($errors->has('description'))
          <span class="error_input">
            <strong>{{ $errors->first('description') }}</strong>
          </span>
          @endif
        </div>

        <div class="file-field input-field input_file {{ $errors->has('plato') ? 'has-error' : '' }}">
          <div class="btn">
            <span class="icon"><img src="img/icons/subir_archivo.png" alt=""></span>
            <span>Plato</span>
            <input type="file" name="plato" id="addPlato">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
          @if ($errors->has('plato'))
          <span class="error_input">
            <strong>{{ $errors->first('plato') }}</strong>
          </span>
          @endif
        </div>

        <div class="vista_previa">
          <center  id="vista_previa">
            <div class="img" id="vista_plato">

            </div>
          </center>
        </div>
        <!-- vista_previa -->




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
