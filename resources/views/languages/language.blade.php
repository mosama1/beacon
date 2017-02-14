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
								<th data-field="id" width="100px">Icono</th>
								<th data-field="id">Nombre</th>
								<th data-field="id">Abreviatura</th>
								<th data-field="name" width="100px">Eliminar</th>
								<th data-field="id" width="130px">Habilitado</th>
							</tr>
						</thead>

						<tbody>
							@foreach($languages as $language)
								@if($language->id != 1)
								<tr>
									<th data-field="id"><img src="{{$language->icon}}" alt="" width="40px"></th>
									<th data-field="id">{{$language->name}}</th>
									<th data-field="id">{{$language->abbreviation}}</th>
									<?php

									echo "<td onclick= \"modal_activate('".
									route( "destroy_language", $language->id ).
									"' , '#eliminarLanguage')\" >";

									?>

									<a href="#eliminarLanguage"><i class="material-icons">clear</i></a>

								</td>
								<td>
									<div class="switch">
										<label>
											Si
											@foreach($language_users as $language_user)
											@if( $language_user->language_id == $language->id )
											<input id="habilitar_{{$language_user->id}}" type="checkbox" {{ ($language_user->status > 0 ? '' : 'checked') }} class="filled-in" onclick="habilitar('#habilitar_{{$language_user->id}}', 'languages', '{{$language_user->id}}'); return false;" />

											@endif
											@endforeach

											<span class="lever"></span>
											No
										</label>
									</div>
								</td>
							</tr>
								@endif

							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="crearIdioma" class="modal modal_ select">
	<div class="titulo">
		<h3>
			Agregar Idioma
		</h3>
	</div>

	<div class="form">
		<form class="form-horizontal form_send" role="form" method="POST" action="{{ route('store_language') }}">
			{{ csrf_field() }}

			<div class="input select no_icon _100 {{ $errors->has('language_id') ? 'error' : '' }}">
				<select id="language_id" class="form-control icons" name="language_id" required>
					<option value="" disabled selected>Seleccione un Idioma</option>
					@foreach($languages_all as $l)
						@if($l->id != 1)
							<option value="{{$l->id}}">{{$l->name}}</option>
						@endif
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
			@if ($errors->has('language_id'))
			<div class="input_error">
				<span>{{ $errors->first('language_id') }}</span>
			</div>
			@endif




			<div class="button">
				<center>
					<button type="submit" name="button" id="guardar" class="send_form">
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
<div id="eliminarLanguage" class="modal modal_">

	<div class="titulo">
		<h3>
			Está seguro que desea eliminar Idioma
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
					<a href="#" class="" onclick="$('#eliminarLanguage').modal('close'); return false;">
						<span>No</span>
					</a>
				</center>
			</div>
		</form>
	</div>
</div>

@endsection
