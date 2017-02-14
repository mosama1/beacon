<?php $nivel = '';?>
@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">


	<div class="titulo">
	  <h3>
		La Carta
	  </h3>
	</div>


	<div class="agregar">
	  <center>
		<a href="#agregarMenu" class="waves-effect">
		  <div class="">
			<span class="text">Agregar<br><strong>Carta</strong></span>
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

		  <table class="bordered centered">
			<thead>
			  <tr>
				<th data-field="id">Nombre</th>
				<th data-field="id">Descripción</th>
				<th data-field="name" width="100px">Detalles</th>
				<th data-field="price" width="100px">Editar</th>
				<th data-field="price" width="100px">Duplicar</th>
				<th data-field="price" width="100px">Eliminar</th>
				<th data-field="id" width="130px">Habilitado</th>
			  </tr>
			</thead>

			<tbody>

			  @foreach($coupon as $c)

				<tr id='{{$c->coupon_id}}'>
				  <td>
					@if( ! empty($c->coupon_translation[0]) )
					  {{$c->coupon_translation[0]->name}}
					@endif
				  </td>
				  <td>
					@if( ! empty($c->coupon_translation[0]) )
					  {{$c->coupon_translation[0]->description}}
					@endif
				  </td>
				  <td><a href="{{ route( 'all_section', $c->coupon_id ) }}"><i class="material-icons">input</i></a></td>


				  <!-- <td><a href="#idioma"><i class="material-icons">language</i></a></td> -->
				  <td><a href="{{ route( 'edit_coupon', $c->coupon_id ) }}"><i class="material-icons">edit</i></a></td>

				  <!-- DUPLICAR CUPON -->
				  <td><a href="{{ route( 'duplicate_coupon', $c->coupon_id ) }}"><i class="material-icons">content_copy</i></a></td>

				  <?php

				  echo "<td onclick= \"modal_activate('".
				  route( "destroy_coupon", $c->coupon_id ).
				  "' , '#eliminarCoupon')\" >";

				  ?>

				  <a href="#eliminarCoupon"><i class="material-icons">clear</i></a>

				</td>
				<td>
				<div class="switch">
				  <label>
						Si
						<input
						id="habilitar_{{$c->coupon_id}}"
						type="checkbox"
						{{ ($c->status > 0 ? '' : 'checked') }}
						class="filled-in" id="filled-in-box" onclick="habilitar('#habilitar_{{$c->coupon_id}}', 'coupons', '{{$c->coupon_id}}'); return false;" />
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
<div id="agregarMenu" class="modal modal_">
  <div class="titulo">
	<h3>
	  Agregar Carta
	</h3>
  </div>

  <div class="form">
	<form class="form-horizontal" role="form" method="POST" action="{{ route('store_coupon') }}">
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

	  <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
		<textarea name="description" rows="8" cols="80"></textarea>
		<label for="">
		  <span class="text">Descripción</span>
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
	  @if ($errors->has('description'))
		<div class="input_error">
			<span>{{ $errors->first('description') }}</span>
		</div>

	  @endif
	  <!-- <label><input type="checkbox" id="cbox1" value="first_checkbox"> Este es mi primer checkbox</label><br> -->

	  <div class="button">
		<center>
		  <button type="submit" name="button" id="guardar">
			<span>Guardar</span>
		  </button>
		  <a href="#" class="" onclick="$('#agregarMenu').modal('close'); return false;">
			<span>Cancelar</span>
		  </a>
		</center>
	  </div>
	</form>
  </div>
</div>


<div id="idioma" class="modal modal_">
  <div class="titulo">
	<h3>
	  Agregar Idioma
	</h3>
  </div>

  <div class="form">
	<form class="form-horizontal" role="form" method="POST"> 
	  {{ csrf_field() }}

	  <div class="input select {{ $errors->has('type') ? 'error' : '' }}">
		<!-- <img src="img/icons/idioma.png" alt="" class="icon"> -->
		<select id="type" class="form-control icons" name="type" required>
		  <option value="" disabled selected>Seleccione un Idioma</option>

		  <option value="vegetariana">vegetariana</option>
		  <option value="sin gluten">sin gluten</option>
		  <option value="bja caloria">baja caloria</option>
		  <option value="picante">picante</option>
		</select>

		@if ($errors->has('type'))
		<span class="error_input">
		  <strong>{{ $errors->first('type') }}</strong>
		</span>
		@endif
	  </div>
	  <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
		<input type="text" name="name" value="" required="">
		<label for="">
		  <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
		  <span class="text">Traducción Nombre</span>
		</label>
	  </div>
	  @if ($errors->has('name'))
		<div class="input_error">
			<span>{{ $errors->first('name') }}</span>
		</div>
	  @endif

	  <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
		<!-- <input type="text" name="description" value="" required=""> -->
		<textarea name="description" rows="8" cols="80" required=""></textarea>
		<label for="">
		  <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
		  <span class="text">Traducción Descripción</span>
		</label>
	  </div>
	  @if ($errors->has('description'))
		<div class="input_error">
			<span>{{ $errors->first('description') }}</span>
		</div>
	  @endif
	  <!-- <label><input type="checkbox" id="cbox1" value="first_checkbox"> Este es mi primer checkbox</label><br> -->
	  <div class="button">
		<center>
		  <button type="submit" name="button" id="guardar">
			<span>Guardar</span>
		  </button>
		  <a href="#" class="" onclick="$('#idioma').modal('close'); return false;">
			<span>Cancelar</span>
		  </a>
		</center>
	  </div>
	</form>
  </div>
</div>

<div id="eliminarCoupon" class="modal modal_">

  <div class="titulo">
	<h3>
	  Esta seguro que desea eliminar esta carta
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
		  <a href="#" class="" onclick="$('#eliminarCoupon').modal('close'); return false;">
			<span>No</span>
		  </a>
		</center>
	  </div>
	</form>
  </div>
</div>


@endsection
