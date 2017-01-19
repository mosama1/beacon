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
          <a href="{{ route('edit_beacon') }}" class="waves-effect">
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
                    <td><a href="#eliminarBeacon"><i class="material-icons">clear</i></a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="eliminarBeacon" class="modal modal_">

    <div class="titulo">
      <h3>
        Esta seguro que desea eliminar este beacon
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
            <a href="#" class="" onclick="$('#eliminarBeacon').modal('close'); return false;">
              <span>No</span>
            </a>
          </center>
        </div>
      </form>
    </div>
  </div>

@endsection
