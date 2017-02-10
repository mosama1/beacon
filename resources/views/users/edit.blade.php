<?php
$nivel = '../';
$actual = 'edit';
 ?>
@extends('layouts.app')

@section('content')
<div class="contenedor">
  <div class="section_ authenticate edit" id="register">
    <div class="fondo_mitad fondo_reg_user"></div>
    <div class="fondo_mitad fondo_dat_ris"></div>
    <form action="{{route('user_patch_path', $user->user_id)}}" method="post">
      {{ csrf_field() }}


      <div class="divide reg_user">
        <div class="titulo">
          <h5>Registro de usuario</h5>
        </div>
        <div class="divide_cont">


          <div class="input {{ $errors->has('email') ? 'error' : '' }}">
            <input type="email" name="email" value="{{ $user->email }}" required="">
            <label for="">
              <span class="icon"><img src="img/icons/correo.png" alt=""></span>
              <span class="text">Correo</span>
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
          @if ($errors->has('email'))
          <div class="input_error">
            <span>{{ $errors->first('email') }}</span>
          </div>
          @endif
          <div class="input {{ $errors->has('phone') ? 'error' : '' }}">
            <input type="text" name="phone" value="{{ $user->phone }}" required="" class="val_phone">
            <label for="">
              <span class="icon"><img src="img/icons/telefono.png" alt=""></span>
              <span class="text">Teléfono de contacto</span>
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
          @if ($errors->has('phone'))
          <div class="input_error">
            <span>{{ $errors->first('phone') }}</span>
          </div>
          @endif

        </div>
        <div class="links_">
          <a href="#cambiarContrasena">Cambiar Contraseña</a> || <a href="{{ route('all_beacons') }}" @if($ultimo_paso == 1) data-step="2" data-intro="Debes registrar tu dispositivo beacon" @endif>Información de Beacons</a>
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

    <form class="form-horizontal" role="form" method="POST" action="{{ route('update_location', $location->location_id) }}"  enctype="multipart/form-data">
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
          <div class="input {{ $errors->has('city') ? 'error' : '' }}">

            <input type="text" name="city" value="{{$location->city}}" required="">

            <label for="">
              <span class="text">Ciudad</span>
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
          @if ($errors->has('city'))
          <div class="input_error">
            <span>{{ $errors->first('city') }}</span>
          </div>
          @endif
          <!-- <div class="inputs"> -->
            <div class="input {{ $errors->has('street') ? 'error' : '' }}">
              <input type="text" name="street" value="{{$location->street}}" required="">
              <label for="">
                <span class="text">Calle</span>
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
            @if ($errors->has('street'))
            <div class="input_error">
              <span>{{ $errors->first('street') }}</span>
            </div>
            @endif
            <div class="input {{ $errors->has('street_number') ? 'error' : '' }}">
              <input type="text" name="street_number" value="{{$location->street_number}}" required="">
              <label for="">
                <span class="text">Número de calle</span>
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
            @if ($errors->has('street_number'))
            <div class="input_error">
              <span>{{ $errors->first('street_number') }}</span>
            </div>
            @endif
          <!-- </div> -->

          <div class="input {{ $errors->has('zip') ? 'error' : '' }}">
            <input type="text" name="zip" value="{{$location->zip}}" required="" class="val_zip">
            <label for="">
              <span class="text">Código postal</span>
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
          @if ($errors->has('zip'))
          <div class="input_error">
            <span>{{ $errors->first('zip') }}</span>
          </div>
          @endif
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
              <span class="input_error">
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
    <form class="form-horizontal" role="form" method="POST" action="{{ route('change_password', array( 'user_id' => $user->id ) ) }}" id="change_password" userid="{{$user->id}}">
      {{ csrf_field() }}



      <div class="input no_icon {{ $errors->has('old_password') ? 'error' : '' }}">
        <input type="password" name="old_password" value="" required="">
        <label for="">
          <span class="text">Contraseña Actual</span>
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
      @if ($errors->has('old_password'))
      <div class="input_error">
        <span>{{ $errors->first('old_password') }}</span>
      </div>
      @endif

      <div class="input no_icon {{ $errors->has('password') ? 'error' : '' }}">
        <input type="password" name="password" value="" required="" id="password">
        <label for="">
          <span class="text">Nueva Contraseña</span>
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
      @if ($errors->has('password'))
      <div class="input_error">
        <span>{{ $errors->first('password') }}</span>
      </div>
      @endif

      <div class="input no_icon {{ $errors->has('password_confirmation') ? 'error' : '' }}">
        <input type="password" name="password_confirmation" value="" required="" id="password_confirmation">
        <label for="">
          <span class="text">Confirmar Contraseña</span>
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
      @if ($errors->has('password_confirmation'))
      <div class="input_error">
        <span>{{ $errors->first('password_confirmation') }}</span>
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
