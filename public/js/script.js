$(document).ready(function() {
  $('select').material_select();
  $('.tooltipped').tooltip({delay: 50});
  $('.materialboxed').materialbox();
});


$('.sb_mn2').click(function(){
  return false;
});

/* Validacion de Inputs */
$('.val_phone').mask('000 00-00-00');
$('.val_zip').mask('00000');
// $('.picker_time').mask('00:00 AA');
$('.picker_time').mask("00:00 AA", {placeholder: "__:__: am/pm"});
$('.num_mask').mask("00000");
$('.price_mask').mask("00,000.00", {reverse: true});
$('.date_mask').mask('00-00-0000 00:00');


$('#menu_name, #menu_type, #menu_price').change(function(){
  $('#old_name').val($('#menu_name').val());
  $('#old_type').val($('#menu_type').val());
  $('#old_price').val($('#menu_price').val());
});


/* Desactivar por pasos 0*/

$('.desactivado a').click(function(){
	return false;
})


/* InTRO JS */


$(document).ready(function(){
    introJs().start();

});

$('.authenticate .divide .divide_cont.new_user .new_user_head .icon a').click(function(){
  if (!$('.authenticate .divide .divide_cont.new_user').hasClass('active')) {
	$('.authenticate .divide .divide_cont.new_user').addClass('active');
  }else {
	$('.authenticate .divide .divide_cont.new_user').removeClass('active');
  }
  return false;
});

function modal_activate(ruta, div) {

	$(div+' form').attr('action', ruta );
}

function vistaKit_B(evt) {
	var files = evt.target.files; // FileList object
	// Obtenemos la imagen del campo "file".
	for (var i = 0, f; f = files[i];i++) {
	  //Solo admitimos imágenes.
	  if (!f.type.match('image.*')) {
		  continue;
	  }
	  var reader = new FileReader();
	  reader.onload = (function(theFile) {
		return function(e) {
		  // Insertamos la imagen
		  $('#vista_kit_b').html([' <img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/> '].join(''));
		};
	  })(f);
	  reader.readAsDataURL(f);
	  setTimeout(function(){
		tamanoImgVista('#vista_kit_b');
	  },500);

	}
}
$('#addKit_b').change(vistaKit_B);

function vistaKit_F(evt) {
	var files = evt.target.files; // FileList object
	// Obtenemos la imagen del campo "file".
	for (var i = 0, f; f = files[i];i++) {
	  //Solo admitimos imágenes.
	  if (!f.type.match('image.*')) {
		  continue;
	  }
	  var reader = new FileReader();
	  reader.onload = (function(theFile) {
		return function(e) {
		  // Insertamos la imagen
		  $('#vista_kit_f').html([' <img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/> '].join(''));
		};
	  })(f);
	  reader.readAsDataURL(f);
	  setTimeout(function(){
		tamanoImgVista('#vista_kit_f');
	  },500);

	}
}
$('#addKit_f').change(vistaKit_F);


function vistaPhoto(evt) {
	var files = evt.target.files; // FileList object
	// Obtenemos la imagen del campo "file".
	for (var i = 0, f; f = files[i];i++) {
	  //Solo admitimos imágenes.
	  if (!f.type.match('image.*')) {
		  continue;
	  }
	  var reader = new FileReader();
	  reader.onload = (function(theFile) {
		return function(e) {
		  // Insertamos la imagen
		  $('#vista_photo').html([' <img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/> '].join(''));
		};
	  })(f);
	  reader.readAsDataURL(f);
	  setTimeout(function(){
		tamanoImgVista('#vista_photo');
	  },500);
	}
}
$('#addPhoto').change(vistaPhoto);


function vistaLogo(evt) {
	var files = evt.target.files; // FileList object
	// Obtenemos la imagen del campo "file".
	for (var i = 0, f; f = files[i];i++) {
	  //Solo admitimos imágenes.
	  if (!f.type.match('image.*')) {
		  continue;
	  }
	  var reader = new FileReader();
	  reader.onload = (function(theFile) {
		return function(e) {
		  // Insertamos la imagen
		  $('#vista_logo').html([' <img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/> '].join(''));
		};
	  })(f);
	  reader.readAsDataURL(f);
	  setTimeout(function(){
		tamanoImgVista('#vista_logo');
	  },500);
	}
}
function vistaPromo(evt) {
	var files = evt.target.files; // FileList object
	// Obtenemos la imagen del campo "file".
	for (var i = 0, f; f = files[i];i++) {
	  //Solo admitimos imágenes.
	  if (!f.type.match('image.*')) {
		  continue;
	  }
	  var reader = new FileReader();
	  reader.onload = (function(theFile) {
		return function(e) {
		  // Insertamos la imagen
		  $('#vista_promo').html([' <img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/> '].join(''));
		};
	  })(f);
	  reader.readAsDataURL(f);
	  setTimeout(function(){
		tamanoImgVista('#vista_promo');
	  },500);
	}
}
$('#addPromo').change(vistaPromo);

function vistaFondo(evt) {
	var files = evt.target.files; // FileList object
	// Obtenemos la imagen del campo "file".
	for (var i = 0, f; f = files[i]; i++) {
	  //Solo admitimos imágenes.
	  if (!f.type.match('image.*')) {
		  continue;
	  }
	  var reader = new FileReader();
	  reader.onload = (function(theFile) {
		return function(e) {
		  $('#vista_fondo').html([' <img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '" /> '].join(''));
		};
	  })(f);
		reader.readAsDataURL(f);
		setTimeout(function(){
		  tamanoImgVista('#vista_fondo');
		},500);

	}
}
$('#addFondo').change(vistaFondo);


function vistaPlato(evt) {
	var files = evt.target.files; // FileList object
	// Obtenemos la imagen del campo "file".
	for (var i = 0, f; f = files[i]; i++) {
	  //Solo admitimos imágenes.
	  if (!f.type.match('image.*')) {
		  continue;
	  }
	  var reader = new FileReader();
	  reader.onload = (function(theFile) {
		return function(e) {
		  $('#vista_plato').html([' <img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '" /> '].join(''));
		};
	  })(f);
		reader.readAsDataURL(f);
		setTimeout(function(){
		  tamanoImgVista('#vista_plato');
		},500);
	}
}
$('#addPlato').change(vistaPlato);



function vistamadiraje(evt) {
	var files = evt.target.files; // FileList object
	// Obtenemos la imagen del campo "file".

    if ( files.length > 3 ){
        Materialize.toast('Ha superado el máximo de fotos permitido (3 fotos máximo)', 5000, 'error');
        $('#addImg_madiraje').val('');
        $('.file-path').val('');
        $('.thumb').remove();
    	return false;
    }

	for (var i = 0, f; f = files[i]; i++) {
	  //Solo admitimos imágenes.

	  if (!f.type.match('image.*')) {
		  continue;
	  }
	  var reader = new FileReader();
	  reader.onload = (function(theFile) {
		return function(e) {
		  $('#vista_madiraje').append(['<div class="img_madiraje"> <img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '" /> </div> '].join(''));
		};
	  })(f);
		reader.readAsDataURL(f);
		setTimeout(function(){
		  tamanoImgVista('#vista_madiraje');
		},500);
	}
}
$('#addImg_madiraje').change(vistamadiraje);

function tamanoImgVista(id) {
  if ($(id+' img').length > 0) {
	setTimeout(function(){
	  var width_img = $(id+' img').width();
	  var height_img = $(id+' img').height();
	  var width = $(id).width();
	  var height = $(id).height();
	  if (width >= width_img && height <= height_img) {
		// console.log('img mas grande');
		$(id).addClass('alto');
	  }else {
		$(id).removeClass('alto');
	  }
	  $(id).addClass('active');
	  $('.vista_previa').addClass('active');

	},150);
  }
}
tamanoImgVista('#vista_plato');
tamanoImgVista('#vista_logo');
tamanoImgVista('#vista_kit_b');
tamanoImgVista('#vista_kit_f');
tamanoImgVista('#vista_promo');


function tamanoLogoVistaFinal(){
  var height = $('.vista_final .logo img, .contenedor.cliente_final .principal .inf .img img').height();
  if (height > 170) {
	$('.vista_final .logo img, .contenedor.cliente_final .principal .inf .img img').addClass('alto');
  }
}
tamanoLogoVistaFinal();






function verificarInputVacios(campo) {
  if (campo.val() !== '') {
	$('label', campo.parent()).addClass('none');
  }else {
	$('label', campo.parent()).removeClass('none');
  }
}
var inputVerificar = $('.authenticate .divide .divide_cont .input input, .authenticate .divide .divide_cont .input textarea, .contenedor .principal .form .input input, .modal_ .form .input input, .modal_ .form .input textarea, .contenedor .principal .form .input textarea');



$(document).ready(function(){
  inputVerificar.each(function(){
	verificarInputVacios($(this));
  });
  // verificarInputVacios();
});

inputVerificar.focusin(function(){
  var input = $(this).parent();
  input.removeClass('error');
  input.addClass('focus');
  // $(this).keyup(function(){
  //   verificarInputVacios($(this));
  // });
  // $(this).change(function(){
  //   verificarInputVacios($(this));
  // });
});
inputVerificar.keyup(function(){
  verificarInputVacios($(this));
});
inputVerificar.change(function(){
  verificarInputVacios($(this));
});
inputVerificar.focusout(function(){
  var input = $(this).parent();
  input.removeClass('focus');
  // $(this).keyup(function(){
  //   verificarInputVacios($(this));
  // });
  // $(this).change(function(){
  //   verificarInputVacios($(this));
  // });
});



//Quitar Mensajes de error
setTimeout(function(){
  $('.input_error').fadeOut();
},5000);



// $('.authenticate .divide .divide_cont .input input, .authenticate .divide .divide_cont .input textarea, .contenedor .principal .form .input input, .modal_ .form .input input, .modal_ .form .input textarea').focusin(function(){
//   $('label', $(this).parent()).addClass('none');
//     $(this).focusout(function(){
//       if ($(this).val() === '') {
//         $('label', $(this).parent()).removeClass('none');
//       }
//     });
// });




// document.getElementById('archivo').addEventListener('change', archivo, false);
// console.log(document.getElementById('archivo').addEventListener('change', archivo, false));

$(document).ready(function(){
  // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
  $('.modal').modal();
});


$('.menu ul li a.sb_mn, .menu_cliente ul li a.sb_mn').click(function(){
  var li = $(this).parent();
  var sub_menu = $('ul:not(.sub_menu2)', li);
  var li_sub_menu = $('li', sub_menu);
  var sub_menu_not = $('.menu ul li ul.sub_menu, .menu_cliente ul li ul.sub_menu');


  if (sub_menu.filter('.active').length <= 0) {
	if (sub_menu_not.filter('.active').length >= 1) {
	  // console.log('nd');
	  sub_menu_not.removeClass('active');
	  setTimeout(function(){
		sub_menu_not.addClass('none');
		sub_menu.removeClass('none');
		setTimeout(function(){
		  sub_menu.addClass('active');
		},20);
	  },450);
	}else {
	  sub_menu.removeClass('none');
	  setTimeout(function(){
		sub_menu.addClass('active');
	  },20);
	}
  }else {
	sub_menu.removeClass('active');
	setTimeout(function(){
	  sub_menu.addClass('none');
	},450);
  }


  // $(document).click(function(event){
  //   var id = $(event.target);
  //   var hijos = $(event.target).find('a');
  //   if (sub_menu_not.filter('.active').length >= 1) {
  //     if (id.filter('.sub_menu').length <= 0) {
  //       sub_menu.removeClass('active');
  //       setTimeout(function(){
  //         sub_menu.addClass('none');
  //       },450);
  //     }
  //   }
  // });
  return false;
});



// $('.menu_cliente ul li ul.sub_menu').show(function(){
//   alert('');
// });
// $(window).click(function(){
//   $('.menu_cliente ul li ul.sub_menu').show(function(){
//     alert('oiasd')
//   });
// });

function divideHeight() {
  var width = $(window).width();
  if (width >= 993) {
	var height1 = $('#register .divide.reg_user').height();
	var height2 = $('#register .divide.dat_ris').height();
	$('#register .divide.reg_user').height(height2);
  }

}

$(document).ready(divideHeight);
$(window).resize(divideHeight);




$(window).load(function(){
  setTimeout(function(){
	$('.preload .img').fadeOut();
	$('.preload').delay(400).fadeOut();
  },1000);

});
//mayorqueceroenelinput
$('#guardar').click(function(){
  if ($("#filled-in-box").prop('checked') === true) {
	var numero = $('#precioMenu').val();
	if (numero <= 0) {
	  $('#errorPrecioCarta').fadeIn();
	  $('#divPrecioCarta').addClass('error');
	  setTimeout(function(){
		$('#errorPrecioCarta').fadeOut();
	  },5000);
	  return false;
	}
  }
});
//agregarprecio
$( "#filled-in-box" ).click(function() {
  if ($(this).prop('checked') === true) {
	$('#divPrecioCarta').fadeIn();
	$( "#precioMenu" ).prop( "required", true );
	$('#precioMenu').mask('000,000,000,000,0000000.00', {reverse: true});
  }else{
	$('#divPrecioCarta').fadeOut();
  }
});


/*Mostrar vista Previa*/

$('.vistaPreviaImg').click(function(){
  var img = $('img', this).attr('src');
  var nombreDefault = 'Nombre de la Empresa';
  var nombre = $('#nombreEmpresa').val();


  $('.vistaPrevia .logo img').attr('src', img);
  if ($('#nombreEmpresa').val() !== '') {
	$('.vistaPrevia .titulo h3').html(nombre);
  }else {
	$('.vistaPrevia .titulo h3').html(nombreDefault);
  }

  setTimeout(function(){
	$('.vistaPrevia').removeClass('none');
	setTimeout(function(){
	  $('.vistaPrevia').addClass('active');
	},10);
  },100);


  function cerrar() {
	$('.vistaPrevia').removeClass('active');
	setTimeout(function(){
	  $('.vistaPrevia').addClass('none');
	},700);
  }
  $('.vistaPrevia .cerrar').click(cerrar);

  $(document).keyup(function(event){
	if(event.which==27){ cerrar(); }
  });
  return false;
});


/* abrir y cerrar menu en responsive*/

$('.MenuResponsive').click(function(){
  // console.log($('.ul_principal.active').length);

  if ($('.ul_principal.active').length <= 0) {
	$('.ul_principal').addClass('active');
  }else {
	$('.ul_principal').removeClass('active');
  }
  return false;
});




/**************************************************************/
/******************* Validaciones *****************************/
/**************************************************************/
/* Validacion si el beacon esta registrado */
$('#add_beacon').submit(function(event){
  event.preventDefault();
  $.ajax({
	  type: "POST",
	  url: 'beacons/check',
	  data: $('#add_beacon').serialize(),
	  success: function(respuesta) {
		if (respuesta === '0') {
		  $('#add_beacon')[0].submit();
		}else {
		  Materialize.toast('El beacon ya se encuentra registrado', 5000, 'error');
		}
	  }
  });
});

/* Validacion si el madiraje esta registrado */
$('#add_madiraje').submit(function(event){
  event.preventDefault();
  $.ajax({
	  type: "POST",
	  url: 'madirajes/check',
	  data: $('#add_madiraje').serialize(),
	  success: function(respuesta) {	  	
		if (respuesta === '0') {

		  $('#add_madiraje')[0].submit();
		  $('#add_madiraje').prop( "disabled", true );
		}else {

		  Materialize.toast('El Madiraje ya se encuentra registrado', 5000, 'error');
		}
	  }
  });
});




$('#change_password').submit(function(evt){
  evt.preventDefault();
  var id = $(this).attr('userid');
  var password = $('#password').val();
  var password_confirmation = $('#password_confirmation').val();
  $.ajax({
	  type: "POST",
	  url: 'user/'+id+'/validate_password',
	  data: $('#change_password').serialize(),
	  success: function(respuesta) {
		if (respuesta === '1') {
		  if (password == password_confirmation) {
			$('#change_password')[0].submit();
		  }else {
			Materialize.toast('La Contraseña nueva y su confirmacion no coinciden', 5000, 'error');
		  }
		}else {
		  Materialize.toast('La Contraseña actual no coincide', 5000, 'error');
		}
	  }
  });
});

/**************************************************************/
/****************** Mostrar ayudas ****************************/
/**************************************************************/

$('.help a').click(function(){
  var help = $(this).parent();
  var input = help.parent();

  function mostrar(param) {
	param.addClass('active');
	$('.inf', param).removeClass('none');
	setTimeout(function(){
	  $('.inf', param).addClass('active');
	  setTimeout(function(){
		$('.inf', param).removeClass('hidden');
	  },300);
	},10);
  }
  function quitar(param) {
	param.removeClass('active');
	$('.inf', param).addClass('hidden');
	$('.inf', param).removeClass('active');
	setTimeout(function(){
	  setTimeout(function(){
		$('.inf', param).addClass('none');
	  },150);
	},200);
  }

  if ($('.help.active', input).length <= 0) {
	quitar($('.help.active'));
	mostrar(help);
  }else {
	quitar(help);
  }
  return false;
});

/**************************************************************/
/******************* Date Pickers *****************************/
/**************************************************************/

// $('.datetimepicker').datetimepicker();

$.datetimepicker.setLocale('es');
$('.datetimepicker').datetimepicker({
 i18n:{
  de:{
   months:[
	'Enero','Febrero','Marzo','Abril',
	'Mayo','Junio','Julio','Agosto',
	'Septiembre','Octubre','Noviembre','Diciembre',
   ],
   dayOfWeek:[
	"Dom.", "Lun", "Mar", "Mie",
	"Jue", "Vie", "Sab.",
   ]
  }
 },
 timepicker:true,
 format:'d-m-Y h:i'
});

$('.datepicker').datetimepicker({
 i18n:{
  de:{
   months:[
	'Enero','Febrero','Marzo','Abril',
	'Mayo','Junio','Julio','Agosto',
	'Septiembre','Octubre','Noviembre','Diciembre',
   ],
   dayOfWeek:[
	"Dom.", "Lun", "Mar", "Mie",
	"Jue", "Vie", "Sab.",
   ]
  }
 },
 timepicker:false,
 format:'d-m-Y h:i'
});

$('.timepicker').datetimepicker({
  datepicker:false, // true
  format:'H:i'
});


/********************************************************************/
/******************* CheckBox Habilitar *****************************/
/********************************************************************/

function habilitar(id, destino, value) {		
	$.ajax({
		type: "put",
		url: destino+'/'+value+'/habilitar',
		success: function(respuesta) {

			if( respuesta == 0 ){ // se habilito la entidad

				$(id).prop('checked', true);
			} else {

				$(id).prop('checked', false);
			}
		}
	})
}
function checkSubmit() {
    document.getElementById("guardar").value = "Enviando...";
    document.getElementById("guardar").disabled = true;
    return true;
}

$('.form_send').submit(function(){
    $('.send_form').prop('disabled', true);
});


/********************************************************************/
/********************** Preview Campaña *****************************/
/********************************************************************/

function preview_campana( campana_id )
{
	$("#dialog_preview").dialog({

	    autoOpen: false,
	    modal: true,
	    height: 700,
	    width: 450,
	    open: function(ev, ui){
			$('#myIframe').attr( 'src','http://dementecreativo.com/prueba/final/movil/campanas/' + campana_id );
		}
	});
	$('#dialog_preview').dialog('open');
}

/**********************************************************************/
/********************** Preview Promotion *****************************/
/**********************************************************************/

function preview_promotion(id)
{
	$('#dialog_preview_promotion').dialog({
	    autoOpen: false,
	    modal: true,
	    height: 700,
	    width: 450,
	    open: function(ev, ui){	    	
			$('#myIframePromotion').attr( 'src','movil/promocion/' + id );
			//$('#myIframePromotion').attr( 'src','http://dementecreativo.com/prueba/final/movil/promocion/' + id);
		}
	});	
	$('#dialog_preview_promotion').dialog('open');
}


/**********************************************************************/
/********************** Preview Promotion *****************************/
/**********************************************************************/

// function log( message ) {
//
// 	$('<div>').text( message ).prependTo( "#log" );
// 	$('#log').scrollTop( 0 );
// }

$( "#madiraje" ).autocomplete({
  source: function( request, response ) {
    $.ajax( {
      url: "madirajes/search",
      dataType: "json",
      data: {
        term: request.term
      },
      success: function( data ) {

        response( data );
      }
    } );
  },
  minLength: 1,
  select: function( event, ui ) {

      var select = '';
      select += '<div class="m_select" id="m_'+ui.item.id+'">';
      select += '<input type="hidden" name="madiraje_id[]" readonly value="'+ui.item.id+'">';
      select += '<span>'+ui.item.value+'</span>';
      select += '<span class="price">'+ui.item.precio+'€</span>';
      select += '<div class="icon">';
      select +=       '<a href="#" class="cerrar" onclick="madirajeSelectQuitar($(this)); return false;">';
        select +=      '<i class="material-icons">clear</i>';
        select +=       '</a>';
        select +=   '</div>';
        select +=  '</div>';

        if ($('.madiraje_select .m_select').length < 3) {
            if ($('#m_'+ui.item.id).length <= 0) {
                $('.madiraje_select').append(select);
            }else {
                $('.madiraje_select .mensaje p').html("Ya has seleccionado este Madiraje");
                setTimeout(function(){
                    $('.madiraje_select .mensaje p').html("");
                },3000);
            }
        }else {
            $('.madiraje_select .mensaje p').html("Máximo 3 Madirajes");
            setTimeout(function(){
                $('.madiraje_select .mensaje p').html("");
            },3000);
        }
        setTimeout(function(){
            $( "#madiraje" ).val("");
        },20);
  }
} );
function madirajeSelectQuitar($this) {
    var select = $this.parent().parent();
    select.fadeOut(300);
    setTimeout(function(){
        select.remove();
    },300);
}


/********************************************************************/
/******************* Consulta Serial Coupon *************************/
/********************************************************************/
$('#verify_promotions').submit(function(e){
	e.preventDefault();
});
$('#verification_code').keypress(function(e) {
    if ( e.which == 13 ) {
        $('#coupon_code').focus();
        e.preventDefault();
    }
});

$('#guardar_verify_coupon').click(function(){
	$('#verify_promotions')[0].submit();
});
/* Valida el codigo de verificación del location */
$('#verification_code').change(function(){      

	$.ajax({
		type: "POST",
		url: 'cupones/code_location',
		data: $(this).serialize(),
		success: function(respuesta) {
			if (respuesta.code === 0) { //si hay errores al buscar código 
					
				//Materialize.toast(respuesta.message, 3000, 'error');
				$('#verify_promotions .mostrar_mensaje p').html( respuesta.message );
				$('#verify_promotions .mostrar_mensaje').addClass('error').addClass('active').removeClass('message');

				setTimeout(function(){
					$('#verify_promotions .mostrar_mensaje').removeClass('error').removeClass('active');
					setTimeout(function(){
						$('#verify_promotions .mostrar_mensaje p').html( '' );	
						$('#verify_promotions .mostrar_mensaje').removeClass('error')	
					}, 500);
				}, 5000);

				$('#verification_code').val('');
				$('#verification_code').focus();
			}else {

				$('#coupon_code').prop('readonly', false);
				$('#coupon_code').focus();
			}
		}
	});
});

$(document).ready(function(){
	var mostrar_mensaje = $('#verify_promotions .mostrar_mensaje');

	if (mostrar_mensaje.filter('.message').length > 0) {
		mostrar_mensaje.addClass('active').removeClass('message');

		setTimeout(function(){
			$('#verify_promotions .mostrar_mensaje').removeClass('active');

			setTimeout(function(){
				$('#verify_promotions .mostrar_mensaje p').html('');
				$('#verify_promotions .mostrar_mensaje').removeClass('error').removeClass('message');
			},500);		
		}, 5000);
	}
});

$('#verify_promotions .mostrar_mensaje a').click(function(e){
	e.preventDefault();

	$('#verify_promotions .mostrar_mensaje').removeClass('active');
	setTimeout(function(){
		$('#verify_promotions .mostrar_mensaje p').html( '' );
		$('#verify_promotions .mostrar_mensaje').removeClass('error').removeClass('message');		
	}, 500);

});

/* Valida el codigo de la promoción */
$('#coupon_code').keyup(function(){
	if ( $('#coupon_code').val().length === 10 )
	{

		verify_cupon();
	}
});
$('#coupon_code').change(function(){

 	verify_cupon();
});
function verify_cupon(){
	$.ajax({
		type: "POST",
		url: 'cupones/code_coupon',
		data: $('#verify_promotions').serialize(),
		success: function(respuesta) {
			if ( respuesta.code === 0 ) {

				$('#verify_promotions .mostrar_mensaje p').html( respuesta.message );
				$('#verify_promotions .mostrar_mensaje').addClass('error').addClass('active').removeClass('message');

				setTimeout(function(){
					$('#verify_promotions .mostrar_mensaje').removeClass('error').removeClass('active');
					setTimeout(function(){
						$('#verify_promotions .mostrar_mensaje p').html( '' );	
						$('#verify_promotions .mostrar_mensaje').removeClass('error')	
					}, 500);
				}, 5000);

				$('#coupon_code').val('');
				$('#coupon_code').attr( 'placeholder', 'Código del cupón' );
				// TODO cambiar el formato del input para que se vea como antes del edit
				// que no sea posible 

			}else {

				data = JSON.parse(respuesta.message);

				if ( data.used_coupon === 1 )
				{
					$('#verify_promotions .vista_previa_promotion').removeClass('active');
					$('#verify_promotions .mostrar_mensaje p').html('El cupón indicado ya ha sido usado.!!!');
					$('#verify_promotions .mostrar_mensaje').addClass('error').addClass('active').removeClass('message');

					$('#coupon_code').val('');
					$('#coupon_code').attr( 'placeholder', 'Código del cupón' );

					setTimeout(function(){
						$('#verify_promotions .mostrar_mensaje').removeClass('error').removeClass('active');
						setTimeout(function(){
							$('#verify_promotions .mostrar_mensaje p').html( '' );	
							$('#verify_promotions .mostrar_mensaje').removeClass('error')	
						}, 500);
					}, 5000);
				}
				else
				{

					$('#coupon_code').prop( 'readonly', true );
					$('#verify_promotions .vista_previa_promotion img').prop('src', data.img_coupon );
					$('#verify_promotions .vista_previa_promotion').addClass('active');

					$('#guardar_verify_coupon').fadeIn();

					var formData = new FormData( this );
				}
			}
		}
	});
};

$('#verify_promotions .vista_previa_promotion a').click(function(e){
	e.preventDefault();
	var item = $(this).parent().parent();

	item.addClass('ver');
});
$('#verify_promotions .vista_previa_promotion a').blur(function(){
	var item = $(this).parent().parent();

	item.removeClass('ver');

});

// function eliminar(){
// 	document.getElementById("eliminar").value = "Enviando...";
// 	document.getElementById("eliminar").disabled = true;
// 	return true;
//
// }
/***************************************************************/
/******************* Traducciones  *****************************/
/***************************************************************/

// $('.select_language').click(function(){
//     var div = $(this).parent();
//
//     if (div.filter('.active').length <= 0) {
//         div.addClass('active');
//         $('input, textarea', div).prop('disabled', false);
//     }else {
//         div.removeClass('active');
//         $('input, textarea', div).prop('disabled', true);
//
//     }
//     return false;
// });
// $('.default input').keyup(function(){
//     var value = $(this).val();
//     $('.languages input').val(value);
//     verificarInputVacios($('.languages input'));
// });
//
// $('.default textarea').keyup(function(){
//     var value = $(this).val();
//
//     $('.languages textarea').each(function(){
//         if ($(this).val() === '') {
//             $('.languages textarea').val(value);
//
//         }
//     });
//     verificarInputVacios($('.languages textarea'));
// });
