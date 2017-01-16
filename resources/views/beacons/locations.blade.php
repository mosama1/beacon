@extends('layouts.app')

@section('content')

<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Ubicaci&oacute;nes
      </h3>
    </div>
    <div class="agregar">
      <center>
        <a href="{{ route('location_add') }}" class="waves-effect">
          <div class="">
            <span class="text">Agregar <br><strong>Ubicacion</strong></span>
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
                  <th data-field="country">Pais</th>
                  <th data-field="city">Ciudad</th>
                  <th data-field="street">Calle</th>
                  <th data-field="zip">Codigo postal</th>
                  <th>Ediar</th>
                  <!--<th>Eliminar</th>-->

              </tr>
            </thead>

            <tbody>
              @foreach($locations as $l)
                <tr id="{{$l->location_id}}">
                  <td>{{$l->name}}</td>
                  <td>{{$l->country}}</td>
                  <td>{{$l->city}}</td>
                  <td>{{$l->street}}</td>
                  <td>{{$l->zip}}</td>
                  <td><a href="{{ route('edit_location', $l->location_id) }}"><i class="material-icons">edit</i></a></td>
                  <!--<td><a href="#" onclick="delete_location({{$l->location_id}})"><i class="material-icons">clear</i></a></td>-->

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
