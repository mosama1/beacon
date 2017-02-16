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
//   alert('');
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
$('#addLogo').change(vistaLogo);
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
		  $('#vista_madiraje').append(['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '" /> '].join(''));
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
 format:'d-m-Y h:m'
});


$('.timepicker').datetimepicker({
  datepicker:false,
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
