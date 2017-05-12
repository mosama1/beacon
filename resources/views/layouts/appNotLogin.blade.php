<?php

	use Beacon\Http\Controllers\UserController;
	use Beacon\Location;
	use Beacon\Pasos;
	use Beacon\User;

	$ultimo_paso = UserController::ultimo_paso();
	$actual = (isset($actual)) ? $actual : '';

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<base href="{{ isset($nivel) ? $nivel : '' }}" target="_parent">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="cache-control" content="no-store" />
		<meta http-equiv="cache-control" content="must-revalidate" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
		<meta http-equiv="pragma" content="no-cache" />

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}" id="_token">

		<title>Nombre de la Aplicación</title>

		<!-- Styles -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/introjs.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		{{-- <link href="css/app.css" rel="stylesheet"> --}}
		<link rel="shortcut icon" type="image/png" href="img/icons/ingrementa_clientes.png"/>
		<link href="css/jquery.filer.css" rel="stylesheet">
		<link rel="stylesheet" href="css/jquery-ui.min.css">

		<!-- Scripts -->
		<script>
			window.Laravel = "{{ json_encode(['csrfToken' => csrf_token() ]) }}";
		</script>

	</head>
	<body class="l_promotion">

		<nav class="menu" role="navigation">
			<div class="nav-wrapper container">


				@if ( !Auth::guest() )	
					<!-- <a id="logo-container" class="brand-logo logo-patrocinante logo" href="{{ Auth::guest() ? url('/') : url('home') }}"> -->
					<a id="logo-container" class="brand-logo logo-patrocinante logo" href="{{ Auth::guest() ? url('/login') : url('home') }}">
					  <?php if (Auth::user()): ?>
						@php
							$user = User::where('id', '=', Auth::user()->id)->first();

							$location = Location::where('user_id', '=', $user->user_id)->first();

							$ultimo_paso = UserController::ultimo_paso();

						@endphp
						<?php if (!empty($location)): ?>
						  <img src="{{$location->logo}}" alt="">
						  <h1>{{$location->name}}</h1>

						<?php else: ?>
						  <a href="{{ route('user_edit_path', Auth::user()->id) }}" class="titulologo">
							<h5>Recuerda Colocar tu logo</h5>
						  </a>
						<?php endif; ?>

					  <?php endif; ?>
					  <!-- <h3 class="titulologo">Logo</h3> -->
					</a>

					<ul class="right ul_principal">
						<!-- Authentication Links -->
						@if (!Auth::guest())
							<!-- Dropdown Trigger -->
							<li>
								<a class="" href="{{ Auth::guest() ? url('/login') : url('home') }}">
									<span>Inicio</span>
								</a>
							</li>
							<li class="">
							<a class="sb_mn" href="#">
								<span>Servicios <i class="material-icons right">arrow_drop_down</i></span>
							</a>
							<ul class="sub_menu none">
								<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
									<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_coupon') : '' }}">
										<span>La Carta</span>
									</a>
								</li>
								<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
									<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_timeframe') : '' }}">
										<span>Horarios</span>
									</a>
								</li>
								<li class="{{ ( $ultimo_paso >= 6 ) ? '' : 'desactivado' }}">
									<a href="{{ ( $ultimo_paso >= 6 ) ? route('all_campana') : '' }}">
										  <span>Planificación</span>
									</a>
								</li>
								<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
									<a href="{{ ( $ultimo_paso >= 2 ) ?  : '' }}" class="sb_mn2">
										<span>Servicio</span>
									</a>
									<ul class="sub_menu2">
									<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
										<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_type_plate') : '' }}">
											<span>Tipos de platos</span>
										</a>
									</li>
									<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
										<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_madiraje') : '' }}">

											<span>Madirajes</span>
										</a>
									</li>
									</ul>
								</li>
								<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
									<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_language') : '' }}">
										<span>Idiomas</span>
									</a>
								</li>
								<li>
									<a href="{{ route('all_welcome_kit') }}">
										<span>Promociones</span>
									</a>									
								</li>
							</ul>
							</li>


					        @if( $ultimo_paso == 0 and $actual != 'location_add')
					            <li data-step="1" data-intro="Debes registrar tu ubicacion">
					        @elseif($ultimo_paso == 1 and $actual != 'beacons' and $actual != 'edit')
					            <li data-step="2" data-intro="Debes registrar tu dispositivo beacon">
					        @else
					            <li>
					        @endif
								<a class="sb_mn" href="#">
									<span>Mis Datos <i class="material-icons right">arrow_drop_down</i></span>
								</a>
								<ul class="sub_menu none">						
									<li class="">
										<a class="" href="{{ route('user_edit_path', Auth::user()->id) }}">
										   <span>Mi Cuenta</span>
										</a>
									</li>

					                <li class="{{ ( $ultimo_paso >= 6 ) ? '' : 'desactivado' }}">
					                    <a href="{{ ( $ultimo_paso >= 6 ) ? url('estadisticas/') : '' }}">
											<span> Estadisticas</span>
										</a>
									</li>
								</ul>
							</li>

					            <li class="{{ ( $ultimo_paso >= 6 ) ? '' : 'desactivado' }}">
					            <a href="{{ ( $ultimo_paso >= 6 ) ? route('index_coupon_promotions') : '' }}"> 
									<span>Verificar Cupón</span>
								</a>
							</li>

							<li>
							  <a href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								  <span>Salir</span>
							  </a>

							  <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
								  {{ csrf_field() }}
							  </form>
							</li>


						@else
						<a id="logo-container" class="brand-logo logo-patrocinante logo logo_right" href="#">
						  <!-- <img src="img/logo/logo.png" alt=""> -->
						  <h3 class="logopatrocinantes">Logo patrocinante</h3>

						</a>

						@endif
					</ul>


					<!-- <ul id="nav-mobile" class="side-nav">
						<li><a href="#">Navbar Link</a></li>
					</ul> -->
					<a href="#" class="MenuResponsive"><i class="material-icons">menu</i></a>

				@else
					<ul class="right ul_principal">
						<li class="">
							<a href="{{ !Auth::guest() ? url('login') : url('home') }}">
								<span>Ingresar al Sistema</span>
							</a>
						</li>
					</ul>
					<a href="#" class="MenuResponsive"><i class="material-icons">menu</i></a>
				@endif
			</div>
		</nav>


		@yield('content')

		<footer>
			<div class="footer">
				<p>
					© {{date('Y')}} - Todos los derechos reservados. Diseñado por <a href="http://dementecreativo.com/" target="_blank"><img src="img/demente.png" alt=""></a>
				</p>
			</div>
		</footer>

		<script src="js/jquery.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/materialize.js"></script>
		<script src="js/init.js"></script>
		<script src="js/datetimepicker.min.js"></script>
		<script src="js/jquery.mask.min.js"></script>
		<script src="js/config.js"></script>
		<script src="js/intro.min.js"></script>
		<script src="js/script.js"></script>

		@if (session('status'))
			<script type="text/javascript">
				var status = "{{ session('status') }}";
				var type = "{{ session('type') }}"
				Materialize.toast(status, 5000, type);
			</script>
		@endif  

	</body>
</html>
