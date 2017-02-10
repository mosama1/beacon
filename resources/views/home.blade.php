<?php
$actual = 'home';
?>
@extends('layouts.app')

@section('content')

<div class="contenedor">
	<div class="principal">
		<ul class="links">
			@if( $ultimo_paso == 2 and $actual == 'home')
				<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}" data-step="3" data-intro="Debes crear La Carta">
			@else
				<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
			@endif
				<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_coupon') : '' }}">
				  <img src="img/icons/menu.png" title="Carta">
				</a>
			</li>

			@if( $ultimo_paso == 2 and $actual == 'home')
				<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}" data-step="4" data-intro="Debes crear Horarios">
			@else
				<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
			@endif
				<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_timeframe') : ''}}">
					<img src="img/icons/horarios.png" title="Horarios">
				</a>
			</li>

			<li class="{{ ( $ultimo_paso >= 6 ) ? '' : 'desactivado' }}">
				<a href="{{ ( $ultimo_paso >= 6 ) ? route('all_campana') : '' }}">
					<img src="img/icons/plan.png" title="Planificación">
				</a>
			</li>

			@if( $ultimo_paso == 2 and $actual == 'home')
				<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}" data-step="5" data-intro="Debes crear Tipos de platos">
			@else
				<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
			@endif
				<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_type_plate') : '' }}">
					<img src="img/icons/servicio.png" title="Servicio">
				</a>
			</li>

			@if( $ultimo_paso == 2 and $actual == 'home')
				<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}" data-step="6" data-intro="Puedes Crear idiomas">
			@else
				<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
			@endif
				<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_language') : '' }}">
					<img src="img/icons/idiomas.png" title="Idiomas">
				</a>
			</li>


				@if( $ultimo_paso == 2 and $actual == 'home')
					<li data-step="7" data-intro="Puedes Crear Promociones">
				@else
					<li>
				@endif
				<a href="#" onclick="return false;">
					<img src="img/icons/promociones.png" title="Promociones">
				</a>
				<ul>
					<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
						<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_welcome_kit') : '' }}">
							<span>Kit de <br>Bienvenida</span>
						</a>
					</li>
					<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
						<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_fidelity_kit') : '' }}">
							<span>Kit de <br>Fidelidad</span>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>

@endsection
