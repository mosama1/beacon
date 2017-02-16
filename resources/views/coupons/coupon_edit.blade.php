<?php

use Beacon\Language;
use Beacon\LanguageUser;
$nivel = '../../'
?>

@extends('layouts.app')

@section('content')


<div class="contenedor">
  <div class="principal">
    <div class="titulo">
      <h3>
        Editar Carta
      </h3>
    </div>

    <div class="form">
      @if (session('status'))
         <span class="help-block">
           <strong>{{ session('status') }}</strong>
         </span>
       @endif
       <form class="form-horizontal" role="form" method="POST" action="{{ route('update_coupon', $coupon->coupon_id ) }}">
         {{ csrf_field() }}
         {{ method_field('PUT') }}

         <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">
             <input type="text" name="name" value="{{ $coupon->coupon_translation[0]->name }}" required="">
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
             <textarea name="description" rows="8" cols="80"> {{ $coupon->coupon_translation[0]->description }}</textarea>
             <label for="">
                 <span class="text">Descripción</span>
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

         <div class="languages ppal">
             @for ($i = 1; $i < count($coupon->coupon_translation); $i++)
                @php
                    $language_user = LanguageUser::where([
                        ['language_id', '=', $coupon->coupon_translation[$i]->language_id],
            			['user_id', '=', Auth::user()->user_id],
            			['status', '=', 1],
            		])->first();
                @endphp
                @if($language_user)
                    @php
                        $language = Language::where([
                            ['id', '=', $language_user->language_id],
                		])->first();
                    @endphp
                    <div class="titulo">

                        <h5>
                            <img src="{{$language->icon}}" alt="" width="30px"> {{$language->name}}
                        </h5>
                    </div>
                    <input type="hidden" name="language_id[]" value="{{$coupon->coupon_translation[$i]->language_id}}">
                    <div class="input no_icon {{ $errors->has('name') ? 'error' : '' }}">

                        <input type="text" name="language_name[]" value="{{ $coupon->coupon_translation[$i]->name }}" required="">
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
                        <textarea name="language_description[]" rows="8" cols="80"> {{ $coupon->coupon_translation[$i]->description }}</textarea>
                        <label for="">
                            <span class="text">Descripción</span>
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
                @endif


             @endfor
         </div>





         <!-- <label><input type="checkbox" id="cbox1" value="first_checkbox"> Este es mi primer checkbox</label><br> -->

         <div class="button">
           <center>
             <button type="submit" name="button" id="guardar">
               <span>Guardar</span>
             </button>
             <a href="{{ route('all_coupon') }}" class="">
               <span>Cancelar</span>
             </a>
           </center>
         </div>
       </form>

    </div>
  </div>
</div>

@endsection
