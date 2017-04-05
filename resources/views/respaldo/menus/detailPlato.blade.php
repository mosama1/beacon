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
      <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"  action="{{ route('update_plate', $menu_id) }}">
        {{ csrf_field() }}

        <input type="hidden" name="_method" value="PUT">

        <div class="input no_icon textarea {{ $errors->has('description') ? 'error' : '' }}">
          <textarea name="description" rows="8" cols="80">{{$plate->plate_translation->description}}</textarea>
          <label for="">
            <span class="text">Descripción</span>
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
            <input type="file" name="plato" id="addPlato" value="{{$plate->img}}">
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
            <div class="img active" id="vista_plato">
              <img src="{{asset($plate->img)}}" alt="">
            </div>
          </center>
        </div>

        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Guardar</span>
            </button>
            <a href="{{ route('show_menu', array('section_id' => $section_id, 'menu_id' => $menu_id)) }}" class="">
              <span>Cancelar</span>
            </a>
          </center>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection