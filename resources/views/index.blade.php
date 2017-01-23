<?php
  $nivel = '../../';
?>@extends('layouts.appFinal')

@section('content')

  <div class="contenedor cliente_final logos valign-wrapper">
    <div class="vista_final logos valign-wrapper">
      <div class="logos">
        <div class="logo_principal logo">
          <img src="{{ $logo }}" alt="">
          <!-- <h2>LOGO</h2> -->
        </div>
        <div class="titulo">
          <h3>Logo de la locacion</h3>
        </div>
        <div class="logo_patrocinador logo">
          <!-- <img src="img/logo/logo.png" alt=""> -->
          <h4>

            logo<br>patrocinante
          </h4>
        </div>
      </div>
    </div>
  </div>
@endsection
