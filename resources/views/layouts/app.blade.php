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

  <title>Beacons System</title>

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  {{--<link href="css/app.css" rel="stylesheet">--}}
  <link rel="shortcut icon" type="image/png" href="img/icons/ingrementa_clientes.png"/>

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
              <?php if (Auth::user()): ?>
                @php
                $locatiom = Location::where('user_id', '=', Auth::user()->id)->first();
                @endphp
                <?php if (!empty($locatiom)): ?>
                  <img src="{{$locatiom->logo}}" alt="">
                <?php endif; ?>
              <?php endif; ?>
              <!-- <h3 class="titulologo">Logo</h3> -->
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
                            <span>El Menú</span>
                          </a>
                        </li>
                        <li>
                            <a href="{{ route('show_timeframe')}}">
                                <span>Los Horarios</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('show_campana')}}">
                              <span>La Planificación</span>
                              <!-- <span>Campa&ntilde;a</span> -->
                            </a>
                        </li>
                        <li>
                          <a href="#" class="sb_mn2">
                            <span>Del Servicio</span>
                          </a>
                          <ul class="sub_menu2 delServicio">
                            <li>
                              <a href="{{ route('show_tipoPlato')}}">
                                <span>Los tipos de platos</span>
                              </a>
                            </li>
                            <li>
                                <a href="{{ route('show_language')}}">
                                  <span>Idiomas del menu</span>
                                </a>
                            </li>
                          </ul>
                        </li>

                        <li>
                          <a href="#" class="sb_mn2">
                            <span>Promociones</span>
                          </a>
                          <ul class="sub_menu2">
                            <li>
                              <a href="#kitBienvenida">
                                <span>Kit de Bienvenida</span>
                              </a>
                            </li>
                            <li>
                              <a href="#kitFidelidad">
                                <span>Kit de Fidelidad</span>
                              </a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>



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

    <div id="kitBienvenida" class="modal modal_">
      <div class="titulo">
        <h3>
          Kit de Bienvenida
        </h3>
      </div>

      <div class="form">
        <form class="form-horizontal" role="form" method="POST" action="#">
          {{ csrf_field() }}

          <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
            <input type="text" name="name" value="" required="">
            <label for="">
              <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
              <span class="text">Nombre</span>
            </label>
          </div>
          @if ($errors->has('name'))
          <div class="input_error">
            <span>{{ $errors->first('name') }}</span>
          </div>
          @endif

          <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
            <input type="text" name="name" value="" required="">
            <label for="">
              <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
              <span class="text">Nombre</span>
            </label>
          </div>
          @if ($errors->has('name'))
          <div class="input_error">
            <span>{{ $errors->first('name') }}</span>
          </div>
          @endif

          <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
            <input type="text" name="name" value="" required="">
            <label for="">
              <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
              <span class="text">Nombre</span>
            </label>
          </div>
          @if ($errors->has('name'))
          <div class="input_error">
            <span>{{ $errors->first('name') }}</span>
          </div>
          @endif
          <div class="button">
            <center>
              <button type="submit" name="button" id="guardar">
                <span>Guardar</span>
              </button>
              <a href="#" class="" onclick="$('#kitBienvenida').modal('close'); return false;">
                <span>Cancelar</span>
              </a>
            </center>
          </div>
        </form>
      </div>
    </div>

    <div id="kitFidelidad" class="modal modal_">
      <div class="titulo">
        <h3>
          Kit de Fidelidad
        </h3>
      </div>

      <div class="form">
        <form class="form-horizontal" role="form" method="POST" action="#">
          {{ csrf_field() }}

          <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
            <input type="text" name="name" value="" required="">
            <label for="">
              <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
              <span class="text">Nombre</span>
            </label>
          </div>
          @if ($errors->has('name'))
          <div class="input_error">
            <span>{{ $errors->first('name') }}</span>
          </div>
          @endif

          <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
            <input type="text" name="name" value="" required="">
            <label for="">
              <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
              <span class="text">Nombre</span>
            </label>
          </div>
          @if ($errors->has('name'))
          <div class="input_error">
            <span>{{ $errors->first('name') }}</span>
          </div>
          @endif

          <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
            <input type="text" name="name" value="" required="">
            <label for="">
              <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
              <span class="text">Nombre</span>
            </label>
          </div>
          @if ($errors->has('name'))
          <div class="input_error">
            <span>{{ $errors->first('name') }}</span>
          </div>
          @endif
          <div class="button">
            <center>
              <button type="submit" name="button" id="guardar">
                <span>Guardar</span>
              </button>
              <a href="#" class="" onclick="$('#kitFidelidad').modal('close'); return false;">
                <span>Cancelar</span>
              </a>
            </center>
          </div>
        </form>
      </div>
    </div>

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
