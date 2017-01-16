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
                  <th data-field="country">Descripci&oacute;n</th>
                  <th data-field="city">Hera de inicio</th>
                  <th data-field="street">Hora de Finalizaci&oacute;n</th>
                  <th>Editar</th>
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

            <h1 class="header center orange-text">Timeframe</h1>

			    <a href="{{ route('add_timeframe') }}" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>

          	    <table>
			        <thead>
			          <tr>
			              <th data-field="id">Nombre</th>
			              <th data-field="country">Descripci&oacute;n</th>
			              <th data-field="city">Hera de inicio</th>
			              <th data-field="street">Hora de Finalizaci&oacute;n</th>
			              <th>Ediar</th>
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
				          </tr>
				        @endforeach
			        </tbody>
			      </table>

        </div>
    </div> -->
@endsection
