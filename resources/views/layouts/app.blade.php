<?php
use Beacon\Location;
use Beacon\User;
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
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Nombre de la Aplicación</title>

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  {{--<link href="css/app.css" rel="stylesheet">--}}
  <link rel="shortcut icon" type="image/png" href="img/icons/ingrementa_clientes.png"/>

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

                $locatiom = Location::where('user_id', '=', $user->user_id)->first();
                @endphp
                <?php if (!empty($locatiom)): ?>
                  <img src="{{$locatiom->logo}}" alt="">
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
                        <li>
                          <a href="{{ route('all_coupon') }}">
                            <span>La Carta</span>
                          </a>
                        </li>
                        <li>
                            <a href="{{ route('all_timeframe')}}">
                                <span>Horarios</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('all_campana')}}">
                              <span>Planificación</span>
                              <!-- <span>Campa&ntilde;a</span> -->
                            </a>
                        </li>
                        <li>
                          <a href="{{ route('all_type_plate')}}">
                            <span>Servicio</span>
                          </a>
                        </li>

                        <li>
                          <a href="{{ route('all_language')}}">
                            <span>Idiomas</span>
                          </a>
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
                            <li>
                              <a href="{{ route('all_promotion')}}">
                                <span>Promciones</span>
                              </a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>



                    <li>
                        <a class="" href="{{ route('user_edit_path', Auth::user()->id) }}">
                           <span>Mi Cuenta</span>
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

    <div id="kitBienvenida" class="modal modal_">
      <div class="titulo">
        <h3>
          Kit de Bienvenida
        </h3>
      </div>

      <div class="form">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('store_campana') }}">
          {{ csrf_field() }}

          <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
            <input type="text" name="name" value="" required="">
            <label for="">
              <span class="text">Nombre</span>
            </label>
            <div class="help">
              <a href="#">
                <i class="material-icons">help_outline</i>
              </a>
              <div class="inf none hidden">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                </p>
              </div>
            </div>
          </div>
          @if ($errors->has('name'))
            <div class="input_error">
                <span>{{ $errors->first('name') }}</span>
            </div>
          @endif
          <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
            <textarea name="description" rows="8" cols="80" ></textarea>
            <label for="">
              <span class="text">Descripción (Opcional)</span>
            </label>
            <div class="help">
              <a href="#">
                <i class="material-icons">help_outline</i>
              </a>
              <div class="inf none hidden">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                </p>
              </div>
            </div>
          </div>
          @if ($errors->has('description'))
            <div class="input_error">
                <span>{{ $errors->first('description') }}</span>
            </div>
          @endif
          <div class="input no_icon {{ $errors->has('start_time') ? 'error' : '' }}">
            <input type="text" name="start_time" value="" required="" class="datetimepicker date_mask">
            <label for="">
              <span class="text">Inicio (dd/mm/yy hh:mm)</span>
            </label>
            <div class="help">
              <a href="#">
                <i class="material-icons">help_outline</i>
              </a>
              <div class="inf none hidden">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                </p>
              </div>
            </div>
          </div>
          @if ($errors->has('start_time'))
            <div class="input_error">
                <span>{{ $errors->first('start_time') }}</span>
            </div>
          @endif

          <div class="input no_icon {{ $errors->has('end_time') ? 'error' : '' }}">
            <input type="text" name="end_time" value="" required="" class="datetimepicker date_mask">
            <label for="">
              <span class="text">Final (dd/mm/yy hh:mm)</span>
            </label>
            <div class="help">
              <a href="#">
                <i class="material-icons">help_outline</i>
              </a>
              <div class="inf none hidden">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                </p>
              </div>
            </div>
          </div>
          @if ($errors->has('end_time'))
            <div class="input_error">
                <span>{{ $errors->first('end_time') }}</span>
            </div>
          @endif

          <div class="input no_icon {{ $errors->has('num_visit') ? 'error' : '' }}">
            <input type="text" name="num_visit" value="" required="" class="num_mask">
            <label for="">
              <span class="text">Numero de Visitas</span>
            </label>
            <div class="help">
              <a href="#">
                <i class="material-icons">help_outline</i>
              </a>
              <div class="inf none hidden">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                </p>
              </div>
            </div>
          </div>
          @if ($errors->has('num_visit'))
            <div class="input_error">
                <span>{{ $errors->first('num_visit') }}</span>
            </div>
          @endif

          <div class="divide_cont files">
            <div class="file-field input-field input_file {{ $errors->has('img') ? 'has-error' : '' }}">
              <div class="btn">
                <span class="icon"><img src="img/icons/subir_archivo.png" alt=""></span>
                <span>Subir Logo</span>
                <input type="file" name="img" id="addKit_b">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
              <div class="help">
                <a href="#">
                  <i class="material-icons">help_outline</i>
                </a>
                <div class="inf none hidden">
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                  </p>
                </div>
              </div>
            </div>
            @if ($errors->has('img'))
            <div class="error_input">
              <span>{{ $errors->first('img') }}</span>
            </div>
            @endif
            <div class="vista_previa">
              <center  id="vista_previa">
                <!-- <a href="#" class="vistaPreviaImg"> -->
                  <div class="img" id="vista_kit_b">
                  </div>
                <!-- </a> -->

              </center>
            </div>
          </div>




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
        <form class="form-horizontal" role="form" method="POST" action="{{ route('store_campana') }}">
          {{ csrf_field() }}

          <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
            <input type="text" name="name" value="" required="">
            <label for="">
              <span class="text">Nombre</span>
            </label>
            <div class="help">
              <a href="#">
                <i class="material-icons">help_outline</i>
              </a>
              <div class="inf none hidden">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                </p>
              </div>
            </div>
          </div>
          @if ($errors->has('name'))
            <div class="input_error">
                <span>{{ $errors->first('name') }}</span>
            </div>
          @endif
          <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
            <textarea name="description" rows="8" cols="80" ></textarea>
            <label for="">
              <span class="text">Descripción (Opcional)</span>
            </label>
            <div class="help">
              <a href="#">
                <i class="material-icons">help_outline</i>
              </a>
              <div class="inf none hidden">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                </p>
              </div>
            </div>
          </div>
          @if ($errors->has('description'))
            <div class="input_error">
                <span>{{ $errors->first('description') }}</span>
            </div>
          @endif
          <div class="input no_icon {{ $errors->has('start_time') ? 'error' : '' }}">
            <input type="text" name="start_time" value="" required="" class="datetimepicker date_mask">
            <label for="">
              <span class="text">Inicio (dd/mm/yy hh:mm)</span>
            </label>
            <div class="help">
              <a href="#">
                <i class="material-icons">help_outline</i>
              </a>
              <div class="inf none hidden">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                </p>
              </div>
            </div>
          </div>
          @if ($errors->has('start_time'))
            <div class="input_error">
                <span>{{ $errors->first('start_time') }}</span>
            </div>
          @endif

          <div class="input no_icon {{ $errors->has('end_time') ? 'error' : '' }}">
            <input type="text" name="end_time" value="" required="" class="datetimepicker date_mask">
            <label for="">
              <span class="text">Final (dd/mm/yy hh:mm)</span>
            </label>
            <div class="help">
              <a href="#">
                <i class="material-icons">help_outline</i>
              </a>
              <div class="inf none hidden">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                </p>
              </div>
            </div>
          </div>
          @if ($errors->has('end_time'))
            <div class="input_error">
                <span>{{ $errors->first('end_time') }}</span>
            </div>
          @endif

          <div class="input no_icon {{ $errors->has('num_visit') ? 'error' : '' }}">
            <input type="text" name="num_visit" value="" required="" class="num_mask">
            <label for="">
              <span class="text">Numero de Visitas</span>
            </label>
            <div class="help">
              <a href="#">
                <i class="material-icons">help_outline</i>
              </a>
              <div class="inf none hidden">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                </p>
              </div>
            </div>
          </div>
          @if ($errors->has('num_visit'))
            <div class="input_error">
                <span>{{ $errors->first('num_visit') }}</span>
            </div>
          @endif

          <div class="divide_cont files">
            <div class="file-field input-field input_file {{ $errors->has('img') ? 'has-error' : '' }}">
              <div class="btn">
                <span class="icon"><img src="img/icons/subir_archivo.png" alt=""></span>
                <span>Subir Logo</span>
                <input type="file" name="img" id="addKit_f">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
              <div class="help">
                <a href="#">
                  <i class="material-icons">help_outline</i>
                </a>
                <div class="inf none hidden">
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                  </p>
                </div>
              </div>
            </div>
            @if ($errors->has('img'))
            <div class="error_input">
              <span>{{ $errors->first('img') }}</span>
            </div>
            @endif
            <div class="vista_previa">
              <center  id="vista_previa">
                <!-- <a href="#" class="vistaPreviaImg"> -->
                  <div class="img" id="vista_kit_f">
                  </div>
                <!-- </a> -->

              </center>
            </div>
          </div>




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
    <!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
    <script src="js/jquery.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <script src="js/datetimepicker.min.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/script.js"></script>
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
