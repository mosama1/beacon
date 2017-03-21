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
				Descripción del Plato
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
								Se utiliza para detallar información del plato. Se vera en la aplicación móvil.
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
								Fotografía del plato que se mostrará en el móvil al seleccionar la imagen del detalle.
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
						<div class="img {{ (!empty( $plate->img )) ? 'active' : '' }}" id="vista_plato">
							@if (!empty($plate->img))
								<img src="{{($plate->img)}}" alt="">
							@endif
						</div>
					</center>
				</div>

				<p class="mensaje__">Este plato se recomienda con:</p>

				<div class="input no_icon {{ $errors->has('madiraje') ? 'error' : '' }}">
					<input type="text" name="madiraje" id="madiraje" value="" >
					<label for="">
						<span class="text">Maridaje</span>
					</label>
					<div class="help">
						<a href="#">
							<i class="material-icons">help_outline</i>
						</a>
						<div class="inf none hidden">
							<p>
								Información adicional para la bebida que se sugiere acompañar con el plato (nombre, foto y precio).
							</p>
						</div>
					</div>
				</div>
				@if ($errors->has('madiraje'))
					<div class="input_error">
							<span>{{ $errors->first('madiraje') }}</span>
					</div>
				@endif
                <div class="madiraje_select">
                    <div class="mensaje">
                        <p></p>
                    </div>
                    @foreach( $madirajes as $madiraje )
                        <div class="m_select" id="m_{{ $madiraje->id }}">
                            <input type="hidden" name="madiraje_id[]" readonly value="{{ $madiraje->id }}">
                            <span>{{ $madiraje->nombre }}</span>
                            <span class="price">{{ $madiraje->precio }} €</span>
                            <div class="icon">
                                <a href="#" class="cerrar" onclick="madirajeSelectQuitar($(this)); return false;">
                                    <i class="material-icons">clear</i>
                                </a>
                            </div>
                        </div>
                    @endforeach

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
