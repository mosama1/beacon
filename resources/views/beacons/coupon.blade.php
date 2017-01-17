<?php $nivel = '../../'?>
@extends('layouts.app')

@section('content')
    <!-- <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>

            <h1 class="header center orange-text">XXXX</h1>

             @if (session('status'))
	           <span class="help-block">
	           	 <strong>{{ session('status') }}</strong>
	           </span>
	         @endif

			  <a href="#modal1" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>

			  <div id="modal1" class="modal">
			    <div class="modal-content">
			      <h4>Agregar Coupon</h4>

			    <form class="form-horizontal" role="form" method="POST" action="{{ route('store_coupon') }}">
		            {{ csrf_field() }}

		             <label for="name" class="col-md-4 control-label">Nombre</label>
		             <input type="text" name="name" autofocus="autofocus" required>

		             <label for="description" class="col-md-4 control-label">Descripcion</label>
		             <input type="text" name="description" required>

				    </div>
				    <div class="modal-footer">
				     <div class="form-group">
		                <div class="col-md-6 col-md-offset-4">
		                    <button type="submit" class="btn btn-primary">
		                        Guardar
		                    </button>
		                </div>
		            </div>
				      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Salir</a>
				    </div>

			    </form>
			  </div>

			  <table class="bordered centered">
              <thead>
                <tr>
                    <th data-field="id">Nombre</th>
                    <th data-field="id">Descripccion</th>
                    <th data-field="name">Visualizar</th>
                    <th data-field="price">Eliminar</th>
                </tr>
              </thead>

              <tbody>
	              @foreach($coupon as $c)
	                <tr id='{{$c->id}}'>
	                  <td>{{$c->name}}</td>
	                   <td>{{$c->description}}</td>
					  <td><a href="{{ route('show_menu', $c->id) }}"><i class="material-icons">input</i></a></td>
				      <td><a href="#" onclick="delete_session({{ $c->id }})"><i class="material-icons">clear</i></a></td>
	                </tr>
	              @endforeach
              </tbody>
            </table>

        </div>
    </div> -->

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
                  <td><a href="#" onclick="delete_session({{ $c->id }})"><i class="material-icons">clear</i></a></td>
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
        @if ($errors->has('name'))
          <span class="error_input">
              <strong>{{ $errors->first('name') }}</strong>
          </span>
        @endif
      </div>

      <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
        <!-- <input type="text" name="description" value="" required=""> -->
        <textarea name="description" rows="8" cols="80" required=""></textarea>
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Descripcion</span>
        </label>
        @if ($errors->has('description'))
          <span class="error_input">
              <strong>{{ $errors->first('description') }}</strong>
          </span>
        @endif
      </div>

      <div class="button">
        <center>
          <button type="submit" name="button">
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



@endsection
