<?php
$nivel = '../../' ;
$menu2 = '';
?>
@extends('layouts.appFinal')

@section('content')
<div class="contenedor cliente_final">
  <div class="principal">
    <div class="titulo">
      <h3>
        {{$name->name}}
      </h3>
      <h4>
        {{$name->price}} €
      </h4>
    </div>

    <div class="inf">

      <div class="description">
        <p>{{$plate->description}}</p>
      </div>
      <div class="img">
        <img alt="" src="img/platos/{{$plate->img}}">
      </div>

    </div>

    <div class="agregar regresar">
      <center>
        <a href="{{ URL::previous() }}" class="waves-effect">
          <div class="">
            <span class="text">Regresar</span>
            <span class="icon"><i class="material-icons">reply</i></span>
          </div>
        </a>
      </center>
    </div>
  </div>
</div>


<!-- <div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Descripcion del Plato {{$name->name}}
      </h3>
    </div>

    <div class="form">
          {{$plate->description}}

			<img alt="" src="img/platos/{{$plate->img}}">

    </div>

    <div class="agregar regresar">
      <center>
        <a href="{{ URL::previous() }}" class="waves-effect">
          <div class="">
            <span class="text">Regresar</span>
            <span class="icon"><i class="material-icons">reply</i></span>
          </div>
        </a>
      </center>
    </div>
  </div>
</div> -->
@endsection
