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
  <link href="css/app.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="img/icons/ingrementa_clientes.png"/>
  <link href="css/jquery.filer.css" rel="stylesheet">
  <link rel="stylesheet" href="css/jquery-ui.min.css">

  <!-- Scripts -->
  <script>
	 window.Laravel = "{{ json_encode(['csrfToken' => csrf_token() ]) }}";
  </script>

</head>
<body>
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
