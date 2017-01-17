<?php $nivel = '../'?>
@extends('layouts.app')

@section('content')
<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Menu
      </h3>
    </div>


    <div class="agregar">
      <center>
        <a href="#agregarMenu" class="waves-effect">
          <div class="">
            <span class="text">Agregar <br><strong>Menu</strong></span>
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
                  <th data-field="id">Descripcion</th>
                  <th data-field="name">Visualizar</th>
                  <th data-field="price">Eliminar</th>
              </tr>
            </thead>

            <tbody>
              @foreach($coupon as $c)
                <tr id='{{$c->id}}'>
                  <td>{{$c->name}}</td>
                  <td>{{$c->description}}</td>
                  <td><a href="{{ route('show_session', $c->id) }}"><i class="material-icons">input</i></a></td>
                  <td><a href="#eliminarMenu"><i class="material-icons">clear</i></a></td>
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
      Agregar Menu
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
        <textarea name="description" rows="8" cols="80" required=""></textarea>
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Descripcion</span>
        </label>
      </div>
      @if ($errors->has('description'))
        <div class="input_error">
            <span>{{ $errors->first('description') }}</span>
        </div>
      @endif
      <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}" id="divPrecioMenu">
        <input type="number" name="precioMenu" step="0.01" min="0" value=""  id="precioMenu" min="1.00">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Ingresar Precio: 0,00</span>
        </label>
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

<div id="eliminarMenu" class="modal modal_">

  <div class="titulo">
    <h3>
      Esta seguro que desea eliminar menu
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('store_menu') }}">
      {{ csrf_field() }}
      <div class="button">
        <center>
          <button type="submit" name="button">
            <span>Si</span>
          </button>
          <a href="#" class="" onclick="$('#eliminarMenu').modal('close'); return false;">
            <span>No</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>


@endsection
