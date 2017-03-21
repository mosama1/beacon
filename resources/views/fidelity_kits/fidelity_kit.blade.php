<?php $nivel = '' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
	<div class="titulo">
	  <h3>
		Kits de Fidelidad
	  </h3>
	</div>
	<div class="agregar">
	  <center>
		<a href="#kitBienvenida" class="waves-effect">
		  <div class="">
			<span class="text">Agregar <br>Kit</span>
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
				  <th width="100px">Editar</th>
				  <th width="100px">Eliminar</th>
				  <th width="130px">Habilitado</th>
			</thead>

			<tbody>
			  @foreach($fidelity_kits as $wk)
			  <tr id="{{ $wk->promotion_id }}">
				<td>
					<?= '<a href="#" id="previewPromotion" onclick="preview_promotion('.$wk->promotion_id .')"><i class="material-icons">phonelink_setup</i>
					</a>';?>
				</td>			  
				<td>{{ $wk->name }}</td>
				<td>{{ $wk->description }}</td>
				<td><a href="{{ route('edit_fidelity_kit', $wk->promotion_id) }}"><i class="material-icons">edit</i></a></td>		
			  <?php

				echo "<td onclick= \"modal_activate('".
				   route( "destroy_fidelity_kit",$wk->promotion_id ).
				  "' , '#eliminarkitBienvenida')\" >";

			  ?>
				<a href="#eliminarkitBienvenida"><i class="material-icons">clear</i></a></td>
				<td>
					<div class="switch">
					<label>
					  Si
					  <input id="habilitar_{{$wk->promotion_id}}" type="checkbox" {{ ($wk->status > 0 ? '' : 'checked') }} class="filled-in" id="filled-in-box" onclick="habilitar('#habilitar_{{$wk->promotion_id}}', 'kit_bienvenida', '{{$wk->promotion_id}}'); return false;" />
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


<div id="kitBienvenida" class="modal modal_">
  <div class="titulo">
	<h3>
	  Kit de Fidelidad
	</h3>
  </div>

  <div class="form">
	<form class="form-horizontal form_send" role="form" method="POST" action="{{ route('store_fidelity_kit') }}" enctype="multipart/form-data">
	  {{ csrf_field() }}

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
	  <div class="input no_icon {{ $errors->has('num_visit') ? 'error' : '' }}">
		<input type="text" name="number_visits" value="" required="" class="num_mask">
		<label for="">
		  <span class="text">Número de Visitas</span>
		</label>
	  </div>
	  @if ($errors->has('num_visit'))
		<div class="input_error">
			<span>{{ $errors->first('num_visit') }}</span>
		</div>
	  @endif


	  <!-- Mensaje de la promoción -->
	  <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
		<input type="text" name="message" value="">
		<label for="">
		  <span class="text">Mensaje Promoción</span>
		</label>
	  </div>
	  @if ($errors->has('name'))
		<div class="input_error">
			<span>{{ $errors->first('name') }}</span>
		</div>
	  @endif
  
	  <div class="button">
		<center>
		  <button type="submit" name="button" id="guardar" class="send_form">
			<span>Guardar</span>
		  </button>
		  <a href="#" class="" onclick="$('#kitBienvenida').modal('close'); return false;">
			<span>Cancelar</span>
		  </a>
		</center>
	  </div>
	</form>
  </div>
</div>


<div id="eliminarkitBienvenida" class="modal modal_">
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
		  <a href="#" class="" onclick="$('#eliminarkitBienvenida').modal('close'); return false;">
			<span>No</span>
		  </a>
		</center>
	  </div>
	</form>
  </div>
</div>
<div id="dialog_preview_promotion" title="Previsualización de Promoción"  class="modal modal_" style="vertical-align:middle;">
	<iframe id="myIframePromotion" src="" style="width: 80%; height: 80%;">
	</iframe>	
</div>

@endsection
