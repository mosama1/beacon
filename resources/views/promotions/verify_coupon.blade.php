<?php $nivel = '' ?>


@extends('layouts.appNotLogin')


@section('content')

<div class="contenedor">

	<div class="principal">
		<div class="titulo">
			<h3>Verificar Cupones</h3>
		</div>
		<div class="form">
			<form class="form-horizontal form_send" role="form" method="POST" action="{{ route('update_coupon_promotions') }}" id="verify_promotions" name="verify_promotions">
				{{ csrf_field() }}

				<div class="input no_icon {{ $errors->has('verification_code') ? 'error' : '' }}">
					<input type="text" name="verification_code" id="verification_code" value="" required="true" maxlength="4" minlength="4">
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

				<div class="mostrar_mensaje {{ (session('message')) ? 'message '.session('type') : '' }}">

					<p>
						{{ session('message') }}
					</p>
					<a href="#">
						<i class="material-icons">close</i>
					</a>
				</div>

				<div class="vista_previa_promotion">
					<div class="img">							
						<a href="#">
							<img id="" class="" src="">
						</a>
					</div>
				</div>

				<!-- The Modal -->
				<div id="myModal" class="modal-background">
				  <span class="close">&times;</span>
				  <img class="modal-content" id="imgPreview">
				  <div id="caption"></div>
				</div>

				<div class="button">
					<center>
						<button type="button" name="button" id="guardar_verify_coupon" name="guardar_verify_coupon" class="send_form">
							<span>Canjear<br />Cupon</span>
						</button>
						<a onclick="location.reload(true)">
							<span>Borrar</span>
						</a>
					</center>
				</div>
			</form>			
		</div>
	</div>
</div>

@endsection

