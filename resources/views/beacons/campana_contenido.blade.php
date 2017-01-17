<?php $nivel = '../../../' ?>
@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Agregar Contenido de Planificación
      </h3>
    </div>

    <div class="form">

      <form class="form-horizontal" role="form" method="POST" action="{{ route('store_campana_content', $campana_id) }}">
        {{ csrf_field() }}



        <div class="input select {{ $errors->has('coupon_id') ? 'error' : '' }}">
          <select id="coupon_id" class="form-control icons" name="coupon_id" required>
            <option value="" disabled selected>Seleccione un Cupon</option>
            @foreach($coupon as $c)
                <option value="{{$c->coupon_id}}">{{$c->name}}</option>
            @endforeach
          </select>
        </div>
        @if ($errors->has('coupon_id'))
        <div class="input_error">
          <span>{{ $errors->first('coupon_id') }}</span>
        </div>
        @endif

        <div class="input select {{ $errors->has('timeframe_id') ? 'error' : '' }}">
          <select id="timeframe_id" class="form-control icons" name="timeframe_id" required>
            <option value="" disabled selected>Seleccione un Timeframe</option>
            <option value="ALL">All</option>
            @foreach($timeframes as $t)
                <option value="{{$t->timeframe_id}}">{{$t->name}}</option>
            @endforeach
          </select>
        </div>
        @if ($errors->has('timeframe_id'))
        <div class="input_error">
          <span>{{ $errors->first('timeframe_id') }}</span>
        </div>
        @endif

        <div class="input select {{ $errors->has('tigger_name_id') ? 'error' : '' }}">
          <select id="tigger_name_id" class="form-control icons" name="tigger_name_id" required>
            <option value="" disabled selected>Seleccione un Tigger Name</option>
              <option value="ENTRY">ENTRY</option>
              <option value="EXIT">EXIT</option>
              <option value="FAR_NEAR">FAR_NEAR</option>
              <option value="NEAR_IMMEDIAT">NEAR_IMMEDIAT</option>
              <option value="IMMEDIATE_NEAR">IMMEDIATE_NEAR</option>
              <option value="NEAR_FAR">NEAR_FAR</option>
              <option value="DWELL_TIME">DWELL_TIME</option>
              <option value="DWELL_TIME_FAR">DWELL_TIME_FAR</option>
              <option value="DWELL_TIME_IMMEDIAT">DWELL_TIME_IMMEDIAT</option>
              <option value="DWELL_TIME_NEA">DWELL_TIME_NEA</option>
          </select>
        </div>
        @if ($errors->has('tigger_name_id'))
        <div class="input_error">
          <span>{{ $errors->first('tigger_name_id') }}</span>
        </div>
        @endif

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

    <!-- <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>

            <h1 class="header center orange-text">Agregar Contenido de Campa&ntilde;a</h1>

             @if (session('status'))
	           <span class="help-block">
	           	 <strong>{{ session('status') }}</strong>
	           </span>
	         @endif

 			<form class="form-horizontal" role="form" method="POST" action="{{ route('store_campana_content', $campana_id) }}">
	            {{ csrf_field() }}

	             <div class="input-field col s12">
				    <select name="coupon_id" required>
				      <option value="" disabled selected>Seleccione un Cupon</option>
				      @foreach($coupon as $c)
				      		<option value="{{$c->coupon_id}}">{{$c->name}}</option>
				      @endforeach
				    </select>
				    <label>Cupon</label>
				  </div>

				  <div class="input-field col s12">
				    <select name="tag_id" required>
				      <option value="" disabled selected>Seleccione un Tag</option>
				      <option value="ALL">All</option>
				      @foreach($tags as $t)
				      		<option value="{{$t->tag_id}}">{{$t->name}}</option>
				      @endforeach
				    </select>
				    <label>Tags</label>
				  </div>

				  <div class="input-field col s12">
				    <select name="timeframe_id" required>
				      <option value="" disabled selected>Seleccione un Timeframe</option>
				      <option value="ALL">All</option>
				      @foreach($timeframes as $t)
				      		<option value="{{$t->timeframe_id}}">{{$t->name}}</option>
				      @endforeach
				    </select>
				    <label>Timeframes</label>
				  </div>

				  <div class="input-field col s12">
				    <select name="tigger_name_id" required>
				      <option value="" disabled selected>Seleccione un Tigger Name</option>
				      	<option value="ENTRY">ENTRY</option>
				      	<option value="EXIT">EXIT</option>
				      	<option value="FAR_NEAR">FAR_NEAR</option>
				      	<option value="NEAR_IMMEDIAT">NEAR_IMMEDIAT</option>
				      	<option value="IMMEDIATE_NEAR">IMMEDIATE_NEAR</option>
				      	<option value="NEAR_FAR">NEAR_FAR</option>
				      	<option value="DWELL_TIME">DWELL_TIME</option>
				      	<option value="DWELL_TIME_FAR">DWELL_TIME_FAR</option>
				      	<option value="DWELL_TIME_IMMEDIAT">DWELL_TIME_IMMEDIAT</option>
				      	<option value="DWELL_TIME_NEA">DWELL_TIME_NEA</option>
				    </select>
				    <label>Tigger Name</label>
				  </div>


	             <div class="form-group">
	                <div class="col-md-6 col-md-offset-4">
	                    <button type="submit" class="btn btn-primary">
	                        Guardar
	                    </button>
	                    <a href="{{ route('show_campana') }}" class="btn btn-primary">
	                        Cancelar
	                    </a>
	                </div>
	            </div>
	        </form>

        </div>
    </div> -->
@endsection
