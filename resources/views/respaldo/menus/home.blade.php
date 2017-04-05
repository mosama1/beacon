<?php $nivel = '../../' ?>
@extends('layouts.app')

@section('content')
<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Secciones y Tipos
      </h3>
    </div>

    <div class="agregar">
      <center>
        <a href="#agregarSection" class="waves-effect">
          <div class="">
            <span class="text">Agregar <br><strong>Sección</strong></span>
            <span class="icon"><i class="material-icons">add</i></span>
          </div>
        </a>
      </center>
    </div>

    <div class="beacons seccion">
      <div class="container">
        <div class="tabla">
          <table class="bordered centered">
            <thead>
              <tr>
                <th data-field="id"></th>
                  <th data-field="id">Nombre</th>
                  <th data-field="name">Visualizar</th>
                  <th data-field="price">Editar</th>
                  <th data-field="price">Idioma</th>
                  <th data-field="price">Eliminar</th>
                </tr>
            </thead>
            <tbody>
              @foreach($sections as $s)
              <tr id='{{$s->id}}'>
                <td><input type="checkbox" id="test{{$s->id}}" /><label for="test{{$s->id}}"></label></td>
                @if( ! empty($s->section_translation[0]) )
                <td>
                  {{$s->section_translation[0]->name}}
                </td>
                @endif
                <td><a href="{{ route('show_sectionMenus', $s->id) }}"><i class="material-icons">input</i></a></td>
                <td><a href="{{ route('edit_section', $s->id) }}"><i class="material-icons">edit</i></a></td>
                <td><a href="#Idioma"><i class="material-icons">language</i></a></td>
                <?php

                echo "<td onclick= \"modal_activate('".
                route( "destroy_section", $s->id ).
                "' , '#eliminarSection')\" >";

                ?>
                <a href="#eliminarSection"><i class="material-icons">clear</i></a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="agregar regresar">
      <center>
        <a href="{{ route('show_coupon') }}" class="waves-effect">
          <div class="">
            <span class="text">Regresar</span>
            <span class="icon"><i class="material-icons">reply</i></span>
          </div>
        </a>
      </center>
    </div>

  </div>
</div>
<div id="agregarSection" class="modal modal_">
  <div class="titulo">
    <h3>
      Agregar Sección
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('store_section') }}">
      {{ csrf_field() }}
      <input type="hidden" name="coupon_id" value="{{$coupon_id}}" required="">

      <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
        <input type="text" name="name" value="" required="" autofocus="">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Nombre</span>
        </label>
        @if ($errors->has('name'))
          <span class="error_input">
              <strong>{{ $errors->first('name') }}</strong>
          </span>
        @endif
      </div>
      <div class="button">
        <center>
          <button type="submit" name="button">
            <span>Guardar</span>
          </button>
          <a href="#" class="" onclick="$('#agregarSection').modal('close'); return false;">
            <span>Cancelar</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>
<div id="Idioma" class="modal modal_">
  <div class="titulo">
    <h3>
      Agregar Sección
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('store_section') }}">
      {{ csrf_field() }}
      <input type="hidden" name="coupon_id" value="{{$coupon_id}}" required="">
      <div class="input select no_icon {{ $errors->has('type') ? 'error' : '' }}">
        <!-- <img src="img/icons/idioma.png" alt="" class="icon"> -->
        <select id="type" class="form-control icons" name="type" required>
          <option value="" disabled selected>Seleccione un Idioma</option>

          <option value="Español">Español</option>
          <option value="English">English</option>
          <option value="Frances">Frances</option>
        </select>

        @if ($errors->has('type'))
        <span class="error_input">
          <strong>{{ $errors->first('type') }}</strong>
        </span>
        @endif
      </div>
      <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
        <input type="text" name="language" value="" required="">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Traduccion Sección</span>
        </label>
        @if ($errors->has('name'))
          <span class="error_input">
              <strong>{{ $errors->first('name') }}</strong>
          </span>
        @endif
      </div>
      <div class="button">
        <center>
          <button type="submit" name="button">
            <span>Guardar</span>
          </button>
          <a href="#" class="" onclick="$('#Idioma').modal('close'); return false;">
            <span>Cancelar</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>
<div id="eliminarSection" class="modal modal_">

  <div class="titulo">
    <h3>
      Esta seguro que desea eliminar sección
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST"">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="DELETE">
      <div class="button">
        <center>
          <button type="submit" name="button">
            <span>Si</span>
          </button>
          <a href="#" class="" onclick="$('#eliminarSection').modal('close'); return false;">
            <span>No</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>

@endsection
