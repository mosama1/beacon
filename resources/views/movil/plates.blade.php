<?php
  $nivel = '../../../../../';
  $menu2 = '';

?>
@php
use Beacon\Plate;
@endphp

@extends('layouts.appFinal')

@section('content')

<div class="contenedor cliente_final {{(isset($menu2)) ? 'padding_top' : '' }}">
  <div class="principal" style="padding: 0;">
    <div class="titulo">
      <h3>
        Carta
      </h3>
    </div>

    <div class="beacons seccion">
      <!-- <div class="container"> -->
        <div class="tabla">
          <table class="bordered centered">
            <thead>
              <tr>
                  <th data-field="id" style="text-transform: capitalize;">{{ $section_name }}</th>
                  <th data-field="id">Precio</th>
                  <th data-field="name"></th>
              </tr>
            </thead>


            <tbody>


              @foreach($menus as $p)
                @php
                  $plate = plate::where([
                  ['menu_id', '=', $p->id ],
                  ])->first();
                @endphp
                <tr id='{{$p->id}}'>
                  <td>
                    @if( ! empty($p->menu_translation[0]) )
                      {{$p->menu_translation[0]->name}}
                    @endif
                  </td>
                  <td>
                    @if( empty($coupon->price) )
                      {{$p->price}}
                    @else
                      {{$coupon->price}}
                    @endif
                  </td>
                  <td>
                    @if ($plate != NULL)
                    <a href="{{ route('show_desc_plate', array('campana_id' => $campana_id, 'menu_id' => $p->id) ) }}"><i class="material-icons">remove_red_eye</i></a>
                    @endif
                  </td>
                </tr>

              @endforeach
            </tbody>
          </table>
        </div>
      <!-- </div> -->
    </div>

  </div>
</div>



@endsection
