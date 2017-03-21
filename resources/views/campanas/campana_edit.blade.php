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
       <form class="form-horizontal form_send" role="form" method="POST" action="{{ route('update_campana', $campana->campana_id) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <input type="hidden" name="location_id" value="{{ $locations->location_id }}" required="">

        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="name" value="{{$campana->name}}" required="">
          <label for="">
            <span class="text">Name</span>
          </label>
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
        </div>
        @if ($errors->has('description'))
          <div class="input_error">
              <span>{{ $errors->first('description') }}</span>
          </div>
        @endif
        <div class="input no_icon {{ $errors->has('start_time') ? 'error' : '' }}">
          <input type="text" name="start_time" value="{{date('d-m-Y', strtotime($campana->start_time))}}" required="" class="datetimepicker">
          <label for="">
            <span class="text">Inicio (dd/mm/yy)</span>
          </label>
          <div class="help">
            <a href="#">
              <i class="material-icons">help_outline</i>
            </a>
            <div class="inf none hidden">
              <p>
                Fecha desde que esta vigente esta planificación (por defecto la fecha de creación).
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
          <input type="text" name="end_time" value="{{date('d-m-Y', strtotime($campana->end_time))}}" required="" class="datetimepicker">
          <label for="">
            <span class="text">Final (dd/mm/yy)</span>
          </label>
          <div class="help">
            <a href="#">
              <i class="material-icons">help_outline</i>
            </a>
            <div class="inf none hidden">
              <p>
                Fecha hasta donde esta vigente el plan creado.
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
            <button type="submit" name="button" id="guardar" class="send_form">
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
