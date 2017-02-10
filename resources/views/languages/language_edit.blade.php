<?php $nivel = '../../' ?>

@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar Idioma
      </h3>
    </div>

    <div class="form">
      @if (session('status'))
         <span class="help-block">
           <strong>{{ session('status') }}</strong>
         </span>
       @endif
       <form class="form-horizontal" role="form" method="POST" action="{{ route( 'update_language', $language->id ) }}">
        {{ csrf_field() }}

        <input type="hidden" name="_method" value="PUT">


        <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
          <input type="text" name="name" value="{{$language->name}}" required="">
          <label for="">
            <span class="text">Idioma</span>
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

        <div class="input no_icon {{ $errors->has('abbreviation') ? 'error' : '' }}">
          <input type="text" name="abbreviation" value="{{$language->abbreviation}}" required="">
          <label for="">
            <span class="text">Abreviatura</span>
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
        @if ($errors->has('abbreviation'))
        <div class="input_error">
          <span>{{ $errors->first('abbreviation') }}</span>
        </div>
        @endif



        <div class="button">
          <center>
            <button type="submit" name="button">
              <span>Guardar</span>
            </button>
            <a href="{{ URL::previous() }}" class="">
              <span>Cancelar</span>
            </a>
          </center>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection

@foreach($languages as $language)
<tr id="{{$language->id}}">
    <td>{{$language->name}}</td>
    <td>{{$language->abbreviation}}</td>
    <td>{{$language->icon}}</td>
    <td><a href="{{ route('edit_language', $language->id)}}"><i class="material-icons">edit</i></a></td>
    <?php

        echo "<td onclick= \"modal_activate('".
             route( "destroy_language", $language->id ).
            "' , '#eliminarLanguaje')\" >";

    ?>
    <a href="#eliminarLanguaje"><i class="material-icons">clear</i></a></td>
    <td>
        <div class="switch">
            <label>
                Si
                <input type="checkbox">
                <span class="lever"></span>
                No
            </label>
        </div>
    </td>
</tr>

@endforeach
