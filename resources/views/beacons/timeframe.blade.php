<?php $nivel = '../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Timeframe
      </h3>
    </div>
    <div class="agregar">
      <center>
        <a href="{{ route('add_timeframe') }}" class="waves-effect">
          <div class="">
            <span class="text">Agregar <br><strong>Timeframe</strong></span>
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
                  <th data-field="description">Descripcion</th>
                  <th data-field="city">Hora de inicio</th>
                  <th data-field="street">Hora de Finalizaci&oacute;n</th>
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
                  <td><a href="#eliminarHorario"><i class="material-icons">clear</i></a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="eliminarHorario" class="modal modal_">

  <div class="titulo">
    <h3>
      Esta seguro que desea eliminar este horario
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
          <a href="#" class="" onclick="$('#eliminarHorario').modal('close'); return false;">
            <span>No</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>

@endsection
