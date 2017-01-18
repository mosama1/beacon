<?php $nivel = '../../' ?>
@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Descripción del Platos
      </h3>
    </div>

    <div class="form">
      @if (session('status'))
        <span class="help-block">
          <strong>{{ session('status') }}</strong>
        </span>
      @endif
      <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"  action="{{ route('update_plate', $menu_id) }}">
        {{ csrf_field() }}

        <div class="input no_icon textarea {{ $errors->has('description') ? 'error' : '' }}">
          <!-- <input type="text" name="description" value="" required=""> -->
          <textarea name="description" rows="8" cols="80">{{$plate->description}}</textarea>
          <label for="">
            <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
            <span class="text">Descripción</span>
          </label>
          @if ($errors->has('description'))
          <span class="error_input">
            <strong>{{ $errors->first('description') }}</strong>
          </span>
          @endif
        </div>

        <div class="file-field input-field input_file {{ $errors->has('plato') ? 'has-error' : '' }}">
          <div class="btn">
            <span class="icon"><img src="img/icons/subir_archivo.png" alt=""></span>
            <span>Plato</span>
            <input type="file" name="plato" id="addPlato">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
          @if ($errors->has('plato'))
          <span class="error_input">
            <strong>{{ $errors->first('plato') }}</strong>
          </span>
          @endif
        </div>

        <div class="vista_previa">
          <center  id="vista_previa">
            <div class="img active" id="vista_plato">
              <img src="img/platos/{{$plate->img}}" alt="">
            </div>
          </center>
        </div>
        <!-- vista_previa -->




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

    <!-- <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center orange-text">Descripcion del Platos</h1>

             @if (session('status'))
	           <span class="help-block">
	           	 <strong>{{ session('status') }}</strong>
	           </span>
	         @endif

			    <div class="modal-content">

			    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"  action="{{ route('update_plate', $menu_id) }}">
	            {{ csrf_field() }}

			     <label for="description" class="col-md-4 control-label">Descripcion</label>
	             <input type="text" name="description" value="{{$plate->description}}" autofocus="autofocus" required>

				<div class="file-field input-field">
			      <div class="btn">
			        <span>File</span>
			        <input type="file" name="plato">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text" >
			      </div>
			    </div>

			    </div>
			    <div class="modal-footer">
			      	<div class="form-group">
		                <div class="col-md-6 col-md-offset-4">
		                    <button type="submit" class="btn btn-primary">
		                        Guardar
		                    </button>
		                </div>
		            </div>
			    </div>

			    </form>
			  </div>


        </div>
    </div> -->
@endsection
