<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')
<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar Planificación
      </h3>
    </div>




    <div class="form">
      @if (session('status'))
         <span class="help-block">
           <strong>{{ session('status') }}</strong>
         </span>
       @endif
       <form class="form-horizontal" role="form" method="POST" action="{{ route('update_campana', $campana->campana_id) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}


        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="name" value="{{$campana->name}}" required="">
          <label for="">
            <span class="text">Name</span>
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
        <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
          <textarea name="description" rows="8" cols="80" >{{$campana->description}}</textarea>
          <label for="">
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
                <!-- <option value="fhfgh">{{$campana->location_id}} {{$location->location_id}}</option> -->
                <option value="{{$location->location_id}}" {{ ($location->location_id === $campana->location_id) ? 'selected' : ''}}>{{$location->name}}</option>
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

        <!-- <div class="input no_icon time {{ $errors->has('start_time') ? 'error' : '' }}">
          <input type="time" name="start_time" value="{{date('H:i', strtotime($campana->start_time))}}" required="" class="input_time">
          <label for="">
            <span class="text">Hora de inicio</span>
          </label>
        </div>
        @if ($errors->has('start_time'))
          <div class="input_error">
              <span>{{ $errors->first('start_time') }}</span>
          </div>
        @endif

        <div class="input no_icon time {{ $errors->has('end_time') ? 'error' : '' }}">
          <input type="time" name="end_time" value="{{date('H:i', strtotime($campana->end_time))}}" required="" class="input_time">
          <label for="">
            <span class="text">Hora de finalización</span>
          </label>
        </div>
        @if ($errors->has('end_time'))
          <div class="input_error">
              <span>{{ $errors->first('end_time') }}</span>
          </div>
        @endif -->

        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Guardar</span>
            </button>
            <a href="{{ route('all_campana') }}" class="">
              <span>Cancelar</span>
            </a>
          </center>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection
