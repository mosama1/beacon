@php
	use Beacon\Location;
	use Beacon\User;
	use Beacon\Campana;

	$campana = Campana::where([
	  ['campana_id', '=', array( $campana_id ) ],
	])->first();

	$location = Location::where([
	  ['location_id', '=', array( $campana->location_id ) ],
	])->first();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <base href="{{ isset($nivel) ? $nivel : '' }}localhost" target="_parent">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Nombre de la Aplicación</title>

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  {{--<link href="css/app.css" rel="stylesheet">--}}
  <!-- Scripts -->
  <script>
	  window.Laravel = "<?php echo json_encode(['csrfToken' => csrf_token(), ]); ?>"
  </script>

</head>
<body style="" class="clienteFinal {{ isset($menu2) ? 'meu2' : '' }}">
  <div class="preload">
	<div class="img">
	  <img src="{{ $location->logo }}" alt="">

	</div>
  </div>
  {{-- Si esa habilitada la carta mostrar menu --}}

  @if( $campana->status == 1 )
	<nav class="menu_cliente" role="navigation">
		<div class="nav-wrapper">
		  <ul>
			<li class="opciones">
			  <ul class="sub_menu none">
				@foreach($sections as $s)
					@if ( $s->status != 0 )
					  <?php  $s->section_translation; ?>
						<li>
						  <a href="{{ route('movil_all_plate', array('campana_id' => $campana_id, 'section_id' => $s->id) ) }}"> -- {{ $s->status }} --
							<span>
							@if( ! empty($s->section_translation[0]) )
							  {{$s->section_translation[0]->name}} {{ (!empty($s->price)) ? $s->price.' €' : '' }}

							@endif
							</span>
						  </a>
						</li>
					@endif						
				@endforeach
			  </ul>
			  <a href="#" class="sb_mn">
				<img src="img/icons/menu_cliente.png" alt="">
			  </a>
			</li>
			@if(isset($menu2))
			<li class="logo">
			  <img src="{{ $location->logo }}" alt="">
			</li>
			@endif
			<li class="idioma">
			  <ul class="sub_menu none">


				@if( !empty($type_plates) )
				  @foreach ($type_plates as $type_plate)
					<li>
					  <a href="{{ route('movil_all_types_plates', array( 'campana_id' => $campana_id, 'type_plate_id' => $type_plate->id ) ) }}">
						<span>
						  {{$type_plate->name}}
						</span>
					  </a>
					</li>
				  @endforeach

				@endif

			  </ul>

			  <a href="#" class="sb_mn">
				<img src="img/icons/filtro.png" alt="">
			  </a>
			</li>
		  </ul>


		</div>
		@if(isset($menu2))
		<div class="nombreEmpresa">
		  <h4>
			{{ $location->name }}
		  </h4>
		</div>
		@endif
	</nav>
  @endif


	@yield('content')

	<footer>
	  <div class="footer">
		<p>
		  © {{date('Y')}} - Todos los derechos reservados. Diseñado por <a href="http://dementecreativo.com/" target="_blank"><img src="img/demente.png" alt=""></a>
		</p>
	  </div>
	</footer>

	<!--  Scripts-->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="js/materialize.js"></script>
	<script src="js/init.js"></script>
	<script src="js/jquery.mask.min.js"></script>

	<script src="js/script.js"></script>

	@if (session('status'))
	<script type="text/javascript">
	  var status = "{{ session('status') }}";
	  var type = "{{ session('type') }}"
	  Materialize.toast(status, 5000, type);
	</script>
	@endif

	<script type="text/javascript">
	  $('.menu_cliente .logo').click(function(){
		window.location.href = 'movil/campanas/{{ $campana_id }}';
	  });
	</script>


</body>
</html>
