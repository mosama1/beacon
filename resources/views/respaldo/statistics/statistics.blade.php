<?php $nivel = '' ?>

@extends('layouts.app')

@section('content')
<div class="contenedor">
	<div class="principal">
		<div class="titulo">
			<h3>
				Estadisticas
			</h3>
		</div>

		<div class="beacons seccion">
			<div class="container">
				<div class="row">
					<div class="col s6">

					</div>
					<div class="col s6 ">
						
					</div>
				</div>
            	<div class="row">
          	     <div class="col s12 m6">
                    <div id="loadingNews" class="loading ">
						<div class="preloader-wrapper big active spin-loader">
							<div class="spinner-layer spinner-blue-only">
							<div class="circle-clipper left">
								<div class="circle"></div>
							</div><div class="gap-patch">
								<div class="circle"></div>
							</div><div class="circle-clipper right">
								<div class="circle"></div>
							</div>
							</div>
						</div>
					</div>
                    <div id="newsAndRecurrents"></div>
              	  </div>
                <div class="col s12 m6" >
                    <div id="loadingUnique" class="loading"> 
						<div class="preloader-wrapper big active spin-loader">
							<div class="spinner-layer spinner-blue-only">
							<div class="circle-clipper left">
								<div class="circle"></div>
							</div><div class="gap-patch">
								<div class="circle"></div>
							</div><div class="circle-clipper right">
								<div class="circle"></div>
							</div>
							</div>
						</div>
					</div>
                    <div id="unique"></div>
                </div>     
              </div>
				
			</div>
		</div>
	</div>
</div>

@endsection