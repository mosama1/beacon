<?php $nivel = '../' ?>
@extends('layouts.app')

@section('content')
<div class="contenedor">
  <div class="section_ authenticate edit" id="register">
    <div class="fondo_mitad fondo_reg_user"></div>
    <div class="fondo_mitad fondo_dat_ris"></div>
    <form action="{{route('user_patch_path', $user->id)}}" method="post">
      {{ csrf_field() }}

      <div class="divide reg_user">
        <div class="titulo">
          <h5>Registro de usuario</h5>
        </div>
        <div class="divide_cont">
          <div class="input select {{ $errors->has('language') ? 'error' : '' }}">
            <img src="img/icons/idioma.png" alt="" class="icon">
            <select id="language" class="form-control icons" name="language" required>
              @if($user->language == 'Español')
                <option value="{{ $user->language }}" data-icon="img/icons/es.png" class="left circle">{{ $user->language }}</option>
                <option value="English" data-icon="img/icons/en.png" class="left circle">English</option>
              @else
                <option value="{{ $user->language }}" data-icon="img/icons/en.png" class="left circle">{{ $user->language }}</option>
                <option value="Español" data-icon="img/icons/es.png" class="left circle">Español</option>
              @endif
            </select>

            @if ($errors->has('language'))
            <span class="error_input">
              <strong>{{ $errors->first('language') }}</strong>
            </span>
            @endif
          </div>

          <div class="input {{ $errors->has('email') ? 'error' : '' }}">
            <input type="email" name="email" value="{{ $user->email }}" required="">
            <label for="">
              <span class="icon"><img src="img/icons/correo.png" alt=""></span>
              <span class="text">Correo</span>
            </label>
            @if ($errors->has('email'))
            <span class="error_input">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>
          <div class="input {{ $errors->has('phone') ? 'error' : '' }}">
            <input type="text" name="phone" value="{{ $user->phone }}" required="">
            <label for="">
              <span class="icon"><img src="img/icons/telefono.png" alt=""></span>
              <span class="text">Teléfono de contacto</span>
            </label>
            @if ($errors->has('phone'))
            <span class="error_input">
              <strong>{{ $errors->first('phone') }}</strong>
            </span>
            @endif
          </div>
          <!-- <div class="input {{ $errors->has('password') ? 'error' : '' }}">
            <input type="hidden" name="password" value="{{ $user->password }}" required="">
            <label for="">
              <span class="icon"><img src="img/icons/contrasena.png" alt=""></span>
              <span class="text">Contraseña</span>
            </label>
            @if ($errors->has('password'))
            <span class="error_input">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
          </div>

          <div class="input {{ $errors->has('password_update') ? 'error' : '' }}">
            <input type="password" name="password_update" value="" >
            <label for="">
              <span class="icon"><img src="img/icons/3_puntos.png" alt=""></span>
              <span class="text">Cambiar Contraseña</span>
            </label>
            @if ($errors->has('password_update'))
            <span class="error_input">
              <strong>{{ $errors->first('password_update') }}</strong>
            </span>
            @endif
          </div> -->
        </div>
        <div class="links">
          <a href="#cambiarContrasena">Cambiar Contraseña</a> || <a href="{{ route('list_beacons') }}">Información de Beacons</a>
        </div>
        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Guardar <br> Perfil</span>
            </button>
          </center>
        </div>
      </div>
    </form>

    <form class="form-horizontal" role="form" method="POST" action="{{ route('location_update', $location->location_id) }}"  enctype="multipart/form-data">
      {{ csrf_field() }}

      <div class="divide dat_ris">
        <div class="titulo">
          <h5>Datos del restaurant</h5>
        </div>
        <div class="divide_cont">
          <div class="input {{ $errors->has('restaurant') ? 'error' : '' }}">
            <input type="text" name="name" value="{{$location->name}}" required="" id="nombreEmpresa">
            <label for="">
              <span class="text">Nombre del local</span>
            </label>
            @if ($errors->has('name'))
            <span class="error_input">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
          </div>
          <div class="input {{ $errors->has('city') ? 'error' : '' }}">

            <input type="text" name="city" value="{{$location->city}}" required="">
<!-- <textarea name="city" rows="8" cols="80">{{ old('city') }}</textarea> -->

            <label for="">
              <span class="text">Ciudad</span>
            </label>
            @if ($errors->has('city'))
            <span class="error_input">
              <strong>{{ $errors->first('city') }}</strong>
            </span>
            @endif
          </div>
          <!-- <div class="inputs"> -->
            <div class="input {{ $errors->has('street') ? 'error' : '' }}">
              <input type="text" name="street" value="{{$location->street}}" required="">
              <label for="">
                <span class="text">Calle</span>
              </label>
              @if ($errors->has('street'))
              <span class="error_input">
                <strong>{{ $errors->first('street') }}</strong>
              </span>
              @endif
            </div>
            <div class="input {{ $errors->has('street_number') ? 'error' : '' }}">
              <input type="text" name="street_number" value="{{$location->street_number}}" required="">
              <label for="">
                <span class="text">Número de calle</span>
              </label>
              @if ($errors->has('street_number'))
              <span class="error_input">
                <strong>{{ $errors->first('street_number') }}</strong>
              </span>
              @endif
            </div>
          <!-- </div> -->

          <div class="input {{ $errors->has('zip') ? 'error' : '' }}">
            <input type="text" name="zip" value="{{$location->zip}}" required="">
            <label for="">
              <span class="text">Código postal</span>
            </label>
            @if ($errors->has('zip'))
            <span class="error_input">
              <strong>{{ $errors->first('zip') }}</strong>
            </span>
            @endif
          </div>
          <div class="divide_cont files">
            <div class="file-field input-field input_file {{ $errors->has('logo') ? 'has-error' : '' }}">
              <div class="btn">
                <span class="icon"><img src="img/icons/subir_archivo.png" alt=""></span>
                <span>Subir Logo</span>
                <input type="file" name="logo" id="addLogo">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" >
              </div>
              @if ($errors->has('logo'))
              <span class="error_input">
                <strong>{{ $errors->first('logo') }}</strong>
              </span>
              @endif
            </div>
            <div class="vista_previa">
              <center  id="vista_previa">
                <a href="#" class="vistaPreviaImg">
                  <div class="img active" id="vista_logo">
                    <img class="thumb" src="{{ asset($location->logo) }}">
                  </div>
                </a>

              </center>
            </div>
          </div>

        </div>

        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Guardar <br> Ubicación</span>
            </button>
          </center>
        </div>
      </div>
    </form>





  </div>
</div>







<div id="cambiarContrasena" class="modal modal_">
  <div class="titulo">
    <h3>
      Cambiar Contraseña
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST" action="#">
      {{ csrf_field() }}



      <div class="input no_icon {{ $errors->has('old_password') ? 'error' : '' }}">
        <input type="password" name="old_password" value="" required="">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Contraseña Actual</span>
        </label>
      </div>
      @if ($errors->has('old_password'))
      <div class="input_error">
        <span>{{ $errors->first('old_password') }}</span>
      </div>
      @endif

      <div class="input no_icon {{ $errors->has('new_password') ? 'error' : '' }}">
        <input type="password" name="new_password" value="" required="">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Nueva Contraseña</span>
        </label>
      </div>
      @if ($errors->has('new_password'))
      <div class="input_error">
        <span>{{ $errors->first('new_password') }}</span>
      </div>
      @endif

      <div class="input no_icon {{ $errors->has('confirm_password') ? 'error' : '' }}">
        <input type="password" name="confirm_password" value="" required="">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Confirmar Contraseña</span>
        </label>
      </div>
      @if ($errors->has('confirm_password'))
      <div class="input_error">
        <span>{{ $errors->first('confirm_password') }}</span>
      </div>
      @endif
      <div class="button">
        <center>
          <button type="submit" name="button" id="guardar">
            <span>Guardar</span>
          </button>
          <a href="#" class="" onclick="$('#cambiarContrasena').modal('close'); return false;">
            <span>Cancelar</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>








@stop
