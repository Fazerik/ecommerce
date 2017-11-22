/*================================
=            PANTILLA            =
================================*/
/**
 * Obtenemos los colores de la barra superior y del template en general 
 * desde la BD, permitiendo una plantilla dinámica en cuanto a sus colores
 */

$.ajax({

    url: "ajax/plantilla.ajax.php",
    success: function(respuesta) {

        var jsonRespuesta = JSON.parse(respuesta),
            colorFondo = jsonRespuesta.color_fondo,
            colorTexto = jsonRespuesta.color_texto,
            barraSuperior = jsonRespuesta.barra_superior,
            textoSuperior = jsonRespuesta.texto_superior;

        $(".backColor, .backColor a").css({ "background": colorFondo, "color": colorTexto });
        $(".barraSuperior, .barraSuperior a").css({ "background": barraSuperior, "color": textoSuperior });
    }
});

/*=====  End of PANTILLA  ======*/



/*==========================================
=            LISTA / CUADRÍCULA            =
==========================================*/

// var btnList = $('.btnList');
// $('#btnGrid0').click(function() {
//     $('.list0').toggleClass('hidden');
//     $('.grid0').toggleClass('hidden');
// });

// $('#btnList0').click(function() {
//     $('.grid0').toggleClass('hidden');
//     $('.list0').toggleClass('hidden');
// });

$('.btnGrid, .btnList').click(function(event) {
    var btnActual = $(this),
        btnHermano = $(this).siblings('button'),
        id = btnActual.attr("id").substr(-1);

        $(btnActual).addClass('backColor').css('color', 'white');;
        $(btnHermano).attr('style', '').removeClass('backColor');

        if ($(this).hasClass('btnList')) {
            $('.grid' + id).addClass('hidden');
            $('.list' + id).removeClass('hidden');            
        } else {
            $('.list' + id).addClass('hidden');
            $('.grid' + id).removeClass('hidden'); 
        }

});

/*=====  End of LISTA / CUADRÍCULA  ======*/
