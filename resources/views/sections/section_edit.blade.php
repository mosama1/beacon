<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')
<!-- -->
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
        Editar Sección
      </h3>
    </div>

    <div class="form">
      @if (session('status'))
         <span class="help-block">
           <strong>{{ session('status') }}</strong>
         </span>
       @endif
       <form class="form-horizontal" role="form" method="POST" action="{{ route( 'update_section', $section->id ) }}">
        {{ csrf_field() }}

        {{ method_field('PUT') }}

        <input type="hidden" name="coupon_id" value="{{ $coupon_id }}">
        <input type="hidden" name="language_id" value="1">

        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="name" value="{{ $section->section_translation[0]->name }}" required="">
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

        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}" id="divPrecioCarta" style="display: {{ (!empty($section->price)  ?  'block;' : '') }}" >
          <input type="number" name="price" step="0.01" min="0" value="{{ $section->price }}"  id="price" min="0.00"  onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)">

          <label for="">
            <span class="text"></span>
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
        <div class="input_error" id="errorPrecioCarta" style="display: none;">
            <span>El monto debe ser mayor a cero</span>
        </div>

        <p>
          <input type="checkbox"  {{ ($section->price > 0  ? 'checked' : '') }} class="filled-in" id="filled-in-box" />
          <label for="filled-in-box">Manejar Precio</label>
        </p>
        <div class="button">
          <center>
            <button type="submit" name="button" id="guardar">
              <span>Guardar</span>
            </button>
            <a href="{{ route( 'all_section', $coupon_id ) }}" class="">
              <span>Cancelar</span>
            </a>
          </center>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection
