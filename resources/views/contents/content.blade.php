<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
	<div class="principal">
		<div class="titulo">
			<h3>
				Planificación
			</h3>
		</div>
		<div class="agregar">
			<center>
				<a href="#agregarContenido" class="waves-effect">
					<div class="">
						<span class="text">Agregar <br><strong>Plan</strong></span>
						<span class="icon"><i class="material-icons">add</i></span>
					</div>
				</a>
			</center>
		</div>
		<div class="beacons seccion">
			<div class="container">
				<div class="tabla">
					<table>
						<thead>
							<tr>
									<th data-field="country">Cupon</th>
									<th data-field="country">Horario</th>
									<th>Editar</th>
									<th>Eliminar</th>
						</thead>

						<tbody>
							@foreach($contents as $content)
							<tr id="{{$content->content_id}}">
								<td>{{$content->coupon}}</td>
								<td>{{$content->timeframe->start_time}} - {{$content->timeframe->end_time}} </td>

								<td><a href="{{ route('edit_content', $content->content_id) }}"><i class="material-icons">edit</i></a></td>

							<?php

									echo "<td onclick= \"modal_activate('".
									route( "destroy_content", array('campana_id' => $campana_id, 'content_id' => $content->content_id) ).
								 "' , '#eliminarContenido')\" >";

							?>
									<a href="#eliminarContenido"><i class="material-icons">clear</i></a>
								</td> 
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="agregarContenido" class="modal modal_">
	<div class="titulo">
		<h3>
			Agregar Contenido
		</h3>
	</div>

	<div class="form">
		<form class="form-horizontal" role="form" method="POST" action="{{ route('store_content', $campana_id) }}">
			{{ csrf_field() }}
			<input type="hidden" name="tigger_name_id" value="DWELL_TIME">



			<div class="input select no_icon _100 {{ $errors->has('coupon_id') ? 'error' : '' }}">
				<select id="coupon_id" class="form-control icons" name="coupon_id" required>
					<option value="" disabled selected>Seleccione un Menú</option>
					@foreach($coupons as $c)
						<option value="{{$c->coupon_id}}">
							@if( ! empty($c->coupon_translation[0]) )
								{{$c->coupon_translation[0]->name}}
							@endif
						</option>
					@endforeach
				</select>
			</div>
			@if ($errors->has('coupon_id'))
			<div class="input_error">
				<span>{{ $errors->first('coupon_id') }}</span>
			</div>
			@endif

			<div class="input-field col s12 {{ $errors->has('timeframe_id') ? 'error' : '' }}">
				<select multiple id="timeframe_id" name="timeframe_id" required>
					<option value="" disabled selected>Seleccione un Horario</option>
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



			<div class="input no_icon {{ $errors->has('xxxxxx') ? 'error' : '' }}">
				<input type="number" name="xxxxxx" min="0" value="" class="input_time number" required="true">
				<label for="">
					<!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
					<span class="text">Minutos de espera</span>
				</label>
			</div>
			@if ($errors->has('xxxxxx'))
			<div class="input_error">
				<span>{{ $errors->first('xxxxxx') }}</span>
			</div>
			@endif

			<div class="button">
				<center>
					<button type="submit" name="button">
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


<div id="eliminarContenido" class="modal modal_">
	<div class="titulo">
		<h3>
			Esta seguro que desea eliminar esta planificación
		</h3>
	</div>
	<div class="form">
		<form class="form-horizontal" role="form" method="POST">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<div class="button">
				<center>
					<button type="submit" name="button">
						<span>Si</span>
					</button>
					<a href="#" class="" onclick="$('#eliminarContenido').modal('close'); return false;">
						<span>No</span>
					</a>
				</center>
			</div>
		</form>
	</div>
</div>

@endsection