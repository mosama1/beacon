<?php $nivel = '../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Horarios
      </h3>
    </div>
    <div class="agregar">
      <center>
        <a href="#agregarHorario" class="waves-effect">
          <div class="">
            <span class="text">Agregar <br><strong>Horario</strong></span>
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
                  <th data-field="id">Nombre</th>
                  <th data-field="description">Descripción</th>
                  <th data-field="city">Hora de inicio</th>
                  <th data-field="street">Hora de Finalización</th>
                  <th>Editar</th>
                  <th>Eliminar</th>
              </tr>
            </thead>

            <tbody>
              @foreach($timeframe as $t)
                <tr id="{{$t->timeframe_id}}">
                  <td>{{$t->name}}</td>
                  <td>{{$t->description}}</td>
                  <td>{{date("h:i a", strtotime($t->start_time))}}</td>
                  <td>{{date("h:i a", strtotime($t->end_time))}}</td>
                  <td><a href="{{ route('edit_timeframe', $t->timeframe_id) }}"><i class="material-icons">edit</i></a></td>
                <?php

                  echo "<td onclick= \"modal_activate('".
                     route( "destroy_timeframe", $t->timeframe_id ).
                    "' , '#eliminarHorario')\" >";

                ?>
                  <a href="#eliminarHorario"><i class="material-icons">clear</i></a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>



<div id="agregarHorario" class="modal modal_">
  <div class="titulo">
    <h3>
      Agregar Horario
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('store_timeframe') }}">
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
      <div class="input no_icon {{ $errors->has('description') ? 'error' : '' }}">
        <input type="text" name="description" value="">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Descripción (Opcional)</span>
        </label>
      </div>
      @if ($errors->has('description'))
        <div class="input_error">
            <span>{{ $errors->first('description') }}</span>
        </div>
      @endif
      <div class="input no_icon {{ $errors->has('start_time') ? 'error' : '' }} time">
        <input type="time" name="start_time" value="" required="" class="input_time">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Hora de inicio (hh:mm am/pm)</span>
        </label>
      </div>
      @if ($errors->has('start_time'))
        <div class="input_error">
            <span>{{ $errors->first('start_time') }}</span>
        </div>
      @endif
      <div class="input no_icon {{ $errors->has('end_time') ? 'error' : '' }} time">
        <input type="time" name="end_time" value="" required="" class="input_time">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Hora de finalización (hh:mm am/pm)</span>
        </label>
      </div>
      @if ($errors->has('end_time'))
        <div class="input_error">
            <span>{{ $errors->first('end_time') }}</span>
        </div>
      @endif




      <div class="button">
        <center>
          <button type="submit" name="button" id="guardar">
            <span>Guardar</span>
          </button>
          <a href="#" class="" onclick="$('#agregarHorario').modal('close'); return false;">
            <span>Cancelar</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>
<div id="eliminarHorario" class="modal modal_">

  <div class="titulo">
    <h3>
      Esta seguro que desea eliminar este horario
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
          <a href="#" class="" onclick="$('#eliminarHorario').modal('close'); return false;">
            <span>No</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>

@endsection
