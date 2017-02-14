<?php $nivel = '../../'?>

@extends('layouts.app')

@section('content')


<div class="contenedor">
	<div class="principal">
		<div class="titulo">
			<h3>
				Platos de la carta
			</h3>
		</div>

		<div class="agregar">
			<center>
				<a href="#platosMenu" class="waves-effect">
					<div class="">
						<span class="text">Agregar <br><strong>Platos de<br>la Carta</strong></span>
						<span class="icon"><i class="material-icons">add</i></span>
					</div>
				</a>
			</center>
		</div>

<!--TABLA MOSTRAR PLATOS -->
		<div class="beacons seccion">
			<div class="container">
				<div class="tabla">
				<form role="form" method="POST">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<table class="bordered centered">
						<thead>
							<tr>
								<th data-field="name">Nombre</th>
								<th data-field="type">Tipo</th>
								<th data-field="price">Precio</th>
								<th data-field="name" width="100px">Detalles</th>
								<th data-field="price" width="100px">Editar</th>
								<th data-field="price" width="100px">Eliminar</th>
								<th data-field="id" width="130px">Habilitado</th>

							</tr>
						</thead>
						<tbody>
							@foreach($menus as $m)
								<tr id='{{$m->id}}'>
									<td>
										@if( ! empty($m->menu_translation[0]) )
											{{$m->menu_translation[0]->name}}
										@endif
									</td>
									<td>{{$m->type}}</td>
									<td>
										{{ !empty($section->price) ? $section->price : $m->price }} €
									</td>
									<td><a href="{{ route('show_plate', $m->id) }}"><i class="material-icons">input</i></a></td>

									<!-- <td><a href="#Idioma"><i class="material-icons">language</i></a></td> -->
									<td><a href="{{ route( 'edit_menu', array('menu_id' => $m->id) ) }}"><i class="material-icons">edit</i></a></td>
									<?php

									echo "<td onclick= \"modal_activate('".
									route( "destroy_menu", $m->id ).
									"' , '#eliminarPlato')\" >";

									?>
									<a href="#eliminarPlato"><i class="material-icons">clear</i></a>
								</td>
								<td>
									<div class="switch">
                    					<label>
                      						Si
                      						<input id="habilitar_{{$m->id}}" type="checkbox" {{ ($m->status > 0 ? '' : 'checked') }} class="filled-in" id="filled-in-box" onclick="habilitar('#habilitar_{{$m->id}}', 'menus', '{{$m->id}}'); return false;" />
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
<!--TABLA MOSTRAR PLATOS -->


<!--BOTON REGRESAR -->
		<div class="agregar regresar">
			<center>
				<a href="{{ route('all_section', $coupon->coupon_id) }}" class="waves-effect">
					<div class="">
						<span class="text">Regresar</span>
						<span class="icon"><i class="material-icons">reply</i></span>
					</div>
				</a>
			</center>
		</div>
<!--BOTON REGRESAR -->

	</div>
</div>


<!--AGREGAR PLATO -->
<div id="platosMenu" class="modal modal_ select">
	<div class="titulo">
		<h3>
			Agregar Plato
		</h3>
	</div>

	<div class="form">
		<form class="form-horizontal form_send" role="form" method="POST" action="{{ route('store_menu') }}">
			{{ csrf_field() }}
			<input type="hidden" name="section_id" value="{{$section_id}}" required>
			<input type="hidden" name="coupon_id" value="{{$coupon->coupon_id}}" required>


			<div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
				<input type="text" name="name" value="{{session('name')}}" required="" id="menu_name">
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

			<div class="input select no_icon _100 {{ $errors->has('type') ? 'error' : '' }}">
				<select id="menu_type" class="form-control icons" name="type">


				@if( !empty($type_plates) )
          <option value="" disabled selected>Seleccion un tipo de plato</option>
					@foreach ($type_plates as $type_plate)
						<option value="{{$type_plate->id}}" {{ (session('type') == $type_plate->id) ? 'selected' : '' }}>{{$type_plate->name}}</option>
					@endforeach
				@else
					<option value="" disabled selected>No hay tipos de platos registrados</option>
				@endif
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
				<div class="mas">
					<a href="#tipoPlato">
						<i class="material-icons">add_circle_outline</i>
					</a>
				</div>
			</div>
			@if ($errors->has('type'))
			<div class="error_input">
				<span>{{ $errors->first('type') }}</span>
			</div>
			@endif

			<div class="input no_icon {{ $errors->has('price') ? 'error' : '' }}" style="display:">

				<input type="number" name="price" value="{{ (!empty($section->price)) ? $section->price : session('price') }}" required="" min="1" max="99999" step="any" id="menu_price" {{ (!empty($section->price)) ? 'readonly' : '' }}>

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

			<div class="languages">
				@foreach($languages as $language)
				  <div class="language" id="language_{{$language->id}}">
					  <input type="hidden" name="language_id[]" value="{{$language->id}}" >
					  <a href="#" class="select_language">
						  <div class="titulo">
							  <h5>
								  <img src="{{$language->icon}}" alt="" width="30px">{{$language->name}}
							  </h5>
						  </div>
					  </a>
					  <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
						  <input type="text" name="language_name[]" value="" >
						  <label for="">
							  <span class="text">Nombre</span>
						  </label>
					  </div>
					  @if ($errors->has('name'))
						  <div class="input_error">
							  <span>{{ $errors->first('name') }}</span>
						  </div>
					  @endif
				  </div>
				@endforeach
			</div>
			<div class="button">
				<center>
					<button type="submit" name="button" id="guardar" class="send_form">
						<span>Guardar</span>
					</button>
					<a href="#" class="" onclick="$('#platosMenu').modal('close'); return false;">
						<span>Cancelar</span>
					</a>
				</center>
			</div>
		</form>
	</div>
</div>


<!--ELIMINAR PLATO-->
<div id="eliminarPlato" class="modal modal_">
	<div class="titulo">
		<h3>
			Esta seguro que desea eliminar Plato
		</h3>
	</div>
	<div class="form">
		<form class="form-horizontal form_send" role="form" method="POST">
			{{ csrf_field() }}
			<input type="hidden" name="_method" value="DELETE">
			<div class="button">
				<center>
					<button type="submit" name="button" class="send_form">
						<span>Si</span>
					</button>
					<a href="#" class="" onclick="$('#eliminarPlato').modal('close'); return false;">
						<span>No</span>
					</a>
				</center>
			</div>
		</form>
	</div>
</div>
<!--ELIMINAR PLATO-->

<div id="tipoPlato" class="modal modal_">
  <div class="titulo">
    <h3>
      Agregar Tipo de Plato
    </h3>
  </div>
  <div class="form">
    <form class="form-horizontal form_send" role="form" method="POST" action="{{ route('create_tipoPlato') }}">
      {{ csrf_field() }}
			<input type="hidden" name="section_id" value="{{ $section_id }}">
			<input type="hidden" name="mod" value="add_menu" required>
			<input type="hidden" name="old_name" value="" required id="old_name">
			<input type="hidden" name="old_type" value="" required id="old_type">
			<input type="hidden" name="old_price" value="" required id="old_price">


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
        <textarea name="description" rows="8" cols="80" ></textarea>
        <label for="">
          <span class="text">Descripción (Opcional)</span>
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
      <div class="button">
        <center>
          <button type="submit" name="button" class="send_form">
            <span>Guardar</span>
          </button>
          <a href="#" class="" onclick="$('#tipoPlato').modal('close'); return false;">
            <span>Cancelar</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>


@endsection
