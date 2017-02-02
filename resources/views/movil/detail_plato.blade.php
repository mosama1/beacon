<?php
$nivel = (isset($nivel)) ? $nivel : '../../../../../' ;
$menu2 = '';
?>
@extends('layouts.appFinal')

@section('content')
<div class="contenedor cliente_final">
  <div class="principal">
    <div class="titulo">
      <h1>{{ $section_name }}</h1>
      <h3>
        @if( ! empty($menu->menu_translation[0]) )
          {{$menu->menu_translation[0]->name}}
        @endif
      </h3>
      <h4>
        {{$menu->price}} €
      </h4>
    </div>

    <div class="inf">

      <div class="description">
        <p>{{$menu->plate->plate_translation->description}}</p>

      </div>
      <div class="img">
        @if($menu->plate->img != NULL OR !empty($menu->plate->img))
        <img alt="" src="{{ asset($menu->plate->img) }}">
        @endif
      </div>

    </div>


    <div class="agregar regresar">
      <center>
        <a href="{{ route('movil_all_plate', array('campana_id' => $campana_id, 'section_id' => $menu->section_id, 'menu_id' => $menu->menu_id) ) }}" class="waves-effect">
          <div class="">
            <span class="text">Regresar</span>
            <span class="icon"><i class="material-icons">reply</i></span>
          </div>
        </a>
      </center>
    </div>
  </div>
</div>

@endsection
