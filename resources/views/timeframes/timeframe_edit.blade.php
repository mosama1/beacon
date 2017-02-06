<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar Horario
      </h3>
    </div>

    <div class="form">

       <form class="form-horizontal" role="form" method="POST" action="{{ route('update_timeframe',$timeframe->timeframe_id) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="name" value="{{$timeframe->name}}" required="">
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
          <textarea name="description" rows="8" cols="80" >{{$timeframe->description}}</textarea>
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

        <div class="input no_icon {{ $errors->has('start_time') ? 'error' : '' }}">
          <input type="time" name="start_time" value="{{$timeframe->start_time}}" required="">
          <label for="">
            <span class="text">Hora de inicio</span>
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
        @if ($errors->has('start_time'))
          <div class="input_error">
              <span>{{ $errors->first('start_time') }}</span>
          </div>
        @endif

        <div class="input no_icon {{ $errors->has('end_time') ? 'error' : '' }}">
          <input type="time" name="end_time" value="{{$timeframe->end_time}}" required="">
          <label for="">
            <span class="text">Hora de finalización</span>
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
        @if ($errors->has('end_time'))
          <div class="input_error">
              <span>{{ $errors->first('end_time') }}</span>
          </div>
        @endif

        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Guardar</span>
            </button>
            <a href="{{ route('all_timeframe') }}" class="">
              <span>Cancelar</span>
            </a>
          </center>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection
