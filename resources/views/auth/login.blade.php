@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="section_ authenticate" id="login">
    <div class="fondo_mitad fondo_ingresar"></div>
    <div class="fondo_mitad fondo_ingresar"></div>
    <div class="divide fondo_ingresar1">
      <div class="divide_cont login">
        <form class="" role="form" method="POST" action="{{ url('/login') }}">
          {{ csrf_field() }}
          <div class="input {{ $errors->has('email') ? 'error' : '' }}">
            <input type="text" name="email" value="{{ old('email') }}"  id="email" required="">
            <label for="">
              <span class="icon"><img src="img/icons/usuario.png" alt=""></span>
              <span class="text">Correo Electronico</span>
            </label>
            @if ($errors->has('email'))
              <span class="input_error">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
          <div class="input {{ $errors->has('password') ? 'error' : '' }}">
            <input type="password" name="password" value="" id="password" required="">
            <label for="">
              <span class="icon"><img src="img/icons/3_puntos.png" alt=""></span>
              <span class="text">Contraseña</span>
            </label>
            @if ($errors->has('password'))
              <span class="input_error">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
          </div>
          <div class="login_footer">
            <div class="remind lg_foot">
              <input type="checkbox" name="remember" class="filled-in" id="filled-in-box" />
              <label for="filled-in-box">Recordarme</label>
            </div>
            <div class="recover lg_foot">
              <a href="{{ url('/password/reset') }}">
                olvido su contraseña?
              </a>
            </div>
            <div class="regist lg_foot">
              <a href="{{ url('/register') }}">
                <span>Aun no estas de alta?</span>
                <span class="_2">Date de alta como cliente.</span>
              </a>
            </div>
            <div class="button lg_foot">
              <button type="submit" name="button">
                <span>Iniciar</span><br>
                <span>Session</span>
              </button>
            </div>
          </div>

        </form>
      </div>
    </div>
    <div class="divide fondo_ingresar2">
      <div class="divide_cont new_user">
        <center>
          <div class="new_user_head">
            <div class="icon">
              <a href="#">
                <i class="material-icons">view_headline</i>
              </a>
            </div>
            <div class="text">
              <span>
                Eres Nuevo Usuario?
              </span>
            </div>
          </div>
          <div class="new_user_cont">
            <ul>
              <li>
                <a href="#">
                  <div class="icon">
                    <img src="img/icons/adquiere_kit.png" alt="">

                  </div>
                  <div class="text">
                    <span>Adquiere tu kid</span>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="icon">
                    <img src="img/icons/crea_usuario.png" alt="">

                  </div>
                  <div class="text">
                    <span>Crea tu Usuario</span>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="icon">
                    <img src="img/icons/configura_planilla.png" alt="">

                  </div>
                  <div class="text">
                    <span>Configura tus Planillas</span>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="icon">
                    <img src="img/icons/planifica_envios.png" alt="">

                  </div>
                  <div class="text">
                    <span>Planifica tus Envios</span>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <div class="icon">
                    <img src="img/icons/ingrementa_clientes.png" alt="">

                  </div>
                  <div class="text">
                    <span>¡Incrementa tus Clientes!</span>
                  </div>
                </a>
              </li>

            </ul>

            <div class="new_user_cont_footer">
              <a href="#">
                Date de alta como cliente
              </a>
            </div>
          </div>
        </center>

      </div>
    </div>
  </div>

</div>
@endsection
