<?php $nivel = ''?>
@extends('layouts.app')

@section('content')
<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Menú
      </h3>
    </div>


    <div class="agregar">
      <center>
        <a href="#agregarMenu" class="waves-effect">
          <div class="">
            <span class="text">Agregar<br><strong>Menú</strong></span>
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
                  <th data-field="id">Nombre</th>
                  <th data-field="id">Descripción</th>
                  <th data-field="name">Visualizar</th>
                  <!-- <th data-field="price">Idioma</th> -->
                  <th data-field="price">Editar</th>

                  <th data-field="price">Eliminar</th>
              </tr>
            </thead>

            <tbody>
              @foreach($coupon as $c)
                <tr id='{{$c->coupon_id}}'>
                  <td>
                    @if( ! empty($c->coupon_translation[0]) )
                      {{$c->coupon_translation[0]->name}}
                    @endif
                  </td>
                  <td>
                    @if( ! empty($c->coupon_translation[0]) )
                      {{$c->coupon_translation[0]->description}}
                    @endif
                  </td>
                  <td><a href="{{ route( 'all_section', $c->coupon_id ) }}"><i class="material-icons">input</i></a></td>


                  <!-- <td><a href="#idioma"><i class="material-icons">language</i></a></td> -->
                  <td><a href="{{ route( 'edit_coupon', $c->coupon_id ) }}"><i class="material-icons">edit</i></a></td>

                  <?php

                  echo "<td onclick= \"modal_activate('".
                  route( "destroy_coupon", $c->coupon_id ).
                  "' , '#eliminarCoupon')\" >";

                  ?>

                  <a href="#eliminarCoupon"><i class="material-icons">clear</i></a>

                </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
<div id="agregarMenu" class="modal modal_">
  <div class="titulo">
    <h3>
      Agregar Menú
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('store_coupon') }}">
      {{ csrf_field() }}

      <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
        <input type="text" name="name" value="" required="">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Nombre</span>
        </label>
      </div>
      @if ($errors->has('name'))
        <div class="input_error">
            <span>{{ $errors->first('name') }}</span>
        </div>
      @endif

      <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
        <!-- <input type="text" name="description" value="" required=""> -->
        <textarea name="description" rows="8" cols="80"></textarea>
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Descripción (Opcional)</span>
        </label>
      </div>
      @if ($errors->has('description'))
        <div class="input_error">
            <span>{{ $errors->first('description') }}</span>
        </div>

      @endif
      <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}" id="divPrecioMenu">
        <input type="number" name="price" step="0.01" value=""  id="price" min="1.00" max="99999" onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Ingresar Precio: 0,00</span>
        </label>
      </div>
      <div class="input_error" id="errorPrecioMenu" style="display: none;">
          <span>El monto debe ser mayor a cero</span>
      </div>
        <p>
      <input type="checkbox" class="filled-in" id="filled-in-box" />
      <label for="filled-in-box">Manejar Precio</label>
        </p>
      <!-- <label><input type="checkbox" id="cbox1" value="first_checkbox"> Este es mi primer checkbox</label><br> -->

      <div class="button">
        <center>
          <button type="submit" name="button" id="guardar">
            <span>Guardar</span>
          </button>
          <a href="#" class="" onclick="$('#agregarMenu').modal('close'); return false;">
            <span>Cancelar</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>
<div id="idioma" class="modal modal_">
  <div class="titulo">
    <h3>
      Agregar Idioma
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST"> <!-- action="{{ route('store_coupon') }}" -->
      {{ csrf_field() }}

      <div class="input select {{ $errors->has('type') ? 'error' : '' }}">
        <!-- <img src="img/icons/idioma.png" alt="" class="icon"> -->
        <select id="type" class="form-control icons" name="type" required>
          <option value="" disabled selected>Seleccione un Idioma</option>

          <option value="vegetariana">vegetariana</option>
          <option value="sin gluten">sin gluten</option>
          <option value="bja caloria">baja caloria</option>
          <option value="picante">picante</option>
        </select>

        @if ($errors->has('type'))
        <span class="error_input">
          <strong>{{ $errors->first('type') }}</strong>
        </span>
        @endif
      </div>
      <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
        <input type="text" name="name" value="" required="">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Traducción Nombre</span>
        </label>
      </div>
      @if ($errors->has('name'))
        <div class="input_error">
            <span>{{ $errors->first('name') }}</span>
        </div>
      @endif

      <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
        <!-- <input type="text" name="description" value="" required=""> -->
        <textarea name="description" rows="8" cols="80" required=""></textarea>
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Traducción Descripción</span>
        </label>
      </div>
      @if ($errors->has('description'))
        <div class="input_error">
            <span>{{ $errors->first('description') }}</span>
        </div>
      @endif
      <!-- <label><input type="checkbox" id="cbox1" value="first_checkbox"> Este es mi primer checkbox</label><br> -->
      <div class="button">
        <center>
          <button type="submit" name="button" id="guardar">
            <span>Guardar</span>
          </button>
          <a href="#" class="" onclick="$('#idioma').modal('close'); return false;">
            <span>Cancelar</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>

<div id="eliminarCoupon" class="modal modal_">

  <div class="titulo">
    <h3>
      Esta seguro que desea eliminar menú
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST">

      {{ csrf_field() }}
      {{ method_field('DELETE') }}

      <div class="button">
        <center>
          <button type="submit" name="button">
            <span>Si</span>
          </button>
          <a href="#" class="" onclick="$('#eliminarCoupon').modal('close'); return false;">
            <span>No</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>

@endsection
