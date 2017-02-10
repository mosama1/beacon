@extends('layouts.app')

@section('content')

<div class="contenedor">
	<div class="principal">
		<ul class="links">
			
			<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
				<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_coupon') : '' }}">
				  <img src="img/icons/menu.png" title="Carta">
				</a>      
			</li>

			<li class="{{ ( $ultimo_paso >= 3 ) ? '' : 'desactivado' }}">
				<a href="{{ ( $ultimo_paso >= 3 ) ? route('all_timeframe') : ''}}">
					<img src="img/icons/horarios.png" title="Horarios">
				</a>
			</li>

			<li class="{{ ( $ultimo_paso >= 5 ) ? '' : 'desactivado' }}">
				<a href="{{ ( $ultimo_paso >= 5 ) ? route('all_campana') : '' }}">
					<img src="img/icons/plan.png" title="Planificación">
				</a>
			</li>

			<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
				<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_type_plate') : '' }}">
					<img src="img/icons/servicio.png" title="Servicio">
				</a>
			</li>

			<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
				<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_language') : '' }}">
					<img src="img/icons/idiomas.png" title="Idiomas">
				</a>
			</li>

			<li>
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
