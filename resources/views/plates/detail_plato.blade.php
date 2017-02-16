<?php
use Beacon\Language;
use Beacon\LanguageUser;

$nivel = '../../';
 ?>
@extends('layouts.app')

@section('content')

<div class="contenedor">
	<div class="principal">
		<div class="titulo">
			<h3>
				Descripción del Platos
			</h3>
		</div>

		<div class="form">
			@if (session('status'))
				<span class="help-block">
					<strong>{{ session('status') }}</strong>
				</span>
			@endif
			<form class="form-horizontal form_send" role="form" method="POST" enctype="multipart/form-data" action="{{ route('update_plate', $menu_id) }}">
				{{ csrf_field() }}

				<input type="hidden" name="_method" value="PUT">

				<div class="input no_icon textarea {{ $errors->has('description') ? 'error' : '' }}">
					<textarea name="description" rows="8" cols="80">{{$plate->plate_translation[0]->description}}</textarea>
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

				<div class="file-field input-field input_file {{ $errors->has('plato') ? 'has-error' : '' }}">
					<div class="btn">
						<span class="icon">
							<img src="img/icons/subir_archivo.png" alt="">
						</span>
						<span>Foto Plato</span>
						<input type="file" name="plato" id="addPlato" value="{{$plate->img}}">
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
				@if ($errors->has('plato'))
					<div class="input_error">
						<span>{{ $errors->first('plato') }}</span>
					</div>
				@endif

				<div class="vista_previa">
					<center  id="vista_previa">
						<div class="img {{ (!empty($plate->img)) ? 'active' : '' }}" id="vista_plato">
							@if (!empty($plate->img))
								<img src="{{($plate->img)}}" alt="">
							@endif
						</div>
					</center>
				</div>

				<p class="mensaje__">Este plato se recomienda con:</p>

				<div class="input no_icon textarea {{ $errors->has('madiraje') ? 'error' : '' }}">
					<textarea name="madiraje" rows="8" cols="80">{{$plate->plate_translation[0]->madiraje}}</textarea>
					<label for="">
						<span class="text">madiraje (Opcional)</span>
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
				@if ($errors->has('madiraje'))
					<div class="input_error">
						<span>{{ $errors->first('madiraje') }}</span>
					</div>
				@endif

				<div class="file-field input-field input_file {{ $errors->has('img_madiraje') ? 'has-error' : '' }}">
					<div class="btn">
						<span class="icon">
							<img src="img/icons/subir_archivo.png" alt="">
						</span>
						<span>Foto madiraje</span>
						<input type="file" name="img_madiraje[]" id="addImg_madiraje" value="{{$plate->img_madiraje}}"  multiple="multiple">
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
				@if ($errors->has('img_madiraje'))
					<div class="input_error">
						<span>{{ $errors->first('img_madiraje') }}</span>
					</div>
				@endif

				<div class="vista_previa vista_maridaje">
					<center  id="vista_previa" class="">
						<div class="img {{ (!empty($plate->img_madiraje)) ? 'active' : '' }}" id="vista_madiraje">
							@if (!empty($plate->img_madiraje))
								<img src="{{($plate->img_madiraje)}}" alt="" >
							@endif
						</div>
					</center>
				</div>



				<div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}" id="divPrecioMadiraje" style="display: {{ (!empty($plate->price_madiraje)  ?  'block;' : 'block;') }}" >
					<input type="number" name="price_madiraje" step="0.01" min="0" value="{{ $plate->price_madiraje }}"  id="price_madiraje" min="0.00"  onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)">

					<label for="">
						<span class="text">Indique el precio del Madiraje</span>
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
				<div class="input_error" id="errorPrecioMadiraje" style="display: none;">
					<span>El monto debe ser mayor a cero</span>
				</div>


				<div class="languages ppal">

					@for ($i = 1; $i < count($plate->plate_translation); $i++)
					   @php
						   $language_user = LanguageUser::where([
							   ['language_id', '=', $plate->plate_translation[$i]->language_id],
							   ['user_id', '=', Auth::user()->user_id],
							   ['status', '=', 1],
						 ])->first();
					   @endphp
					   @if($language_user)
						   @php
							   $language = Language::where([
								   ['id', '=', $language_user->language_id],
							 ])->first();
						   @endphp
						   <div class="titulo">
							   <h5>
								   <img src="{{$language->icon}}" alt="" width="30px"> {{$language->name}}
							   </h5>
						   </div>
						   <input type="hidden" name="language_id[]" value="{{$plate->plate_translation[$i]->language_id}}">
						   <div class="input no_icon textarea {{ $errors->has('language_description') ? 'error' : '' }}">
	 		  					<textarea name="language_description[]" rows="8" cols="80">{{ $plate->plate_translation[$i]->description }}</textarea>
	 		  					<label for="">
	 		  						<span class="text">Description (Opcional)</span>
	 		  					</label>
	 		  				</div>

	 		  				@if ($errors->has('language_description'))
	 		  					<div class="input_error">
	 		  						<span>{{ $errors->first('language_description') }}</span>
	 		  					</div>
	 		  				@endif

	 						<div class="input no_icon textarea {{ $errors->has('language_madiraje') ? 'error' : '' }}">
	 							<textarea name="language_madiraje[]" rows="8" cols="80">{{$plate->plate_translation[$i]->madiraje}}</textarea>
	 							<label for="">
	 								<span class="text">Madiraje (Opcional)/span>
	 							</label>
	 						</div>
	 						@if ($errors->has('language_madiraje'))
	 							<div class="input_error">
	 								<span>{{ $errors->first('language_madiraje') }}</span>
	 							</div>
	 						@endif

					   @endif
					@endfor
				</div>

				<!-- vista_previa -->
				<div class="button">
					<center>
						<button type="submit" name="button" id="guardar" class="send_form">
							<span>Guardar</span>
						</button>
						<a href="{{ route('all_menu', array('section_id' => $section_id)) }}" class="">
							<span>Cancelar</span>
						</a>
					</center>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
