<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Contenidos
      </h3>
    </div>
    <div class="agregar">
      <center>
        <a href="#agregarContenido" class="waves-effect">
          <div class="">
            <span class="text">Agregar <br><strong>Contenido</strong></span>
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
                  <th data-field="id">Coupon</th>
                  <th data-field="country">Tag</th>
                  <th data-field="country">Horarios</th>
                  <th data-field="country">Trigger Name</th>
                  <th>Editar</th>
                  <th>Eliminar</th>
            </thead>

            <tbody>
              <tr id="9052">
                <td>La Cena</td>
                <td>Planificacion para la cena</td>
                <td>La Cena</td>
                <td>Planificacion para la cena</td>
                <td><a href="#"><i class="material-icons">edit</i></a></td>
                <td><a href="#eliminarContenido"><i class="material-icons">clear</i></a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="agregarContenido" class="modal modal_">
  <div class="titulo">
    <h3>
      Agregar Contenido
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST" action="#">
      {{ csrf_field() }}

      <input type="hidden" name="tigger_name_id" value="DWELL_TIME">




      <div class="input select no_icon {{ $errors->has('coupon_id') ? 'error' : '' }}">
        <select id="coupon_id" class="form-control icons" name="coupon_id" required>
          <option value="" disabled selected>Seleccione un Menú</option>
          @foreach($coupon as $c)
              <option value="{{$c->coupon_id}}">{{$c->name}}</option>
          @endforeach

        </select>
      </div>
      @if ($errors->has('coupon_id'))
      <div class="input_error">
        <span>{{ $errors->first('coupon_id') }}</span>
      </div>
      @endif


      <div class="input-field col s12">
        <select multiple>
          <option value="" disabled selected>Seleccione un Horario</option>
          @foreach($timeframes as $t)
              <option value="{{$t->timeframe_id}}">{{$t->name}}</option>
          @endforeach
        </select>
      </div>
      @if ($errors->has('timeframe_id'))
      <div class="input_error">
        <span>{{ $errors->first('timeframe_id') }}</span>
      </div>
      @endif

      <div class="input no_icon {{ $errors->has('xxxxxx') ? 'error' : '' }}">
        <input type="number" name="xxxxxx" min="0" value="" class="input_time number" required="true">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Minutos de espera</span>
        </label>
      </div>
      @if ($errors->has('xxxxxx'))
      <div class="input_error">
        <span>{{ $errors->first('xxxxxx') }}</span>
      </div>
      @endif

      <div class="button">
        <center>
          <button type="submit" name="button" id="guardar">
            <span>Guardar</span>
          </button>
          <a href="#" class="" onclick="$('#agregarContenido').modal('close'); return false;">
            <span>Cancelar</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>

<div id="eliminarContenido" class="modal modal_">

  <div class="titulo">
    <h3>
      Esta seguro que desea eliminar este contenido
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
          <a href="#" class="" onclick="$('#eliminarContenido').modal('close'); return false;">
            <span>No</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>

@endsection
