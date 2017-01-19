<?php $nivel = '../'?>

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
                <th data-field="name">Idioma</th>
                <th data-field="name">Eliminar</th>
              </tr>
            </thead>

            <tbody>
            @foreach ($tiposplatos as $tipoplato)
              <tr>
                <td>{{$tipoplato->name}}</td>
                <td>{{$tipoplato->description}}</td>
                <td><a href="{{ route('edit_tipoPlato', $tipoplato->id) }}"><i class="material-icons">edit</i></a></td>

                <td><a href="#Idioma"><i class="material-icons">language</i></a></td>
                <?php

                  echo "<td onclick= \"modal_activate('".
                     route( "delete_tipoPlato", $tipoplato->id ).
                    "' , '#eliminarTipoPlato')\" >";

                ?>
                <a href="#eliminarTipoPlato"><i class="material-icons">clear</i></a></td>

              </tr>
            @endforeach
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
      Agregar Tipo de Plato
    </h3>
  </div>
  <div class="form">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('create_tipoPlato') }}">
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


<div id="Idioma" class="modal modal_">
  <div class="titulo">
    <h3>
      Idioma tipo de plato
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('create_tipoPlato') }}">
      {{ csrf_field() }}
      <div class="input select {{ $errors->has('type') ? 'error' : '' }}">
        <!-- <img src="img/icons/idioma.png" alt="" class="icon"> -->
        <select id="type" class="form-control icons" name="type" required>
          <option value="" disabled selected>Seleccione un Idioma</option>

          <option value="vegetariana">vegetariana</option>
          <option value="sin gluten">sin gluten</option>
          <option value="bja caloria">baja caloria</option>
          <option value="picante">picante</option>
        </select>

        @if ($errors->has('type'))
        <span class="error_input">
          <strong>{{ $errors->first('type') }}</strong>
        </span>
        @endif
      </div>
      <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
        <input type="text" name="name" value="" required="">
        <label for="">
          <span class="text">Traducción Nombre</span>
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
          <span class="text">Traducción Descripcion</span>
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
          <a href="#" class="" onclick="$('#Idioma').modal('close'); return false;">
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
      Está seguro que desea eliminar Tipo de Plato
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="DELETE">
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
