$(document).ready(function() {
  $('select').material_select();
  $('.tooltipped').tooltip({delay: 50});
  $('.materialboxed').materialbox();

 //  $('.button-collapse').sideNav({
 //     menuWidth: 100, // Default is 240
 //    //  edge: 'right', // Choose the horizontal origin
 //     closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
 //     draggable: true // Choose whether you can drag to open on touch screens
 //   }
 // );

});








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

function delete_location(id){
    $.ajax({
        type: "get",
        url: "beacons/delete",
        data: {id:id},
        success: function(respuesta) {
        	if(respuesta == 1){
        		$('#'+id).fadeOut(300);
        	} else {
        		alert('Error');
        	}
        }
    })
}

function delete_session(id){
    $.ajax({
        type: "get",
        url: "beacons/session/delete",
        data: {id:id},
        success: function(respuesta) {
        	if(respuesta == 1){
        		$('#'+id).fadeOut(300);
        	} else {
        		alert('Error');
        	}
        }
    })
}

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
      tamanoImgVista('#vista_logo');

      // setTimeout(function(){
      //   var width_img = $('#vista_logo img').width();
      //   var height_img = $('#vista_logo img').height();
      //   var width = $('#vista_logo').width();
      //   var height = $('#vista_logo').height();
      //   if (width >= width_img && height <= height_img) {
      //     // console.log('img mas grande');
      //     $('#vista_logo').addClass('alto');
      //   }else {
      //     $('#vista_logo').removeClass('alto');
      //   }
      //   $('#vista_fondo').removeClass('active');
      //   $('#vista_logo').addClass('active');
      // },150);
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
        tamanoImgVista('#vista_fondo');

        // setTimeout(function(){
        //   var width_img = $('#vista_fondo img').width();
        //   var height_img = $('#vista_fondo img').height();
        //   var width = $('#vista_fondo').width();
        //   var height = $('#vista_fondo').height();
        //   if (width >= width_img && height <= height_img) {
        //     // console.log('img mas grande');
        //     $('#vista_fondo').addClass('alto');
        //   }else {
        //     $('#vista_fondo').removeClass('alto');
        //   }
        //   $('#vista_logo').removeClass('active');
        //   $('#vista_fondo').addClass('active');
        // },150);
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
        tamanoImgVista('#vista_plato');
        // setTimeout(function(){
        //   var width_img = $('#vista_plato img').width();
        //   var height_img = $('#vista_plato img').height();
        //   var width = $('#vista_plato').width();
        //   var height = $('#vista_plato').height();
        //   if (width >= width_img && height <= height_img) {
        //     // console.log('img mas grande');
        //     $('#vista_plato').addClass('alto');
        //   }else {
        //     $('#vista_plato').removeClass('alto');
        //   }
        //   $('#vista_plato').addClass('active');
        // },150);
    }
}
$('#addPlato').change(vistaPlato);

function tamanoImgVista(id) {
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
  },150);
}
tamanoImgVista('#vista_plato');

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



// $('.authenticate .divide .divide_cont .input input, .authenticate .divide .divide_cont .input textarea, .contenedor .principal .form .input input, .modal_ .form .input input, .modal_ .form .input textarea').keyup(function(){
//
//   var input = $(this).parent();
//
//   if ($(this).val() !== '') {
//     input.addClass('focus');
//     // $('label', $(this).parent()).addClass('none');
//   }else {
//     // $('label', $(this).parent()).removeClass('none');
//     input.removeClass('focus');
//
//   }
//
//   console.log(input);
//
//   // verificarInputVacios();
// });

inputVerificar.focusin(function(){
  var input = $(this).parent();
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
  var sub_menu = $('ul', li);
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
  var height1 = $('#register .divide.reg_user').height();
  var height2 = $('#register .divide.dat_ris').height();
  $('#register .divide.reg_user').height(height2);
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
  var numero = $('#precioMenu').val();
  if (numero <= 0) {
    alert('El monto debe ser mayor a cero');
    return false;
  }
});
//agregarprecio
$( "#filled-in-box" ).click(function() {
  if ($(this).prop('checked') == true) {
    $('#divPrecioMenu').fadeIn();
    $( "#precioMenu" ).prop( "required", true );
    $('#precioMenu').mask('000,000,000,000,0000000.00', {reverse: true});
  }else {
    $('#divPrecioMenu').fadeOut();
  }
});
