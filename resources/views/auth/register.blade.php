@extends('layouts.app')

@section('content')
<div class="contenedor">
  <div class="section_ authenticate divide_100" id="register">
    <div class="fondo_mitad fondo_reg_user"></div>
    <div class="fondo_mitad fondo_dat_ris"></div>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
      {{ csrf_field() }}

      <div class="divide reg_user">
        <div class="titulo">
          <h5>Registro de usuario</h5>
        </div>
        <div class="divide_cont">
          <div class="input select {{ $errors->has('language') ? 'error' : '' }}">
            <img src="img/icons/idioma.png" alt="" class="icon">
            <select id="language" class="form-control icons" name="language" required="required">
              <option value="" disabled selected>Idioma</option>
              <option value="Castellano" selected data-icon="img/icons/es.png" class="left circle">Castellano</option>
              <option value="Catalán" data-icon="img/icons/en.png" class="left circle">Catalám</option>

            </select>
          </div>
          @if ($errors->has('language'))
          <div class="input_error">
            <span>{{ $errors->first('language') }}</span>
          </div>
          @endif

          <div class="input {{ $errors->has('email') ? 'error' : '' }}">
            <input type="email" name="email" value="{{ old('email') }}" required="">
            <label for="">
              <span class="icon"><img src="img/icons/correo.png" alt=""></span>
              <span class="text">Correo</span>
            </label>
          </div>
          @if ($errors->has('email'))
          <div class="input_error">
            <span>{{ $errors->first('email') }}</span>
          </div>
          @endif
          <div class="input {{ $errors->has('phone') ? 'error' : '' }}">
            <input type="text" name="phone" value="{{ old('phone') }}" required="" class="val_phone">
            <label for="">
              <span class="icon"><img src="img/icons/telefono.png" alt=""></span>
              <span class="text">Teléfono de contacto</span>
            </label>
          </div>
          @if ($errors->has('phone'))
          <div class="input_error">
            <span>{{ $errors->first('phone') }}</span>
          </div>
          @endif
          <div class="input {{ $errors->has('password') ? 'error' : '' }}">
            <input type="password" name="password" value="{{ old('password') }}" required="">
            <label for="">
              <span class="icon"><img src="img/icons/contrasena.png" alt=""></span>
              <span class="text">Contraseña</span>
            </label>
          </div>
          @if ($errors->has('password'))
          <div class="input_error">
            <span>{{ $errors->first('password') }}</span>
          </div>
          @endif
          <div class="input {{ $errors->has('password_confirmation') ? 'error' : '' }}">
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" required="">
            <label for="">
              <span class="icon"><img src="img/icons/3_puntos.png" alt=""></span>
              <span class="text">Confirmar Contraseña</span>
            </label>
            @if ($errors->has('password_confirmation'))
            <div class="input_error">
              <span>{{ $errors->first('password_confirmation') }}</span>
            </div>
            @endif
          </div>
        </div>

        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Guardar</span>
            </button>
            <a href="{{ url('/login') }}" class="">
              <span>Cancelar</span>
            </a>
          </center>


        </div>
      </div>

      </div>

    </form>



  </div>
</div>
@endsection
