<?php $nivel = '../../../' ?>

@extends('layouts.app')

@section('content')
<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar Planificacion
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


        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="name" value="{{$campana->name}}" required="">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Name</span>
          </label>
          @if ($errors->has('name'))
            <span class="error_input">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
        </div>
        <div class="input no_icon {{ $errors->has('description') ? 'error' : '' }}">
          <input type="text" name="description" value="{{$campana->description}}" required="">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Descripcion</span>
          </label>
          @if ($errors->has('description'))
            <span class="error_input">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
          @endif
        </div>

        <div class="input no_icon time {{ $errors->has('start_time') ? 'error' : '' }}">
          <input type="time" name="start_time" value="{{date('H:i', strtotime($campana->start_time))}}" required="" class="input_time">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Hora de inicio</span>
          </label>
          @if ($errors->has('start_time'))
            <span class="error_input">
                <strong>{{ $errors->first('start_time') }}</strong>
            </span>
          @endif
        </div>

        <div class="input no_icon time {{ $errors->has('end_time') ? 'error' : '' }}">
          <input type="time" name="end_time" value="{{date('H:i', strtotime($campana->end_time))}}" required="" class="input_time">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Hora de finalizaci&oacute;n</span>
          </label>
          @if ($errors->has('end_time'))
            <span class="error_input">
                <strong>{{ $errors->first('end_time') }}</strong>
            </span>
          @endif
        </div>






        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Guardar</span>
            </button>
            <a href="{{ route('show_campana') }}" class="">
              <span>Cancelar</span>
            </a>
          </center>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection
