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

<!--MOSTRAR TABLA CON DETALLES-->
    <div class="beacons seccion">
      <div class="container">
        <div class="tabla">
          <form role="form" method="POST">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
          <table class="bordered centered">
            <thead>
              <tr>
                  <th data-field="id">Nombre</th>
                  <th data-field="id">Precio</th>
                  <th data-field="name" width="100px">Detalles</th>
                  <th data-field="price" width="100px">Editar</th>
                  <!-- <th data-field="price">Idioma</th> -->
                  <th data-field="price" width="100px">Eliminar</th>
                  <th data-field="id" width="130px" width="130px">Habilitado</th>
                </tr>
            </thead>
            <tbody>
            


              @foreach($sections as $s)              
              <tr id='{{$s->id}}'>
                <!-- <td><input type="checkbox" id="test{{$s->id}}" /><label for="test{{$s->id}}"></label></td> -->
                <!-- -->

                @if( ! empty($s->section_translation[0]) )
                <td>
                  {{ $s->section_translation[0]->name }}
                </td>
                @else
                  <td>
                    
                  </td>                
                @endif
              
                <td>
                  @if( $s->price > 0 )
                    {{$s->price}} €
                  @else
                    --
                  @endif
                </td>
                
                <td><a href="{{ route('all_menu', $s->id) }}"><i class="material-icons">input</i></a></td>
                <td><a href="{{ route('edit_section', $s->id) }}"><i class="material-icons">edit</i></a></td>
                <!-- <td><a href="#Idioma"><i class="material-icons">language</i></a></td> -->
                <?php

                  echo "<td onclick= \"modal_activate('".
                  route( "destroy_section", $s->id ).
                  "' , '#eliminarSection')\" >";

                ?>
                <a href="#eliminarSection"><i class="material-icons">clear</i></a></td>
                <td>


                  <div class="switch">
                    <label>
                      Si
                      <input id="habilitar_{{$s->id}}" type="checkbox" {{ ($s->status > 0 ? '' : 'checked') }} class="filled-in" id="filled-in-box" onclick="habilitar('#habilitar_{{$s->id}}', 'sections', '{{$s->id}}'); return false;" />
                      <span class="lever"></span>
                      No
                    </label>
                  </div>


                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          </form>
        </div>
      </div>
    </div>
<!--MOSTRAR TABLA CON DETALLES-->

<!--BOTON REGRESAR-->
    <div class="agregar regresar">
      <center>
        <a href="{{ route('all_coupon') }}" class="waves-effect">
          <div class="">
            <span class="text">Regresar</span>
            <span class="icon"><i class="material-icons">reply</i></span>
          </div>
        </a>
      </center>
    </div>
<!--BOTON REGRESAR-->


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
          <span class="text">Nombre</span>
        </label>
        <div class="help">
          <a href="#">
            <i class="material-icons">help_outline</i>
          </a>
          <div class="inf none hidden">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
            </p>
          </div>
        </div>

      </div>
      @if ($errors->has('name'))
      <span class="error_input">
        <strong>{{ $errors->first('name') }}</strong>
      </span>
      @endif

      <div class="input no_icon {{ $errors->has('price') ? 'error' : '' }}" id="divPrecioCarta">
        <input type="number" name="price" class="" value="" id="price" min="1" max="99999" step="any" onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)">
        <label for="">
          <span class="text">Ingresar Precio: 0,00 €</span>
        </label>
        <div class="help">
          <a href="#">
            <i class="material-icons">help_outline</i>
          </a>
          <div class="inf none hidden">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
            </p>
          </div>
        </div>
      </div>
      <div class="input_error" id="errorPrecioCarta" style="display: none;">
          <span>El monto debe ser mayor a cero</span>
      </div>
        <p>
      <input type="checkbox" class="filled-in" id="filled-in-box" />
      <label for="filled-in-box">Manejar Precio</label>
        </p>
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
    <form class="form-horizontal" role="form" method="POST">
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
