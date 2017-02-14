<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')

<script type="text/javascript">
function checkSubmit() {
    document.getElementById("guardar").value = "Enviando...";
    document.getElementById("guardar").disabled = true;
    return true;
}
</script>

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar Tipo de Plato
      </h3>
    </div>

    <div class="form">
      @if (session('status'))
         <span class="help-block">
           <strong>{{ session('status') }}</strong>
         </span>
       @endif
       <form class="form-horizontal" role="form" method="POST" action="{{ route('update_tipoPlato', $tipo_plato->id)}}">
        {{ csrf_field() }}

        <input type="hidden" name="_method" value="PUT">


        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="name" value="{{$tipo_plato->name}}" required="">
          <label for="">
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

        <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
          <textarea name="description" rows="8" cols="80" >{{$tipo_plato->description}}</textarea>
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


        <div class="button">
          <center>
            <button type="submit" name="button" id="guardar">
              <span>Guardar</span>
            </button>
            <a href="{{ URL::previous() }}" class="">
              <span>Cancelar</span>
            </a>
          </center>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection
