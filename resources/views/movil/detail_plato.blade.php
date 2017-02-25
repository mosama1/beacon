<?php
$nivel = (isset($nivel)) ? $nivel : '../../../../../../' ;
$menu2 = '';
?>
@extends('layouts.appFinal')

@section('content')
<div class="contenedor cliente_final">
  <div class="principal">
	<div class="titulo">
	  <h3>
		<!-- @if( ! empty($menu->menu_translation[0]) )
		  {{$menu->menu_translation[0]->name}}
		@endif -->

		@if( isset($language_id) )
			@foreach ($menu->menu_translation as $menu_)
				@if($menu_->language_id == $language_id)
					{{$menu_->name}}
				@endif
			@endforeach
		@else
			@if( ! empty($menu->menu_translation[0]) )
			  {{$menu->menu_translation[0]->name}}
			@endif
		@endif


	  </h3>
	  <h4>
		{{$menu->price}} €
	  </h4>
	</div>

	<div class="inf">

	  <div class="description">
		<p>
			@if( isset($language_id) )
				@foreach ($menu->plate->plate_translation as $plate)
					@if($plate->language_id == $language_id)
					{{$plate->description}}
					@endif
				@endforeach
			@else
				{{$menu->plate->plate_translation[0]->description}}
			@endif
		</p>

	  </div>
	  <div class="img">
		@if($menu->plate->img != NULL OR !empty($menu->plate->img))
		<img alt="" src="{{ asset($menu->plate->img) }}">
		@endif
	  </div>

	</div>

	<p class="mensaje__">Este plato se recomienda con: </p>
	<div class="inf">

	  <div class="description">
		<p>
			@if( isset($language_id) )
				@foreach ($menu->plate->plate_translation as $plate)
					@if($plate->language_id == $language_id)
					{{$plate->madiraje}}
					@endif
				@endforeach
			@else
				{{$menu->plate->plate_translation[0]->madiraje}}
			@endif
		</p>

	  </div>

	  <div class="img">
		@if (!empty($menu->plate->madiraje_photo))
			@for ($mp = 0; $mp < count($menu->plate->madiraje_photo); $mp++)
				<div class="img_maridaje">
					<img src="{{$menu->plate->madiraje_photo[$mp]->img_madiraje}}" alt="" >
				</div>
			@endfor
		@endif
	  </div>

      <div class="titulo" style="padding-top: 10px">
        <h3>
            Precio del Madiraje
        </h3>
        <h4>
          {{$menu->plate->plate_translation[0]->price_madiraje}} €
        </h4>
      </div>

	</div>




	<div class="agregar regresar">
	  <center>
		<a href="{{ route('movil_all_plate', array('campana_id' => $campana_id, 'section_id' => $menu->section_id, 'menu_id' => $menu->menu_id, 'language_id' => $language_id) ) }}" class="waves-effect">
		  <div class="">
			<span class="text">Regresar</span>
			<span class="icon"><i class="material-icons">reply</i></span>
		  </div>
		</a>
	  </center>
	</div>
  </div>
</div>

@endsection
