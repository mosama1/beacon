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
		<!-- Scripts -->
		<script>
			window.Laravel = "<?php echo json_encode(['csrfToken' => csrf_token(), ]); ?>"
		</script>
	</head>
	<body>

		@yield('content')
	</body>
</html>
