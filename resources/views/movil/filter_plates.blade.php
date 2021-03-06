<?php
  $nivel = '../../../../../../';
  $menu2 = '';

?>
@php
use Beacon\Plate;
use Beacon\Section;
@endphp

@extends('layouts.appFinal')

@section('content')

<div class="contenedor cliente_final {{(isset($menu2)) ? 'padding_top' : '' }}">
  <div class="principal" style="padding: 0;">
	<div class="titulo _1">
	  <h3>
		Carta
	  </h3>
	</div>

	<div class="beacons seccion">
	  <!-- <div class="container"> -->
		<div class="tabla">
		  <table class="bordered centered">
			<thead>
			  <tr>
				  <th data-field="id" style="text-transform: capitalize;">{{ $type_plate->name }}</th>
				  <th data-field="id">Precio</th>
				  <th data-field="name"></th>
			  </tr>
			</thead>
			<tbody>
			  @foreach($menus as $p)
				@php
				  $plate = plate::where([
				  ['menu_id', '=', $p->id ],
				  ])->first();

				  $section = Section::where([
				  ['id', '=', $p->section_id ],
				  ])->first();
				@endphp

				@if ( $p->status != 0 )
				<tr id='{{$p->id}}'>
				  <td>
                    @if( isset($language_id) )
                        @foreach ($p->menu_translation as $plate)
                            @if($plate->language_id == $language_id)
                            {{$plate->name}}
                            @endif
                        @endforeach
                    @else
                        @if( ! empty($p->menu_translation[0]) )
                          {{$p->menu_translation[0]->name}}
                        @endif
                    @endif
				  </td>
				  <td>
					@if( empty($section->price) )
					  {{$p->price}} €
					@else
					  {{$section->price}} €
					@endif
				  </td>
				  <td>
					@if ($plate != NULL)
					<a href="{{ route('show_desc_plate_by_type', array('campana_id' => $campana_id, 'type_plate' => $type_plate->id, 'menu_id' => $p->id, 'language_id' => $language_id ) ) }}"  target="_self"><i class="material-icons">remove_red_eye</i></a>
					@endif
				  </td>
				</tr>
				@endif

			  @endforeach
			</tbody>
		  </table>
		</div>
	  <!-- </div> -->
	</div>

	<!--BOTON REGRESAR-->
		<div class="agregar regresar">
		  <center>
			<a href="{{ route('inicio_language', array( 'campana_id' => $campana_id, 'language_id' => $language_id ) ) }}" class="waves-effect"  target="_self">
			  <div class="">
				<span class="text">Regresar</span>
				<span class="icon"><i class="material-icons">reply</i></span>
			  </div>
			</a>
		  </center>
		</div>
	<!--BOTON REGRESAR-->

  </div>
</div>
@endsection
