<?php
use Beacon\Location;
use Beacon\User;
?>
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
      window.Laravel = "<?php echo json_encode(['csrfToken' => csrf_token(), ]); ?>";
  </script>

</head>
<body>
    <nav class="menu" role="navigation">
        <div class="nav-wrapper container">

          <!-- <a id="logo-container" class="brand-logo logo-patrocinante logo" href="{{ Auth::guest() ? url('/') : url('home') }}"> -->
            <a id="logo-container" class="brand-logo logo-patrocinante logo" href="{{ Auth::guest() ? url('/login') : url('home') }}">
              <!-- <img src="img/logo/logo.png" alt=""> -->
              <h3 class="titulologo">Logo</h3>
            </a>

            <ul class="right">
                <!-- Authentication Links -->
                @if (!Auth::guest())
                    <!-- Dropdown Trigger -->
                    <li class="">
                      <a class="sb_mn" href="#">
                          El Servicio <span class="caret"></span><i class="material-icons right">arrow_drop_down</i>
                      </a>
                      <ul class="sub_menu none">
                        <li>
                          <a href="{{ route('show_coupon') }}">
                            <span>El Menu</span>
                          </a>
                        </li>
                        <li>
                            <a href="{{ route('show_timeframe')}}">
                                <span>Los Horarios</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('show_campana')}}">
                              <span>La Planificacion</span>
                              <!-- <span>Campa&ntilde;a</span> -->
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('show_tipoPlato')}}">
                              <span>Los tipos de platos</span>
                              <!-- <span>Campa&ntilde;a</span> -->
                            </a>
                        </li>
                      </ul>
                    </li>


                    <!-- <ul id="dropdown2" class="dropdown-content">
                        <li>
                            <a href="{{ route('show_timeframe')}}">
                                Timeframe
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('show_campana')}}">
                                Campa&ntilde;a
                            </a>
                        </li>
                    </ul> -->
                    <li>
                        <a class="" href="{{ route('user_edit_path', Auth::user()->id) }}">
                          <span>El Usuario</span>
                            <!-- <span>{{ Auth::user()->name }}</span> -->
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


                    <!-- <ul id="dropdown1" class="dropdown-content">
                        <li>
                            <a href="{{ url('menu') }}" >
                                Menu
                            </a>
                            <a href="{{ route('user_edit_path', Auth::user()->id) }}" >
                                Perfil
                            </a>
                            <a href="{{ url('logout') }}"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                Salir
                            </a>

                            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul> -->
                @else
                <a id="logo-container" class="brand-logo logo-patrocinante logo logo_right" href="#">
                  <!-- <img src="img/logo/logo.png" alt=""> -->
                  <h3 class="logopatrocinantes">Logo<br>patrocinante</h3>

                </a>

                @endif
            </ul>

            <!-- <ul id="nav-mobile" class="side-nav">
                <li><a href="#">Navbar Link</a></li>
            </ul> -->
            <!-- <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a> -->
        </div>
    </nav>
    

    @yield('content')

    <footer>
      <div class="footer">
        <p>
          Xxxxxxx © {{date('Y')}} - Todos los derechos reservados. Diseñado por <a href="#"><img src="img/demente.png" alt=""></a>
        </p>
      </div>
    </footer>

    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <script src="js/script.js"></script>
    <script src="js/onclick.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>

    @if (session('status'))
    <script type="text/javascript">
      var status = "{{ session('status') }}";
      var type = "{{ session('type') }}"
      Materialize.toast(status, 5000, type);
    </script>
    @endif
</body>
</html>
