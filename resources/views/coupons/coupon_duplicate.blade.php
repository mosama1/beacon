<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Duplicar Carta
      </h3>
    </div>

    <div class="form">
      @if (session('status'))
         <span class="help-block">
           <strong>{{ session('status') }}</strong>
         </span>
       @endif

        <form class="form-horizontal" role="form" method="POST" action="{{ route('process_duplicate_coupon', $coupon ) }}">
          {{ csrf_field() }}
          <input type="hidden" name="coupon_id" value="{{ $coupon }}">

          <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="name"  value="" required="">
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
          <textarea name="description" rows="8" cols="80"></textarea>
          <label for="">
            <span class="text">Descripción</span>
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


            <a href="{{route('all_coupon')}}" class="" return false;">
            <span>Cancelar</span>
            </a>
          </center>
          </div>
        </form>
    </div>
  </div>
</div>

@endsection
