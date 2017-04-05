<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="section_ authenticate" id="recuperar">
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
      {{ csrf_field() }}
      <input type="hidden" name="token" value="{{ $token }}">
      <div class="divide">
        <div class="titulo">
          <h5>Resetar Contraseña</h5>
        </div>

        <div class="divide_cont">
          <div class="input {{ $errors->has('email') ? 'error' : '' }}">
            <input type="email" name="email" value="{{ $email or old('email') }}" required="">
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


          <div class="input {{ $errors->has('password_confirmation') ? 'error' : '' }}">
            <input type="password" name="password_confirmation" value="" required="">
            <label for="">
              <span class="icon"><img src="img/icons/correo.png" alt=""></span>
              <span class="text">Contraseña</span>
            </label>
          </div>
          @if ($errors->has('password_confirmation'))
          <div class="input_error">
            <span>{{ $errors->first('password_confirmation') }}</span>
          </div>
          @endif


          <div class="input {{ $errors->has('password') ? 'error' : '' }}">
            <input type="password" name="password" value="{{ $password or old('password') }}" required="">
            <label for="">
              <span class="icon"><img src="img/icons/correo.png" alt=""></span>
              <span class="text">Confirmar Contraseña</span>
            </label>
          </div>
          @if ($errors->has('password'))
          <div class="input_error">
            <span>{{ $errors->first('password') }}</span>
          </div>
          @endif
        </div>

        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Enviar</span>
            </button>
            <a href="{{ url('/login') }}" class="">
              <span>Cancelar</span>
            </a>
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

        <div class="panel-body">

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Correo</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Contraseña</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Reset Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div> -->
@endsection
