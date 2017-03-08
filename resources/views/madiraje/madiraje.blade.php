<?php $nivel = '' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
	<div class="principal">
		<div class="titulo">
			<h3>
				Madirajes
			</h3>
		</div>
		<div class="agregar">
			<center>
				<a href="#agregarMadiraje" class="waves-effect">
					<div class="">
						<span class="text">Agregar <br><strong>Madiraje</strong></span>
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
								<th data-field="id">Nombre</th>
								<th data-field="description">Precio</th>
								<th data-field="street" width="160px">Status</th>
								<th width="100px">Editar</th>
								<th width="100px">Eliminar</th>
							</tr>
						</thead>

						<tbody>
							@foreach($madirajes_list as $m)
								<tr id="{{$m->id}}">
									<td>{{$m->nombre}}</td>
									<td>{{$m->precio}}</td>
									<td>
										<div class="switch">
											<label>
												Si
												<input id="habilitar_{{$m->id}}" type="checkbox" {{ ($m->status > 0 ? '' : 'checked') }} class="filled-in" id="filled-in-box" onclick="habilitar('#habilitar_{{$m->id}}', 'madirajes', '{{$m->id}}'); return false;" />
												<span class="lever"></span>
												No
											</label>
										</div>									
									</td>
									<td><a href="{{ route('edit_madiraje', $m->id) }}"><i class="material-icons">edit</i></a></td>
									<?php

										echo "<td onclick= \"modal_activate('".
											 route( "destroy_madiraje", $m->id ).
											"' , '#eliminarMadiraje')\" >";
									?>
									<a href="#eliminarMadiraje"><i class="material-icons">clear</i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



<div id="agregarMadiraje" class="modal modal_">
	<div class="titulo">
		<h3>
			Agregar Madiraje
		</h3>
	</div>

	<div class="form">
		<form class="form-horizontal form_send" role="form" method="POST" action="{{ route('store_madiraje') }}" enctype="multipart/form-data" id="add_madiraje">
			{{ csrf_field() }}
			<div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
				<input type="text" name="name" value="" required="">
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


			<div class="input no_icon {{ $errors->has('price') ? 'error' : '' }}" style="display:">

				<input type="number" name="price" required="" min="1" max="99999" step="any" id="madiraje_price" >
				<label for="">
					<span class="text">Precio 0,00 €</span>
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
			@if ($errors->has('price'))
				<div class="input_error">
						<span>{{ $errors->first('price') }}</span>
				</div>
			@endif

			<div class="divide_cont files">
			  <div class="file-field input-field input_file {{ $errors->has('photo') ? 'has-error' : '' }}">
				<div class="btn">
				  <span class="icon"><img src="img/icons/subir_archivo.png" alt=""></span>
				  <span>Subir Logo</span>
				  <input type="file" name="photo" id="addPhoto">
				</div>
				<div class="file-path-wrapper">
				  <input class="file-path validate" type="text">
				</div>
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
			  @if ($errors->has('photo'))
			  <div class="error_input">
				<span>{{ $errors->first('photo') }}</span>
			  </div>
			  @endif
			  <div class="vista_previa">
				<center  id="vista_previa">
				  <a href="#" class="vistaPreviaImg">
					<div class="img " id="vista_photo">						
					</div>
				  </a>

				</center>
			  </div>
			</div>

			<div class="button">
				<center>
					<button type="submit" name="button" id="guardar" class="">
						<span>Guardar</span>
					</button>
					<a href="#" class="" onclick="$('#agregarMadiraje').modal('close'); return false;">
						<span>Cancelar</span>
					</a>
				</center>
			</div>
		</form>
	</div>
</div>
<div id="eliminarMadiraje" class="modal modal_">

	<div class="titulo">
		<h3>
			Esta seguro que desea eliminar este madiraje
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
					<a href="#" class="" onclick="$('#eliminarHorario').modal('close'); return false;">
						<span>No</span>
					</a>
				</center>
			</div>
		</form>
	</div>
</div>

@endsection
