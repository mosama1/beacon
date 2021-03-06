<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
	<div class="principal">
		<div class="titulo">
			<h3>
				Contenidos
			</h3>
		</div>
		<div class="agregar">
			<center>
				<a href="#agregarContenido" class="waves-effect">
					<div class="">
						<span class="text">Agregar <br><strong>Contenido</strong></span>
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
							<th data-field="country">Carta</th>
							<th data-field="country">Horario</th>
							<th width="100px">Editar</th>
							<th width="100px">Eliminar</th>
						</thead>

						<tbody>
							@foreach($contents as $content)
							<tr id="{{$content->content_id}}">
								<td>{{$content->coupon}}</td>
								<td>
									@if(isset($content->timeframes))
										<span title="{{$content->timeframes[0]->name}}: {{$content->timeframes[0]->start_time}} - {{$content->timeframes[0]->end_time}}" class="content_all_time">{{ $content->timeframes[0]->name }}</span>
										@for ($i = 1; $i < count($content->timeframes); $i++)
										    , <span title="{{$content->timeframes[$i]->name}}: {{$content->timeframes[$i]->start_time}} - {{$content->timeframes[$i]->end_time}}" class="content_all_time">{{ $content->timeframes[$i]->name }}</span>
										@endfor

									@endif
								</td>

								<td><a href="{{ route('edit_content', array('campana_id' => $campana_id, 'content_id' => $content->content_id) ) }}"><i class="material-icons">edit</i></a></td>

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
		<div class="agregar regresar">
			<center>
				<a href="{{ route('all_campana') }}" class="waves-effect">
					<div class="">
						<span class="text">Regresar</span>
						<span class="icon"><i class="material-icons">reply</i></span>
					</div>
				</a>
			</center>
		</div>
	</div>
</div>


<div id="agregarContenido" class="modal modal_ select">
	<div class="titulo">
		<h3>
			Agregar Contenido
		</h3>
	</div>

	<div class="form">
		<form class="form-horizontal form_send" role="form" method="POST" action="{{ route('store_content', $campana_id) }}">
			{{ csrf_field() }}
			<input type="hidden" name="tigger_name_id" value="DWELL_TIME">



			<div class="input select no_icon _100 {{ $errors->has('coupon_id') ? 'error' : '' }}">
				<select id="coupon_id" class="form-control icons" name="coupon_id" required>
					<option value="" disabled selected>Seleccione un Menú</option>
					@foreach($coupons as $c)
						<option value="{{$c->coupon_id}}">{{ (!empty($c->coupon_translation[0])) ? $c->coupon_translation[0]->name : '' }}</option>
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
				<select multiple id="timeframe_id" name="timeframe_id[]" required class="multiple_">
					<option value="" disabled selected>Seleccione un Horario</option>
					@foreach($timeframes as $t)
						<option value="{{$t->timeframe_id}}">{{$t->name}}</option>
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





			<div class="button">
				<center>
					<button type="submit" name="button" class="send_form">
						<span>Guardar</span>
					</button>
					<a href="#" onclick="$('#agregarContenido').modal('close'); return false;" class="">
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
			Esta seguro que desea eliminar estes contenido
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
					<a href="#" class="" onclick="$('#eliminarContenido').modal('close'); return false;">
						<span>No</span>
					</a>
				</center>
			</div>
		</form>
	</div>
</div>

@endsection
