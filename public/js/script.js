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





// $(document).ready(function (){
//   alert('');
// });

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

// function delete_location(id){
//     $.ajax({
//         type: "get",
//         url: "beacons/delete",
//         data: {id:id},
//         success: function(respuesta) {
//         	if(respuesta == 1){
//         		$('#'+id).fadeOut(300);
//         	} else {
//         		alert('Error');
//         	}
//         }
//     })
// }
//
// function delete_section(id){
//     $.ajax({
//         type: "get",
//         url: "beacons/section/delete",
//         data: {id:id},
//         success: function(respuesta) {
//         	if(respuesta == 1){
//         		$('#'+id).fadeOut(300);
//         	} else {
//         		alert('Error');
//         	}
//         }
//     })
// }

function vistaLogo(evt) {
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
  $(this).keyup(function(){
    verificarInputVacios($(this));
  });
});
inputVerificar.focusout(function(){
  var input = $(this).parent();
  input.removeClass('focus');
  $(this).keyup(function(){
    verificarInputVacios($(this));
  });
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
$('#addbeacon').submit(function(evet){
  evt.preventDefault();
  $.ajax({
      type: "POST",
      url: '/beacons/check',
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



$('#changepassword').submit(function(evt){
  evt.preventDefault();
  var id = $(this).attr('userid');
  var password = $('#password').val();
  var password_confirmation = $('#password_confirmation').val();
  $.ajax({
      type: "POST",
      url: '/user/'+id+'/validate_password',
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

  console.log($('.help').length);

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
