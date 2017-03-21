<?php $nivel = '' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Promociones
      </h3>
    </div>
    <div class="agregar">
      <center>
        <a href="#agregarPlan" class="waves-effect">
          <div class="">
            <span class="text">Agregar <br>Promocion</span>
            <span class="icon"><i class="material-icons">add</i></span>
          </div>
        </a>
      </center>
    </div>
    <div class="beacons seccion">
      <div class="container">
        <div class="tabla">
          <table>
            <thead>
              <tr>
                  <th data-field="id">id</th>
                  <th data-field="id">Nombre</th>
                  <th data-field="country">Descripción</th>
                  <th width="100px">Contenido</th>
                  <th width="100px">Editar</th>
                  <th width="100px">Eliminar</th>
                  <th width="130px">Habilitado</th>
            </thead>

            <tbody>
              <tr id="id">
                <td>ejm</td>
                <td>ejm</td>
                <td>ejm</td>

                <td><a href="#"><i class="material-icons">add</i></a></td>
                <td><a href="#"><i class="material-icons">edit</i></a></td>
              <?php

                echo "<td onclick= \"modal_activate('".
                   route( "destroy_promotion",'#' ).
                  "' , '#eliminarPlan')\" >";

              ?>
                <a href="#eliminarPlan"><i class="material-icons">clear</i></a></td>
                <td>
                  <div class="switch">
                    <label>
                      Si
                      <input type="checkbox">
                      <span class="lever"></span>
                      No
                    </label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="agregarPlan" class="modal modal_">
  <div class="titulo">
    <h3>
      Agregar Promoción
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal form_send" role="form" method="POST" action="{{ route('store_promotion') }}">
      {{ csrf_field() }}

      <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
        <input type="text" name="name" value="" required="">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Nombre</span>
        </label>
      </div>
      @if ($errors->has('name'))
        <div class="input_error">
            <span>{{ $errors->first('name') }}</span>
        </div>
      @endif
      <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
        <textarea name="description" rows="8" cols="80" ></textarea>
        <label for="">
          <span class="text">Descripción (Opcional)</span>
        </label>
      </div>
      @if ($errors->has('description'))
        <div class="input_error">
            <span>{{ $errors->first('description') }}</span>
        </div>
      @endif

      <div class="input select no_icon {{ $errors->has('location_id') ? 'error' : '' }}">
        <!-- <img src="img/icons/idioma.png" alt="" class="icon"> -->
        <select id="location_id" class="form-control icons" name="location_id" required>
          <option value="" selected>Seleccione una ubicación</option>

        </select>

      </div>
      @if ($errors->has('location_id'))
      <div class="input_error">
        <span>{{ $errors->first('location_id') }}</span>
      </div>
      @endif

      <div class="button">
        <center>
          <button type="submit" name="button" id="guardar" class="send_form">
            <span>Guardar</span>
          </button>
          <a href="#" class="" onclick="$('#agregarPlan').modal('close'); return false;">
            <span>Cancelar</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>


<div id="eliminarPlan" class="modal modal_">
  <div class="titulo">
    <h3>
      Esta seguro que desea eliminar esta promoción
    </h3>
  </div>
  <div class="form">
    <form class="form-horizontal form_send" role="form" method="POST">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <div class="button">
        <center>
          <button type="submit" name="button" class="send_form">
            <span>Si</span>
          </button>
          <a href="#" class="" onclick="$('#eliminarPlan').modal('close'); return false;">
            <span>No</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>

@endsection
