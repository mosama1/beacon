<?php $nivel = '' ?>

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
		<a href="#agregarPlan" class="waves-effect">
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
			<form role="form" method="POST">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<table>
					<thead>
						<tr>
							<th data-field="id">
								<div>
									<div class="help">
										<a href="#">
											<i class="material-icons">help_outline</i>
										</a>
										<div class="inf none hidden">
											<p>
									  		Visualiza como se verá en el móvil.
											</p>
										</div>
									</div>
								</div>
							</th>
							<th data-field="id">Nombre</th>
							<th data-field="country">Descripción</th>
							<th width="150px">
								<div class="helper">
									<span>Contenido</span>
									<div class="help">
										<a href="#">
											<i class="material-icons">help_outline</i>
										</a>
										<div class="inf none hidden">
											<p>
									  		Fecha desde que esta vigente esta planificación (por defecto la fecha de creación).
											</p>
										</div>
									</div>
								</div>
							</th>
							<th width="100px">Editar</th>
							<th width="100px">Eliminar</th>
							<th width="130px">Habilitado</th>
						</tr>
					</thead>

					<tbody>
						@foreach($campana as $c)
							<tr id="" >
								<td>
									<?= '<a href="#" id="preview" onclick="preview_campana('.$c->campana_id.')">';?>
										<i class="material-icons" alt="Visualiza cómo se verá en el movil.">phonelink_setup</i>
									</a>
								</td>
								<td>{{$c->name}}</td>
								<td>{{$c->description}}</td>
								<td>
									<a href="{{ route('all_content', $c->campana_id) }}">
										<i class="material-icons">add</i>
									</a>
								</td>
								<td>
									<a href="{{ route('edit_campana', $c->campana_id) }}">
										<i class="material-icons">edit</i>
									</a>
								</td>


									<?php
										echo "<td onclick= \"modal_activate('".
										route( "destroy_campana", $c->campana_id ).
											"' , '#eliminarPlan')\" >";
									?>

									<a href="#eliminarPlan">
										<i class="material-icons">clear</i>
									</a>
								</td>

								<td>
									<div class="switch">
										<label>
											Si
											<input id="habilitar_{{$c->campana_id}}" type="checkbox" {{ ($c->status > 0 ? '' : 'checked') }} class="filled-in" id="filled-in-box" onclick="habilitar('#habilitar_{{$c->campana_id}}', 'campanas', '{{$c->campana_id}}'); return false;" />
											<span class="lever"></span>
											No
										</label>
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</form>
		</div>
	  </div>
	</div>
  </div>
</div>


<div id="agregarPlan" class="modal modal_">
  <div class="titulo">
	<h3>
	  Agregar Plan
	</h3>
  </div>

  <div class="form">
	<form class="form-horizontal form_send" role="form" method="POST" action="{{ route('store_campana') }}">
	  {{ csrf_field() }}
	  <input type="hidden" name="location_id" value="{{$location->location_id}}" required="">

	  <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
		<input type="text" name="name" value="" required="">
		<label for="">
		  <span class="text">Nombre</span>
		</label>
	  </div>
	  @if ($errors->has('name'))
		<div class="input_error">
			<span>{{ $errors->first('name') }}</span>
		</div>
	  @endif
	  <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
		<textarea name="description" rows="8" cols="80" ></textarea>
		<label for="">
		  <span class="text">Descripción (Opcional)</span>
		</label>
	  </div>
	  @if ($errors->has('description'))
		<div class="input_error">
			<span>{{ $errors->first('description') }}</span>
		</div>
	  @endif
	  <div class="input no_icon {{ $errors->has('start_time') ? 'error' : '' }}">
		<input type="text" name="start_time" value="" required="" class="datetimepicker date_mask">
		<label for="">
		  <span class="text">Inicio (dd/mm/yy)</span>
		</label>
		<div class="help">
		  <a href="#">
			<i class="material-icons">help_outline</i>
		  </a>
		  <div class="inf none hidden">
			<p>
			  Fecha desde que esta vigente esta planificación (por defecto la fecha de creación).
			</p>
		  </div>
		</div>
	  </div>
	  @if ($errors->has('start_time'))
		<div class="input_error">
			<span>{{ $errors->first('start_time') }}</span>
		</div>
	  @endif

	  <div class="input no_icon {{ $errors->has('end_time') ? 'error' : '' }}">
		<input type="text" name="end_time" value="" required="" class="datetimepicker date_mask">
		<label for="">
		  <span class="text">Fin (dd/mm/yy)</span>
		</label>
		<div class="help">
		  <a href="#">
			<i class="material-icons">help_outline</i>
		  </a>
		  <div class="inf none hidden">
			<p>
			  Fecha hasta donde esta vigente el plan creado
			</p>
		  </div>
		</div>
	  </div>
	  @if ($errors->has('end_time'))
		<div class="input_error">
			<span>{{ $errors->first('end_time') }}</span>
		</div>
	  @endif
	  
	  <div class="button">
		<center>
		  <button type="submit" name="button" id="guardar" class="send_form">
			<span>Guardar</span>
		  </button>
		  <a href="#" class="" onclick="$('#agregarPlan').modal('close'); return false;">
			<span>Cancelar</span>
		  </a>
		</center>
	  </div>
	</form>
  </div>
</div>


<div id="eliminarPlan" class="modal modal_">
  <div class="titulo">
	<h3>
	  Esta seguro que desea eliminar esta planificación
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


<div id="dialog_preview" title="Previsualización de Campaña"  class="modal modal_">
	<iframe id="myIframe" src="">
	</iframe>	
</div>
@endsection
