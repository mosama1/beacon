<?php $nivel = '../' ?>
@extends('layouts.app')

@section('content')
  <div class="contenedor">
    <div class="principal">
      <div class="titulo">
        <h3>
          Beacons
        </h3>
      </div>
      <div class="agregar">
        <center>
          <a href="#agregarBeacon" class="waves-effect">
            <div class="">
              <span class="text">Agregar <br><strong>Beacon</strong></span>
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
                    <th data-field="country">Mayor</th>
                    <th data-field="city">Minior</th>
                    <th data-field="id">Eliminar</th>
                </tr>
              </thead>
              <tbody>
                @foreach($beacons as $b)
                  <tr>
                    <td>{{$b->major}}</td>
                    <td>{{$b->minor}}</td>
                <?php

                  echo "<td onclick= \"modal_activate('".
                     route( "beacon_destroy", $b->beacon_id ).
                    "' , '#eliminarBeacon')\" >";

                ?>
                  <a href="#eliminarBeacon"><i class="material-icons">clear</i></a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div id="agregarBeacon" class="modal modal_">
    <div class="titulo">
      <h3>
        Agregar Beacons
      </h3>
    </div>

    <div class="form">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('beacon_store_beacon') }}">
        {{ csrf_field() }}

        <div class="input no_icon {{ $errors->has('major') ? 'error' : '' }}">
          <input type="text" name="major" value="" required="">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Major</span>
          </label>
        </div>
        @if ($errors->has('major'))
          <div class="input_error">
              <span>{{ $errors->first('major') }}</span>
          </div>
        @endif
        <div class="input no_icon {{ $errors->has('minor') ? 'error' : '' }}">
          <input type="text" name="minor" value="" required="">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Minor</span>
          </label>
        </div>
        @if ($errors->has('minor'))
          <div class="input_error">
              <span>{{ $errors->first('minor') }}</span>
          </div>
        @endif
        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Guardar</span>
            </button>
            <a href="#" class="" onclick="$('#agregarBeacon').modal('close'); return false;">
              <span>Cancelar</span>
            </a>
          </center>
        </div>
      </form>
    </div>
  </div>

  <div id="eliminarBeacon" class="modal modal_">

    <div class="titulo">
      <h3>
        Esta seguro que desea eliminar este beacon
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
            <a href="#" class="" onclick="$('#eliminarBeacon').modal('close'); return false;">
              <span>No</span>
            </a>
          </center>
        </div>
      </form>
    </div>
  </div>

@endsection
