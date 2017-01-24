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
          <a href="{{ route('show_tipoPlato')}}">
            <img src="img/icons/servicio.png" title="Servicio">
          </a>
        </li>
        <li>
          <a href="{{ route('show_language')}}">
            <img src="img/icons/idiomas.png" title="Idiomas">
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/icons/promociones.png" title="Promociones">
          </a>
          <ul>
            <li><a href=""><span>Kit de <br>Bienvenida</span></a></li>
            <li><a href=""><span>Kit de <br>Fidelidad</span></a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>

@endsection
