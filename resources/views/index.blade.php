<?php
  //   (isset($nivel) ? $nivel )
  // $nivel = '../../';
  $nivel = (isset($nivel)) ? $nivel : '../../';
?>
@extends('layouts.appFinal')

@section('content')
<div class="contenedor cliente_final logos valign-wrapper">
	<div class="vista_final logos valign-wrapper">
		<div class="logos">
			<div class="logo_principal logo">
				<img src="{{ $logo }}" alt="">
			</div>
			<div class="titulo">
				<h3>{{ $name }}</h3>
			</div>
			<div class="logo_patrocinador logo">
				<h4>Logo Patrocinante</h4>
			</div>
		</div>
	</div>
</div>
@endsection
