<?php $nivel = '' ?>

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
        <a href="#agregarPlan" class="waves-effect">
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
                  <th data-field="id">id</th>
                  <th data-field="id">Nombre</th>
                  <th data-field="country">Descripción</th>
                  <th width="100px">Contenido</th>
                  <th width="100px">Editar</th>
                  <th width="100px">Eliminar</th>
                  <th width="130px">Habilitado</th>
            </thead>

            <tbody>
              @foreach($campana as $c)
                <tr id="{{$c->campana_id}}">
                  <td>{{$c->campana_id}}</td>
                  <td>{{$c->name}}</td>
                  <td>{{$c->description}}</td>

                  <td><a href="{{ route('all_content', $c->campana_id) }}"><i class="material-icons">add</i></a></td>
                  <td><a href="{{ route('edit_campana', $c->campana_id) }}"><i class="material-icons">edit</i></a></td>

                  <!-- <td><a href="{{ route('all_content', $c->campana_id) }}"><i class="material-icons">add</i></a></td> -->
                <?php

                  echo "<td onclick= \"modal_activate('".
                     route( "destroy_campana", $c->campana_id ).
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
              @endforeach
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
      Agregar Plan
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('store_campana') }}">
      {{ csrf_field() }}

      <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
        <input type="text" name="name" value="" required="">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
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
      <div class="input no_icon {{ $errors->has('description') ? 'error' : '' }}">
        <input type="text" name="description" value="">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Descripción (Opcional)</span>
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
      @if ($errors->has('description'))
        <div class="input_error">
            <span>{{ $errors->first('description') }}</span>
        </div>
      @endif

      <div class="input select no_icon {{ $errors->has('location_id') ? 'error' : '' }}">
        <!-- <img src="img/icons/idioma.png" alt="" class="icon"> -->
        <select id="location_id" class="form-control icons" name="location_id" required>
          <option value="" selected>Seleccione una ubicación</option>
          @foreach($locations as $location)
              <option value="{{$location->location_id}}">{{$location->name}}</option>
          @endforeach
        </select>

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
      @if ($errors->has('location_id'))
      <div class="input_error">
        <span>{{ $errors->first('location_id') }}</span>
      </div>
      @endif

      <div class="button">
        <center>
          <button type="submit" name="button" id="guardar">
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
      Esta seguro que desea eliminar esta planificación
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
          <a href="#" class="" onclick="$('#eliminarPlan').modal('close'); return false;">
            <span>No</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>

@endsection
