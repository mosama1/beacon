<?php $nivel = '../../' ?>
@extends('layouts.app')

@section('content')
<div class="contenedor">
	<div class="principal">
		<div class="titulo">
			<h3>
				Descripción del Plato
			</h3>
		</div>

		<div class="form">
			@if (session('status'))
				<span class="help-block">
					<strong>{{ session('status') }}</strong>
				</span>
			@endif
			<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ route('update_plate', $menu_id) }}">
				{{ csrf_field() }}

				<input type="hidden" name="_method" value="PUT">

				<div class="input no_icon textarea {{ $errors->has('description') ? 'error' : '' }}">
					<textarea name="description" rows="8" cols="80">{{$plate->plate_translation->description}}</textarea>
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

				<div class="input no_icon textarea {{ $errors->has('madiraje') ? 'error' : '' }}">
					<textarea name="madiraje" rows="8" cols="80">{{$plate->plate_translation->madiraje}}</textarea>
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
						<input type="file" name="img_madiraje" id="addmadiraje" value="{{$plate->img_madiraje}}">
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

				<div class="vista_previa">
					<center  id="vista_previa">
						<div class="img {{ (!empty($plate->img_madiraje)) ? 'active' : '' }}" id="vista_madiraje">
							@if (!empty($plate->img_madiraje))
								<img src="{{($plate->img_madiraje)}}" alt="">
							@endif
						</div>
					</center>
				</div>

				<!-- vista_previa -->
				<div class="button">
					<center>
						<button type="submit" name="button">
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
