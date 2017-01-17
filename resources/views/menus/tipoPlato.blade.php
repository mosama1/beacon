<?php $nivel = '../../'?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Tipos de Platos
      </h3>
    </div>

    <div class="agregar">
      <center>
        <a href="#tipoPlato" class="waves-effect">
          <div class="">
            <span class="text">Agregar <br><strong>Tipos<br>de Platos</strong></span>
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
                <th data-field="tipo">Tipo</th>
                <th data-field="id">Editar</th>
                <th data-field="name">Eliminar</th>
              </tr>
            </thead>

            <tbody>
              <tr id=''>
                <td>Nonbre</td>
                <td>Descripcion</td>
                <td><a href="{{ route('show_tipoPlatoEdit')}}"><i class="material-icons">edit</i></a></td>
                <td><a href="#eliminarTipoPlato" onclick=""><i class="material-icons">clear</i></a></td>
              </tr>
              <tr id=''>
                <td>Nonbre</td>
                <td>Descripcion</td>
                <td><a href="{{ route('show_tipoPlatoEdit')}}"><i class="material-icons">edit</i></a></td>
                <td><a href="#eliminarTipoPlato" onclick=""><i class="material-icons">clear</i></a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="tipoPlato" class="modal modal_">
  <div class="titulo">
    <h3>
      Agregar Plato
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('store_menu') }}">
      {{ csrf_field() }}
      <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
        <input type="text" name="name" value="" required="">
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
        <input type="text" name="description" value="" required="">
        <label for="">
          <span class="text">Descripcion</span>
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
          <a href="#" class="" onclick="$('#tipoPlato').modal('close'); return false;">
            <span>Cancelar</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>
<div id="eliminarTipoPlato" class="modal modal_">

  <div class="titulo">
    <h3>
      Esta seguro que desea eliminar el tipo de plato
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('store_menu') }}">
      {{ csrf_field() }}
      <div class="button">
        <center>
          <button type="submit" name="button">
            <span>Si</span>
          </button>
          <a href="#" class="" onclick="$('#eliminarTipoPlato').modal('close'); return false;">
            <span>No</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>

@endsection
