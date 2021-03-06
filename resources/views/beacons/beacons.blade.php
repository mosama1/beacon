<?php
    $nivel = '';
    $actual = 'beacons';
 ?>
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
                    <th data-field="id" width="100px">Eliminar</th>
                </tr>
              </thead>
              <tbody>
                @foreach($beacons as $b)
                  <tr>
                    <td>{{$b->major}}</td>
                    <td>{{$b->minor}}</td>
                <?php

                  echo "<td onclick= \"modal_activate('".
                     route( "destroy_beacon", $b->beacon_id ).
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
      <form class="form-horizontal form_send" role="form" method="POST" action="{{ route('store_beacon') }}" id="add_beacon">
        {{ csrf_field() }}

        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="name" value="" required="">
          <label for="">
            <span class="text">Nombre</span>
          </label>
          <div class="help">
            <a href="#">
              <i class="material-icons">help_outline</i>
            </a>
            <div class="inf none hidden">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
              </p>
            </div>
          </div>
        </div>
        @if ($errors->has('name'))
          <div class="input_error">
              <span>{{ $errors->first('name') }}</span>
          </div>
        @endif

        <div class="input no_icon {{ $errors->has('major') ? 'error' : '' }}">
          <input type="text" name="major" value="" required="">
          <label for="">
            <span class="text">Major</span>
          </label>
          <div class="help">
            <a href="#">
              <i class="material-icons">help_outline</i>
            </a>
            <div class="inf none hidden">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
              </p>
            </div>
          </div>
        </div>
        @if ($errors->has('major'))
          <div class="input_error">
              <span>{{ $errors->first('major') }}</span>
          </div>
        @endif
        <div class="input no_icon {{ $errors->has('minor') ? 'error' : '' }}">
          <input type="text" name="minor" value="" required="">
          <label for="">
            <span class="text">Minor</span>
          </label>
          <div class="help">
            <a href="#">
              <i class="material-icons">help_outline</i>
            </a>
            <div class="inf none hidden">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
              </p>
            </div>
          </div>
        </div>
        @if ($errors->has('minor'))
          <div class="input_error">
              <span>{{ $errors->first('minor') }}</span>
          </div>
        @endif
        <div class="button">
          <center>
            <button type="submit" name="button" id="guardar_beacons" class="send_form">
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
      <form class="form-horizontal form_send" role="form" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <div class="button">
          <center>
            <button type="submit" name="button" class="send_form">
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
