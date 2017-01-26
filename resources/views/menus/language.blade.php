<?php $nivel = '../'?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Los Idiomas
      </h3>
    </div>

    <div class="agregar">
      <center>
        <a href="#crearIdioma" class="waves-effect">
          <div class="">
            <span class="text">Agregar <br><strong>Idioma</strong></span>
            <span class="icon"><i class="material-icons">add</i></span>
          </div>
        </a>
      </center>
    </div>

    <div class="beacons seccion">
      <div class="container">
        <div class="tabla">
          <table class="bordered centered">
            <thead>
              <tr>
                <th data-field="id">Nombre</th>
                <th data-field="id">Editar</th>
                <th data-field="name">Eliminar</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>Idioma</td>
                <td><a href="{{ route('edit_language', 1)}}"><i class="material-icons">edit</i></a></td>
                <td><a href="#eliminarIdioma"><i class="material-icons">clear</i></a></td>
              </tr>
              <tr>
                <td>Idioma</td>
                <td><a href="{{ route('edit_language', 1)}}"><i class="material-icons">edit</i></a></td>
                <td><a href="#eliminarIdioma"><i class="material-icons">clear</i></a></td>
              </tr>
              <tr>
                <td>Idioma</td>
                <td><a href="{{ route('edit_language', 1)}}"><i class="material-icons">edit</i></a></td>
                <td><a href="#eliminarIdioma"><i class="material-icons">clear</i></a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="crearIdioma" class="modal modal_">
  <div class="titulo">
    <h3>
      Agregar Idioma
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('create_tipoPlato') }}">
      {{ csrf_field() }}
      <!-- <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
        <input type="text" name="name" value="" required="">
        <label for="">
          <span class="text">Nombre</span>
        </label>
        @if ($errors->has('name'))
        <span class="error_input">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
      </div> -->
      <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
        <input type="text" name="name" value="" required="">
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
        <input type="text" name="abreb" value="" required="">
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
          <a href="#" class="" onclick="$('#crearIdioma').modal('close'); return false;">
            <span>Cancelar</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>
<div id="eliminarIdioma" class="modal modal_">

  <div class="titulo">
    <h3>
      Está seguro que desea eliminar Idioma
    </h3>
  </div>
  <div class="form">
    <form class="form-horizontal" role="form" method="POST">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <div class="button">
        <center>
          <button type="submit" name="button">
            <span>Si</span>
          </button>
          <a href="#" class="" onclick="$('#eliminarIdioma').modal('close'); return false;">
            <span>No</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>

@endsection
