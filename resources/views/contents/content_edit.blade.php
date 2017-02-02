<?php $nivel = '../../../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
	<div class="principal">
		<div class="titulo">
			<h3>
				Editar Contenido
			</h3>
		</div>

		<div class="form">
			@if (session('status'))
				 <span class="help-block">
					 <strong>{{ session('status') }}</strong>
				 </span>
			 @endif
			 <form class="form-horizontal" role="form" method="POST" action="{{ route('update_content', array('campana_id' => $campana_id, 'content_id' => $content->content_id) ) }}">
				 {{ csrf_field() }}
				 {{ method_field('PUT') }}
					<!-- <pre> <?php var_dump($coupons); ?> </pre> -->
				<div class="input select no_icon _100 {{ $errors->has('coupon_id') ? 'error' : '' }}">
					<select id="coupon_id" class="form-control icons" name="coupon_id" required>
						<option value="" disabled @if(!isset($coupons)) echo("selected") @endif >Seleccione un Menú</option>
						@foreach($coupons as $c)
							<option value="{{$c->coupon_id}}" {{ ($c->coupon_id == $content->coupon_id) ? 'selected' : '' }}>{{ (!empty($c->coupon_translation[0])) ? $c->coupon_translation[0]->name : '' }}</option>
						@endforeach
					</select>
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
				@if ($errors->has('coupon_id'))
				<div class="input_error">
					<span>{{ $errors->first('coupon_id') }}</span>
				</div>
				@endif

				<div class="input-field col s12 {{ $errors->has('timeframe_id') ? 'error' : '' }}">
					<select multiple id="timeframe_id" name="timeframe_id" required class="multiple_">
						<option value="" disabled @if(!isset($timeframes)) echo("selected") @endif>Seleccione un Horario</option>
						@foreach($timeframes as $t)
							<option value="{{$t->timeframe_id}}" {{ ($t->timeframe_id == $content->timeframe_id) ? 'selected' : '' }}>{{$t->name}}</option>
						@endforeach
					</select>
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
				@if ($errors->has('timeframe_id'))
				<div class="input_error">
					<span>{{ $errors->first('timeframe_id') }}</span>
				</div>
				@endif




				 <!-- <label><input type="checkbox" id="cbox1" value="first_checkbox"> Este es mi primer checkbox</label><br> -->

				 <div class="button">
					 <center>
						 <button type="submit" name="button" id="guardar">
							 <span>Guardar</span>
						 </button>
						 <a href="{{ route('all_content', array('$campana_id' => $campana_id )) }}" class="">
							 <span>Cancelar</span>
						 </a>
					 </center>
				 </div>
			 </form>

		</div>
	</div>
</div>

@endsection
