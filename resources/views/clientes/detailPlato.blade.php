<?php
$nivel = '../../../../../' ;
$menu2 = '';
?>
@extends('layouts.appFinal')

@section('content')
<div class="contenedor cliente_final">
  <div class="principal">
    <div class="titulo">
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
        <p>{{$menu->description}}</p>
        
      </div>
      <div class="img">
        <img alt="" src="{{ asset($menu->plate->img) }}">
      </div>

    </div>


    <div class="agregar regresar">
      <center>
        <a href="{{ route('movil_show_plate', array('campana_id' => $campana_id, 'section_id' => $menu->section_id, 'menu_id' => $menu->menu_id) ) }}" class="waves-effect">
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
