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