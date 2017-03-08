<?php $nivel = '' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Kits de Fidelidad
      </h3>
    </div>
    <div class="agregar">
      <center>
        <a href="#kitFidelidad" class="waves-effect">
          <div class="">
            <span class="text">Agregar <br>Kit</span>
            <span class="icon"><i class="material-icons">add</i></span>
          </div>
        </a>
      </center>
    </div>
    <div class="beacons seccion">
      <div class="container">
        <div class="tabla">
          <table>
            <thead>
              <tr>
                  <th data-field="id">Nombre</th>
                  <th data-field="country">Descripción</th>
                  <th width="100px">Contenido</th>
                  <th width="100px">Editar</th>
                  <th width="100px">Eliminar</th>
                  <th width="130px">Habilitado</th>
            </thead>

            <tbody>
              @foreach($fidelity_kits as $fk)
              <tr id="id">
                <td>{{ $fk->name }}</td>
                <td>{{ $fk->description }}</td>
                <td><a href="{{ route('all_fidelity_kit', $fk->promotion_id) }}"><i class="material-icons">add</i></a></td>
                <td><a href="{{ route('edit_fidelity_kit', $fk->promotion_id) }}"><i class="material-icons">edit</i></a></td>
              <?php

                echo "<td onclick= \"modal_activate('".
                   route( "destroy_fidelity_kit",$fk->promotion_id ).
                  "' , '#eliminarkitFidelidad')\" >";

              ?>
                <a href="#eliminarkitFidelidad"><i class="material-icons">clear</i></a></td>
                <td>
                    <div class="switch">
                        <label>
                            Si
                            <input type="checkbox" {{ ($fk->enabled > 0 ? '' : 'checked') }} class="filled-in" id="filled-in-box" />
                            <span class="lever"></span>
                            No
                        </label>
                  </div>
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


<div id="kitFidelidad" class="modal modal_">
  <div class="titulo">
    <h3>
      Kit de Fidelidad
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal form_send" role="form" method="POST" action="{{ route('store_fidelity_kit') }}" enctype="multipart/form-data">
      {{ csrf_field() }}

      <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
        <input type="text" name="name" value="" required="">
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
        <div class="input_error">
            <span>{{ $errors->first('name') }}</span>
        </div>
      @endif
      <div class="input textarea no_icon {{ $errors->has('description') ? 'error' : '' }}">
        <textarea name="description" rows="8" cols="80" ></textarea>
        <label for="">
          <span class="text">Descripción (Opcional)</span>
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
      @if ($errors->has('description'))
        <div class="input_error">
            <span>{{ $errors->first('description') }}</span>
        </div>
      @endif


      <div class="input no_icon {{ $errors->has('num_visit') ? 'error' : '' }}">
        <input type="text" name="number_visits" value="" required="" class="num_mask">
        <label for="">
          <span class="text">Numero de Visitas</span>
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
      @if ($errors->has('num_visit'))
        <div class="input_error">
            <span>{{ $errors->first('num_visit') }}</span>
        </div>
      @endif

      <!-- Mensaje de la promoción -->
      <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
      <input type="text" name="message" value="">
      <label for="">
        <span class="text">Mensaje Promoción</span>
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
      <div class="input_error">
        <span>{{ $errors->first('name') }}</span>
      </div>
      @endif      
<!--
      <div class="divide_cont files">
        <div class="file-field input-field input_file {{ $errors->has('img') ? 'has-error' : '' }}">
          <div class="btn">
            <span class="icon"><img src="img/icons/subir_archivo.png" alt=""></span>
            <span>Subir Imagen de promoción</span>
            <input type="file" name="img" id="addKit_f">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
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
        @if ($errors->has('img'))
        <div class="error_input">
          <span>{{ $errors->first('img') }}</span>
        </div>
        @endif
        <div class="vista_previa">
          <center  id="vista_previa">
              <div class="img" id="vista_kit_f">
              </div>

          </center>
        </div>
      </div>
      -->




      <div class="button">
        <center>
          <button type="submit" name="button" id="guardar" class="send_form">
            <span>Guardar</span>
          </button>
          <a href="#" class="" onclick="$('#kitFidelidad').modal('close'); return false;">
            <span>Cancelar</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>


<div id="eliminarkitFidelidad" class="modal modal_">
  <div class="titulo">
    <h3>
      Esta seguro que desea eliminar este kit
    </h3>
  </div>
  <div class="form">
    <form class="form-horizontal form_send" role="form" method="POST">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <div class="button">
        <center>
          <button type="submit" name="button" class="send_form">
            <span>Si</span>
          </button>
          <a href="#" class="" onclick="$('#eliminarkitFidelidad').modal('close'); return false;">
            <span>No</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>

@endsection
