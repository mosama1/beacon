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
    <div class="titulo _1">
      <h3>
        MENÚ
      </h3>
    </div>

    <div class="beacons seccion">
      <!-- <div class="container"> -->
        <div class="tabla">
          <table class="bordered centered">
            <thead>
              <tr>
                  <th data-field="id" style="text-transform: capitalize;">{{ $type_plate->name }}</th>
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
                  <td>{{$p->price}}</td>
                  <td>
                    @if ($plate != NULL)
                    <a href="{{ route('show_desc_plate_by_type', array('campana_id' => $campana_id, 'type_plate' => $type_plate->id, 'menu_id' => $p->id ) ) }}"><i class="material-icons">remove_red_eye</i></a>
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
