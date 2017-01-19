<!DOCTYPE html>
<html lang="en">
<head>
  <base href="{{ isset($nivel) ? $nivel : '' }}localhost" target="_parent">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  {{--<link href="css/app.css" rel="stylesheet">--}}
  <!-- Scripts -->
  <script>
      window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(), ]); ?>
  </script>

</head>
<body style="background-image: url(../img/fondos/completo.jpg);" class="clienteFinal {{ isset($menu2) ? 'meu2' : '' }}">
  <div class="preload">
    <div class="img">
      <!-- <img src="img/logo/logo1.png" alt=""> -->
      <h2 style="color: #fff;">LOGO</h2>
    </div>
  </div>
    <nav class="menu_cliente" role="navigation">
      @if(isset($menu2))
      <!-- <div class="menu_head">
      <div class="logo">
      <img src="img/logo/logo.png" alt="">
    </div>
    <div class="name">

    </div>
    </div> -->

    @endif
        <div class="nav-wrapper">
          <ul>
            <li class="opciones">
              <ul class="sub_menu">
              	@php
                  use Beacon\Section;
                  use Beacon\SectionTranslation;

              		$sections = Section::all();
              	@endphp
              	@foreach($sections as $s)
                  <?php  $s->section_translation; ?>
	                <li>
	                  <a href="{{ route('showPlate', $s->id) }}">
	                    <span>
                        @if( ! empty($s->section_translation[0]) )
                          {{$s->section_translation[0]->name}}
                        @endif
	                    </span>
	                  </a>
	                </li>
                @endforeach
              </ul>
              <a href="#" class="sb_mn">
                <img src="img/icons/menu_cliente.png" alt="">
              </a>
            </li>
            @if(isset($menu2))
            <li class="logo">
              <img src="img/logo/logo1.png" alt="">
            </li>
            @endif
            <li class="idioma">
              <ul class="sub_menu">
                <li>
                  <a href="#">
                    <span>
                      ejemplo
                    </span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span>
                      ejemplo
                    </span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span>
                      ejemplo
                    </span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span>
                      ejemplo
                    </span>
                  </a>
                </li>
              </ul>

              <a href="#" class="sb_mn">
                <img src="img/icons/idioma_cliente.png" alt="">
              </a>
            </li>
          </ul>


        </div>
    </nav>


    @yield('content')

    <footer>
      <!-- <div class="footer">
        <p>
          Xxxxxxx © {{date('Y')}} - Todos los derechos reservados. Diseñado por <a href="#"><img src="img/demente.png" alt=""></a>
        </p>
      </div> -->
    </footer>

    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
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
