<?php $nivel = '../../' ?>
@extends('layouts.app')

@section('content')
<div class="contenedor">
	<div class="principal">
		<div class="titulo">
			<h3>Descripción del Plato</h3>
		</div>

		<div class="form">
			@if (session('status'))
				<span class="help-block">
					<strong>{{ session('status') }}</strong>
				</span>
			@endif

			<form class="form-horizontal form_send" role="form" method="POST" enctype="multipart/form-data"  action="{{ route('store_plate', $menu_id) }}">
				{{ csrf_field() }}

				<input type="hidden" name="menu_id" value="{{$menu_id}}" required>

				<div class="input no_icon textarea {{ $errors->has('description') ? 'error' : '' }}">
					<textarea name="description" rows="8" cols="80"></textarea>
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

				<div class="file-field input-field input_file {{ $errors->has('plato') ? 'has-error' : '' }}" >
					<div class="btn">
						<span class="icon"><img src="img/icons/subir_archivo.png" alt=""></span>
						<span>Plato</span>
						<input type="file" name="plato" id="addPlato">
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
						<div class="img" id="vista_plato">
						</div>
					</center>
				</div>

				<div class="input no_icon textarea {{ $errors->has('madiraje') ? 'error' : '' }}">
					<textarea name="madiraje" rows="8" cols="80"></textarea>
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

				<div class="file-field input-field input_file {{ $errors->has('img_madiraje') ? 'has-error' : '' }}" >
					<div class="btn">
						<span class="icon"><img src="img/icons/subir_archivo.png" alt=""></span>
						<span>Foto madiraje</span>
						<input type="file" name="img_madiraje" id="addImg_madiraje">
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

				@if ($errors->has('img_madiraje'))
					<div class="input_error">
						<span>{{ $errors->first('img_madiraje') }}</span>
					</div>
				@endif

				<div class="vista_previa">
					<center  id="vista_previa">
						<div class="img" id="vista_madiraje">
						</div>
					</center>
				</div>


				<!-- vista_previa -->

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
						  <div class="input no_icon textarea {{ $errors->has('language_description') ? 'error' : '' }}">
		  					<textarea name="language_description[]" rows="8" cols="80"></textarea>
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
							<textarea name="language_madiraje[]" rows="8" cols="80"></textarea>
							<label for="">
								<span class="text">Madiraje (Opcional)</span>
							</label>
						</div>
						@if ($errors->has('language_madiraje'))
							<div class="input_error">
								<span>{{ $errors->first('language_madiraje') }}</span>
							</div>
						@endif

					  </div>
					@endforeach
				</div>
				<div class="button">
					<center>
						<button type="submit" name="button" class="send_form">
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
