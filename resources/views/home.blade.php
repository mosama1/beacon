@extends('layouts.app')

@section('content')
  <div class="contenedor">
    <div class="principal">
      <ul class="links">
        <li>
          <a href="{{ route('show_coupon') }}">
            <img src="img/icons/menu.png" title="Menú">
          </a>
        </li>
        <li>
          <a href="{{ route('show_timeframe')}}">
            <img src="img/icons/horarios.png" title="Horarios">
          </a>
        </li>
        <li>
          <a href="{{ route('show_campana')}}">
            <img src="img/icons/plan.png" title="Planificación">
          </a>
        </li>
        <li>
          <a href="{{ route('all_type_plate')}}">
            <img src="img/icons/servicio.png" title="Servicio">
          </a>
        </li>
        <li>
          <a href="{{ route('all_language') }}">
            <img src="img/icons/idiomas.png" title="Idiomas">
          </a>
        </li>
      </ul>
    </div>
  </div>

@endsection
