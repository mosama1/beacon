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
              @if($user->language == 'es')
                <option value="{{ $user->language }}" data-icon="img/icons/{{ $user->language }}.png" class="left circle">{{ $user->language }}</option>
                <option value="en" data-icon="img/icons/en.png" class="left circle">en</option>
              @else
                <option value="{{ $user->language }}" data-icon="img/icons/{{ $user->language }}.png" class="left circle">{{ $user->language }}</option>
                <option value="es" data-icon="img/icons/es.png" class="left circle">es</option>
              @endif
            </select>

            @if ($errors->has('language'))
            <span class="error_input">
              <strong>{{ $errors->first('language') }}</strong>
            </span>
            @endif
          </div>
          <div class="input {{ $errors->has('name') ? 'error' : '' }}">
            <input type="text" name="name" value="{{ $user->name }}" required="">
            <label for="">
              <span class="icon"><img src="img/icons/usuario.png" alt=""></span>
              <span class="text">Usuario</span>
            </label>
            @if ($errors->has('name'))
            <span class="error_input">
              <strong>{{ $errors->first('name') }}</strong>
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
              <span class="text">Telefono de contacto</span>
            </label>
            @if ($errors->has('phone'))
            <span class="error_input">
              <strong>{{ $errors->first('phone') }}</strong>
            </span>
            @endif
          </div>
          <div class="input {{ $errors->has('password') ? 'error' : '' }}">
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
          </div>
        </div>
        <div class="links">
          <a href="{{ route('list_beacons') }}">Informacion de Beacons</a>
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

    <form class="form-horizontal" role="form" method="POST" action="{{ route('location_update', $location->location_id) }}">
      {{ csrf_field() }}

      <div class="divide dat_ris">
        <div class="titulo">
          <h5>Datos del restaurant</h5>
        </div>
        <div class="divide_cont">
          <div class="input {{ $errors->has('restaurant') ? 'error' : '' }}">
            <input type="text" name="name" value="{{$location->name}}" required="">
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
              <span class="text">City</span>
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
                <span class="text">Street</span>
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
                <span class="text">Street Number</span>
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
              <span class="text">Zip</span>
            </label>
            @if ($errors->has('zip'))
            <span class="error_input">
              <strong>{{ $errors->first('zip') }}</strong>
            </span>
            @endif
          </div>

          <div class="input {{ $errors->has('lat') ? 'error' : '' }}">
            <input type="text" name="lat" value="{{$location->lat}}" required="">
            <label for="">
              <span class="text">Lat</span>
            </label>
            @if ($errors->has('lat'))
            <span class="error_input">
              <strong>{{ $errors->first('lat') }}</strong>
            </span>
            @endif
          </div>

          <div class="input {{ $errors->has('lng') ? 'error' : '' }}">
            <input type="text" name="lng" value="{{$location->lng}}" required="">
            <label for="">
              <span class="text">Lng</span>
            </label>
            @if ($errors->has('lng'))
            <span class="error_input">
              <strong>{{ $errors->first('lng') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Guardar <br> Ubicacion</span>
            </button>
          </center>
        </div>
      </div>
    </form>





  </div>
</div>














<!-- <div class="container">
  <div class="section">

    <div class="row">
      <div class="col s12 m12">

         @if (session('status'))
           <span class="help-block">
           	 <strong>{{ session('status') }}</strong>
           </span>
         @endif

        <form action="{{route('user_patch_path', $user->id)}}" method="post">

            {{csrf_field()}}

            <div class="col s6">

                <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">

                  <div class="input-field">
                    <select id="language" class="form-control icons" name="language" required>
                      @if($user->language == 'es')
                        <option value="{{ $user->language }}" data-icon="/img/language/{{ $user->language }}.png" class="left circle">{{ $user->language }}</option>
                        <option value="en" data-icon="/img/language/en.png" class="left circle">en</option>
                      @else
                        <option value="{{ $user->language }}" data-icon="/img/language/{{ $user->language }}.png" class="left circle">{{ $user->language }}</option>
                        <option value="es" data-icon="/img/language/es.png" class="left circle">es</option>
                      @endif
                    </select>

                    @if ($errors->has('language'))
                    <span class="help-block">
                      <strong>{{ $errors->first('language') }}</strong>
                    </span>
                    @endif

                    <label>Idioma</label>
                  </div>

                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Usuario</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Correo</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="phone" class="col-md-4 control-label">Telefono de contacto</label>

                    <div class="col-md-6">
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>

                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <div class="col-md-6">
                        <input id="password" type="hidden" class="form-control" name="password" value="{{ $user->password }}" readonly="true" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password_update') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Cambiar Contraseña</label>

                    <div class="col-md-6">
                        <input id="password_update" type="password" class="form-control" name="password_update" value="">

                        @if ($errors->has('password_update'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_update') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col s12 m12 ">
                  <a href="{{ route('list_beacons') }}">Informacion de Beacons</a>
                </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Guardar Perfil
                    </button>
                 </div>
            </div>
         </div>

        </form>



            <div class="col s6">

            <form class="form-horizontal" role="form" method="POST" action="{{ route('location_update', $location->location_id) }}">
            {{ csrf_field() }}

                <div class="form-group{{ $errors->has('restaurant') ? ' has-error' : '' }}">
                    <label for="restaurant" class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input id="restaurant" type="text" class="form-control" name="name" value="{{$location->name}}" required>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                    <label for="city" class="col-md-4 control-label">City</label>

                    <div class="col-md-6">
                        <input id="city" type="text" class="form-control" name="city" value="{{$location->city}}" required>

                        @if ($errors->has('city'))
                            <span class="help-block">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                 <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                    <label for="city" class="col-md-4 control-label">Street</label>

                    <div class="col-md-6">
                        <input id="city" type="text" class="form-control" name="street" value="{{$location->street}}" required>

                        @if ($errors->has('Street'))
                            <span class="help-block">
                                <strong>{{ $errors->first('Street') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>



                <div class="form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                    <label for="province" class="col-md-4 control-label">Street Number </label>

                    <div class="col-md-6">
                        <input id="street_number" type="text" class="form-control" name="street_number" value="{{$location->street_number}}" required>

                        @if ($errors->has('street_number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('street_number') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('postal_Code') ? ' has-error' : '' }}">
                    <label for="postal_Code" class="col-md-4 control-label">Zip</label>

                    <div class="col-md-6">
                        <input id="postal_Code" type="text" class="form-control" name="zip" value="{{$location->zip}}" required>

                        @if ($errors->has('zip'))
                            <span class="help-block">
                                <strong>{{ $errors->first('zip') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                 <div class="form-group{{ $errors->has('lat ') ? ' has-error' : '' }}">
                    <label for="phone_restaurant" class="col-md-4 control-label">lat </label>

                    <div class="col-md-6">
                        <input id="phone_restaurant" type="text" class="form-control" name="lat" value="{{$location->lat}}" required>

                        @if ($errors->has('lat'))
                            <span class="help-block">
                                <strong>{{ $errors->first('lat') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                 <div class="form-group{{ $errors->has('lng') ? ' has-error' : '' }}">
                    <label for="phone_restaurant" class="col-md-4 control-label">lng</label>

                    <div class="col-md-6">
                        <input id="phone_restaurant" type="text" class="form-control" name="lng" value="{{$location->lng}}" required>

                        @if ($errors->has('lng'))
                            <span class="help-block">
                                <strong>{{ $errors->first('lng') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Guardar Ubicacion
                    </button>
                </div>
            </div>
        </form>

      </div>
    </div>
  </div>
</div> -->
@stop
