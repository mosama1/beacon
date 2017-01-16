<?php $nivel = '../' ?>
@extends('layouts.app')

@section('content')
  <div class="contenedor">
    <div class="principal">
      <div class="titulo">
        <h3>
          Beancos
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
                    <th data-field="id">Nombre</th>
                    <th data-field="country">Mayor</th>
                    <th data-field="city">Minior</th>
                </tr>
              </thead>
              <tbody>
                @foreach($beacons as $b)
                  <tr>
                    <td>{{$b->name}}</td>
                    <td>{{$b->major}}</td>
                    <td>{{$b->minor}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
