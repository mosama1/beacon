<?php $nivel = '' ?>


@extends('layouts.appNotLogin')


@section('content')

<div class="contenedor">
	<div class="principal">
		<div class="titulo">
			<h3>Verificar Promociones</h3>
		</div>
		<div class="form">
			<form class="form-horizontal form_send" role="form" method="POST" action="{{ route('update_coupon_promotions') }}" id="verify_promotions">
				{{ csrf_field() }}

				<div class="input no_icon {{ $errors->has('verification_code') ? 'error' : '' }}">
					<input type="text" name="verification_code" id="verification_code" value="" required="la imgen" maxlength="4" minlength="4">
					<label for="verification_code">
						<span class="text">Código de verificación</span>
					</label>
				</div>
				@if ($errors->has('verification_code'))
					<div class="input_error">
						<span>{{ $errors->first('verification_code') }}</span>
					</div>
				@endif

				<div class="input no_icon {{ $errors->has( 'coupon_code' ) ? 'error' : '' }}">
					<input type="text" name="coupon_code" id="coupon_code" value="" required="true"  maxlength="10" minlength="10" readonly="true">
					<label for="coupon_code">
						<span class="text">Código del cupón</span>
					</label>
				</div>
				@if ($errors->has('coupon_code'))
					<div class="input_error">
						<span>{{ $errors->first('coupon_code') }}</span>
					</div>
				@endif

				<div class="input no_icon {{ $errors->has( 'expiration_date' ) ? 'error' : '' }}">
					<input type="text" name="expiration_date" id="expiration_date" value="" required="true" readonly="true">
					<label for="expiration_date">
						<span class="text">Fecha y Hora de expiración</span>
					</label>
				</div>
				@if ($errors->has('expiration_date'))
					<div class="input_error">
						<span>{{ $errors->first('expiration_date') }}</span>
					</div>
				@endif

				<div class="input no_icon {{ $errors->has( 'status_coupon' ) ? 'error' : '' }}">
					<div class="switch">
					</div>
				</div>
				@if ($errors->has('status_coupon'))
					<div class="input_error">
						<span>{{ $errors->first('status_coupon') }}</span>
					</div>
				@endif


				<div class="button">
					<center>
						<button type="submit" name="button" id="guardar" class="send_form">
							<span>Guardar</span>
						</button>
						<a href="#" class="" onclick="return false;">
						<!-- <a href="#" class="" onclick="$('#agregarPlan').modal('close'); return false;"> !-->
							<span>Cancelar</span>
						</a>
					</center>
				</div>
			</form>			
		</div>
	</div>
</div>



<div id="eliminarPlan" class="modal modal_">
  <div class="titulo">
	<h3>
	  Esta seguro que desea eliminar esta promoción
	</h3>
  </div>
  <div class="form">
	<form class="form-horizontal form_send" role="form" method="POST">
	  {{ csrf_field() }}
	  {{ method_field('DELETE') }}
	  <div class="button">
		<center>
		  <button type="submit" name="button" class="send_form">
			<span>Si</span>
		  </button>
		  <a href="#" class="" onclick="$('#eliminarPlan').modal('close'); return false;">
			<span>No</span>
		  </a>
		</center>
	  </div>
	</form>
  </div>
</div>

@endsection

