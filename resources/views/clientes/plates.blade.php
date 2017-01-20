<?php
  $nivel = '../../../';
  $menu2 = '';
?>

@extends('layouts.appFinal')

@section('content')

<div class="contenedor cliente_final">
  <div class="principal">
    <div class="titulo">
      <h3>
        Platos
      </h3>
    </div>

    <div class="beacons seccion">
      <div class="container">
        <div class="tabla">
          <table class="bordered centered">
            <thead>
              <tr>
                  <th data-field="id">Nombre</th>
                  <th data-field="id">Precio</th>
                  <th data-field="name">Detalles</th>
              </tr>
            </thead>

            <tbody>
              @foreach($menus as $p)
                <tr id='{{$p->id}}'>
                  <td>
                    @if( ! empty($p->menu_translation[0]) )
                      {{$p->menu_translation[0]->name}}
                    @endif
                  </td>
                  <td>{{$p->price}}</td>
                  <td><a href="{{ route('showDescPlate', $p->id) }}"><i class="material-icons">input</i></a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>



@endsection
