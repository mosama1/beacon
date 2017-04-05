<?php
$nivel = '../../../../../../../../' ;
$menu2 = '';
?>
@extends('layouts.appFinal')

@section('content')
<div class="contenedor cliente_final">
  <div class="principal">
    <div class="titulo">

      <h3>


        @if( isset($language_id) )
            @foreach ($menu->menu_translation as $menu_)
                @if($menu_->language_id == $language_id)
                {{$menu_->name}}
                @endif
            @endforeach
        @else
            @if( ! empty($menu->menu_translation[0]) )
              {{$menu->menu_translation[0]->name}}
            @endif
        @endif
      </h3>
      <h4>
        {{$menu->price}} €
      </h4>
    </div>

    <div class="inf">

      <div class="description">
        @php
        use Beacon\PlateTranslation;

          $plate_translation = PlateTranslation::where([
          ['plate_id', '=', $menu->plate->id ],
          ])->get();
        @endphp


        <p>

            @if( isset($language_id) )
                @foreach ($plate_translation as $plate)
                    @if($plate->language_id == $language_id)
                    {{$plate->description}}
                    @endif
                @endforeach
            @endif
        </p>

      </div>
      <div class="img">
          @if($menu->plate->img_madiraje != NULL OR !empty($menu->plate->img_madiraje))
          <img alt="" src="{{ asset($menu->plate->img_madiraje) }}">
          @endif
      </div>

      <p class="mensaje__">Este plato se recomienda con:</p>

      <div class="description">
        <p>
            @if( isset($language_id) )
                @foreach ($plate_translation as $plate)
                    @if($plate->language_id == $language_id)
                    {{$plate->madiraje}}
                    @endif
                @endforeach
            @else
                {{$plate_translation[0]->madiraje}}
            @endif
        </p>

      </div>

    </div>


    <div class="agregar regresar">
      <center>
        <a href="{{ route('movil_all_types_plates', array('campana_id' => $campana_id, 'type_plate_id' => $type_plate_id, 'menu_id' => $menu->menu_id, 'language_id' => $language_id) ) }}" class="waves-effect" target="_self">
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
