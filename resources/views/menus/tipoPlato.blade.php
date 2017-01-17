<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Platos del menu
      </h3>
    </div>

    <div class="agregar">
      <center>
        <a href="#tipoPlato" class="waves-effect">
          <div class="">
            <span class="text">Agregar <br><strong>Platos<br>Menu</strong></span>
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
                <th data-field="id">Tipo</th>
                <th data-field="id">Editar</th>
                <th data-field="name">Eliminar</th>
              </tr>
            </thead>

            <tbody>
              <tr id=''>
                <td>Tipo</td>
                <td>Descripcion</td>
                <td><i class="material-icons">pencil</i></td>
                <td><a href="#" onclick=""><i class="material-icons">clear</i></a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="tipoPlato" class="modal modal_">
  <div class="titulo">
    <h3>
      Agregar Plato
    </h3>
  </div>

  <div class="form">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('store_menu') }}">
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


      <div class="input no_icon {{ $errors->has('price') ? 'error' : '' }}">
        <input type="text" name="price" value="" required="">
        <label for="">
          <!-- <span class="icon"><img src="img/icons/correo.png" alt=""></span> -->
          <span class="text">Precio</span>
        </label>
        @if ($errors->has('price'))
          <span class="error_input">
              <strong>{{ $errors->first('price') }}</strong>
          </span>
        @endif
      </div>
      <div class="button">
        <center>
          <button type="submit" name="button">
            <span>Guardar</span>
          </button>
          <a href="#" class="" onclick="$('#tipoPlato').modal('close'); return false;">
            <span>Cancelar</span>
          </a>
        </center>
      </div>
    </form>
  </div>
</div>
