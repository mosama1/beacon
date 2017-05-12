<!DOCTYPE html>
<html lang="en">
	<head>
		<base href="{{ isset($nivel) ? $nivel : '' }}localhost" target="_self">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>Nombre de la Aplicación</title>

		<link href="{{asset('css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>

		<!-- Scripts -->
		<script>
			window.Laravel = "<?php echo json_encode(['csrfToken' => csrf_token(), ]); ?>"
		</script>
	</head>
	<body>

		@yield('content')

		<!--  Scripts-->
		<!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
		<script src="js/jquery.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/materialize.js"></script>
		<script src="js/init.js"></script>
		<script src="js/datetimepicker.min.js"></script>
		<script src="js/jquery.mask.min.js"></script>
		<script src="js/config.js"></script>
	    <script src="js/intro.min.js"></script>
	    <script src="js/script.js"></script>		
	</body>
</html>
