<?php $nivel = '../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Campa&ntilde;a
      </h3>
    </div>
    <div class="agregar">
      <center>
        <a href="{{ route('add_campana') }}" class="waves-effect">
          <div class="">
            <span class="text">Agregar <br><strong>Campaña</strong></span>
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
                  <th data-field="country">Descripci&oacute;n</th>
                  <th>Habilitar</th>
                  <th>Editar</th>
                  <th>Contenido</th>
              </tr>
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
                  <td><a href="{{ route('show_campana_content', $c->campana_id) }}"><i class="material-icons">add</i></a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

    <!-- <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>

            <h1 class="header center orange-text">Campa&ntilde;a</h1>

			    <a href="{{ route('add_campana') }}" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>

          	    <table>
			        <thead>
			          <tr>
			              <th data-field="id">Nombre</th>
			              <th data-field="country">Descripci&oacute;n</th>
			              <th data-field="city">Hera de inicio</th>
			              <th data-field="street">Hora de Finalizaci&oacute;n</th>
			              <th>Habilitar</th>
			              <th>Ediar</th>
			              <th>Contenido</th>
			          </tr>
			        </thead>

			        <tbody>
			        	@foreach($campana as $c)
				          <tr id="{{$c->campana_id}}">
				            <td>{{$c->name}}</td>
				            <td>{{$c->description}}</td>
				            <td>{{date("h:i a", strtotime($c->start_time))}}</td>
				            <td>{{date("h:i a", strtotime($c->end_time))}}</td>
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
				            <td><a href="{{ route('show_campana_content', $c->campana_id) }}"><i class="material-icons">add</i></a></td>
				          </tr>
				        @endforeach
			        </tbody>
			      </table>

        </div>
    </div> -->
@endsection
