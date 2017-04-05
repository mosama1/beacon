<?php $nivel = '../../' ?>

@extends('layouts.app')
@section('content')
<div class="contenedor">
	<div class="principal">
		<div class="titulo">
			<h3>
				Editar Maridaje
			</h3>
		</div>
		<div class="form">
			 <form class="form-horizontal form_send" role="form" method="POST" action="{{ route('update_madiraje',$madiraje->id) }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
			<div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
				<input type="text" name="name" value="{{ $madiraje->nombre}}" required="">
				<label for="">
					<span class="text">Nombre</span>
				</label>
			</div>
			@if ($errors->has('name'))
				<div class="input_error">
						<span>{{ $errors->first('name') }}</span>
				</div>
			@endif
			<div class="input no_icon {{ $errors->has('price') ? 'error' : '' }}" style="display:">

				<input type="number" name="price" required="" min="1" max="99999" step="any" id="madiraje_price"  value="{{ $madiraje->precio}}">
				<label for="">
					<span class="text">Precio 0,00 €</span>
				</label>
			</div>
			@if ($errors->has('price'))
				<div class="input_error">
						<span>{{ $errors->first('price') }}</span>
				</div>
			@endif
			  <div class="vista_previa {{ (!empty($madiraje->foto)) ? 'active' : '' }}">
				<center  id="vista_previa">
				  <a href="#" class="vistaPreviaImg">
					<div class="img {{ (!empty($madiraje->foto)) ? 'active' : '' }}" id="vista_photo">
						<img class="thumb" src="{{ $madiraje->foto }}" alt="" > 
					</div>
				  </a>
				</center>
			  </div>
			  
			<div class="divide_cont files">
			  <div class="file-field input-field input_file {{ $errors->has('photo') ? 'has-error' : '' }}">
				<div class="btn">
				  <span class="icon"><img src="img/icons/subir_archivo.png" alt=""></span>
				  <span>Subir Foto</span>
				  <input type="file" name="photo" id="addPhoto" value="{{ $madiraje->foto }}">
				</div>
				<div class="file-path-wrapper">
				  <input class="file-path validate" type="text">
				</div>
			  </div>
			  @if ($errors->has('photo'))
			  <div class="error_input">
				<span>{{ $errors->first('photo') }}</span>
			  </div>
			  @endif				
			</div>
				<div class="button">
					<center>
						<button type="submit" name="button" id="guardar" class="send_form">
							<span>Guardar</span>
						</button>
						<a href="{{ route('all_madiraje') }}" class="">
							<span>Cancelar</span>
						</a>
					</center>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
