<?php

use Beacon\Http\Controllers\UserController;

use Beacon\Location;
use Beacon\User;
use Beacon\Pasos;

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

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">  

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/introjs.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  {{--<link href="css/app.css" rel="stylesheet">--}}
  <link rel="shortcut icon" type="image/png" href="img/icons/ingrementa_clientes.png"/>
  <link href="css/jquery.filer.css" rel="stylesheet">

  <!-- Scripts -->
  <script>
	 window.Laravel = "{{ json_encode(['csrfToken' => csrf_token() ]) }}";
  </script>

</head>
<body>
	<nav class="menu" role="navigation">
		<div class="nav-wrapper container">

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
							<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_type_plate') : '' }}">
								<span>Servicio</span>
							</a>
						</li>
                        <li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
                            <a href="{{ ( $ultimo_paso >= 2 ) ? route('all_language') : '' }}">
                                <span>Idiomas</span>
                            </a>
                        </li>


						<li>
						<a href="#" class="sb_mn2">
						<span>Promociones</span>
						</a>
							<ul class="sub_menu2">
							<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
								<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_welcome_kit') : '' }}">
									<span>Kit de Bienvenida</span>
								</a>
							</li>
							<li class="{{ ( $ultimo_paso >= 2 ) ? '' : 'desactivado' }}">
								<a href="{{ ( $ultimo_paso >= 2 ) ? route('all_fidelity_kit') : '' }}">
									<span>Kit de Fidelidad</span>
								</a>
							</li>
							</ul>
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
						<a class="" href="{{ route('user_edit_path', Auth::user()->id) }}">
						   <span>Mi Cuenta</span>
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
                    <!-- <li>
                        <a class="introduccion" href="javascript:void(0);" onclick="javascript:startTour();">
                           <span>Intro</span>
                        </a>

                    </li> -->

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

	<div class="vistaPrevia none">
	  <div class="cerrar">

	  </div>
	  <div class="container">
		<ul>
		  <li>
			<div class="vista">
			  <div class="header">
				<div class="iconMenu">
				  <img src="img/icons/menu_cliente.png" alt="">
				</div>
			  </div>
			  <div class="content">
				<div class="vistaInicio">
				  <div class="centrar">
					<div class="logo">
					  <img src="img/logo/logo1.png" alt="">
					</div>
					<div class="titulo">
					  <h3>Nombre de Locacion</h3>
					</div>
				  </div>

				</div>
			  </div>
			</div>
		  </li>
		  <li>
			<div class="vista">
			  <div class="header">
				<div class="iconMenu">
				  <img src="img/icons/menu_cliente.png" alt="">
				</div>
				<div class="logo">
				  <img src="img/logo/logo1.png" alt="">
				</div>
			  </div>
			</div>
		  </li>
		</ul>
	  </div>

	</div>





	<!--  Scripts-->
	<!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
	<script src="js/jquery.js"></script>
	<script src="js/materialize.js"></script>
	<script src="js/init.js"></script>
	<script src="js/datetimepicker.min.js"></script>
	<script src="js/jquery.mask.min.js"></script>
	<script src="js/config.js"></script>
    <script src="js/intro.min.js"></script>
    <script src="js/script.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
	<script src="js/jquery.filer.min.js" type="text/javascript"></script>
	<script src="js/custom.js" type="text/javascript"></script>

    <script type="text/javascript">
        function startTour() {
            var tour = introJs()
            tour.setOption('tooltipPosition', 'auto');
            tour.setOption('positionPrecedence', ['left', 'right', 'bottom', 'top'])
            tour.start()
        }


    </script>

	@if (session('status'))
	<script type="text/javascript">
	  var status = "{{ session('status') }}";
	  var type = "{{ session('type') }}"
	  Materialize.toast(status, 5000, type);
	</script>
	@endif

	@if (session('mod'))
	<script type="text/javascript">
	  $(document).ready(function(){
		$('#platosMenu').modal('open');
	  });
	</script>
	@endif
</body>
</html>
