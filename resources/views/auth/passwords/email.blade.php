<?php $nivel = '../';?>
@extends('layouts.app')

<!-- Main Content -->
@section('content')

<div class="contenedor">
  <div class="section_ authenticate" id="recuperar">
    <!-- <div class="fondo_mitad fondo_recuperar"></div> -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
      {{ csrf_field() }}

      <div class="divide">
        <div class="titulo">
          <h5>Recuperar Contraseña</h5>
        </div>
        <div class="divide_cont">




          <div class="input {{ $errors->has('email') ? 'error' : '' }}">
            <input type="email" name="email" value="{{ old('email') }}" required="">
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
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Correo</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Send Password Reset Link
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
