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


        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="name" value="{{$campana->name}}" required="">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Name</span>
          </label>
        </div>
        @if ($errors->has('name'))
          <div class="input_error">
              <span>{{ $errors->first('name') }}</span>
          </div>
        @endif
        <div class="input no_icon {{ $errors->has('description') ? 'error' : '' }}">
          <input type="text" name="description" value="{{$campana->description}}">
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Descripción (Opcional)</span>
          </label>
        </div>
        @if ($errors->has('description'))
          <div class="input_error">
              <span>{{ $errors->first('description') }}</span>
          </div>
        @endif
        <div class="checkbox">
          <p style="padding-left: 30px;">
            <input type="checkbox" id="campanaei" />
            <label for="campanaei">xxxxxx</label>
          </p>
        </div>

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
