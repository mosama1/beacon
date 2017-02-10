<?php $nivel = ''?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
	<div class="principal">
		<div class="titulo">
			<h3>
				Los Idiomas
			</h3>
		</div>

		<div class="agregar">
			<center>
				<a href="#crearIdioma" class="waves-effect">
					<div class="">
						<span class="text">Agregar <br><strong>Idioma</strong></span>
						<span class="icon"><i class="material-icons">add</i></span>
					</div>
				</a>
			</center>
		</div>

		<div class="beacons seccion">
			<div class="container">
				<div class="tabla">
					<table class="bordered centered">
						<thead>
							<tr>
								<th data-field="id">Nombre</th>
								<th data-field="id">Abreviatura</th>
								<th data-field="id">Icono</th>
								<th data-field="id" width="100px">Editar</th>
								<th data-field="name" width="100px">Eliminar</th>
								<th data-field="id" width="130px">Habilitado</th>
							</tr>
						</thead>

						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="crearIdioma" class="modal modal_">
	<div class="titulo">
		<h3>
			Agregar Idioma
		</h3>
	</div>

	<div class="form">
		<form class="form-horizontal" role="form" method="POST" action="{{ route('store_language') }}">
			{{ csrf_field() }}

			<div class="input select no_icon _100 {{ $errors->has('coupon_id') ? 'error' : '' }}">
				<select id="coupon_id" class="form-control icons" name="coupon_id" required>
					<option value="" disabled selected>Seleccione un Idioma</option>
					@foreach($languages as $language)
					<option value="{{$language->id}}">{{$language->name}}</option>
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




			<div class="button">
				<center>
					<button type="submit" name="button">
						<span>Guardar</span>
					</button>
					<a href="#" class="" onclick="$('#crearIdioma').modal('close'); return false;">
						<span>Cancelar</span>
					</a>
				</center>
			</div>
		</form>
	</div>
</div>
<div id="eliminarLanguaje" class="modal modal_">

	<div class="titulo">
		<h3>
			Está seguro que desea eliminar Idioma
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
					<a href="#" class="" onclick="$('#eliminarLanguaje').modal('close'); return false;">
						<span>No</span>
					</a>
				</center>
			</div>
		</form>
	</div>
</div>

@endsection
