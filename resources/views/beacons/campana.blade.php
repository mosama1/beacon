<?php $nivel = '../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Planificación
      </h3>
    </div>
    <div class="agregar">
      <center>
        <a href="{{ route('add_campana') }}" class="waves-effect">
          <div class="">
            <span class="text">Agregar <br><strong>Plan</strong></span>
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
                  <th data-field="country">Descripción</th>
                  <th>Habilitar</th>
                  <th>Editar</th>
                  <th>Contenido</th>
                  <th>Eliminar</th>
            </thead>

            <tbody>
              @foreach($campana as $c)
                <tr id="{{$c->campana_id}}">
                  <td>{{$c->name}}</td>
                  <td>{{$c->description}}</td>
                  <td>
                    <p>
                     @if($c->enabled === 1)
                  <input type="checkbox" id="test{{$c->campana_id}}" checked="checked"/>
                 @else
                  <input type="checkbox" id="test{{$c->campana_id}}" />
                 @endif
                 <label for="test{{$c->campana_id}}"></label>
                </p>
                  </td>
                  <td><a href="{{ route('edit_campana', $c->campana_id) }}"><i class="material-icons">edit</i></a></td>
                  <td><a href="{{ route('show_content', 1) }}"><i class="material-icons">input</i></a></td>

                  <!-- <td><a href="{{ route('show_campana_content', $c->campana_id) }}"><i class="material-icons">add</i></a></td> -->
                  <td><a href="#eliminarPlan"><i class="material-icons">clear</i></a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="eliminarPlan" class="modal modal_">

  <div class="titulo">
    <h3>
      Esta seguro que desea eliminar esta planificación
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
          <a href="#" class="" onclick="$('#eliminarPlan').modal('close'); return false;">
            <span>No</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>

@endsection
