$(document).ready(function(){

	animacionInicial(item);
});


/*=============================================
=   	       CSS DINÁMICO  			          =
=============================================*/

$('#slide ul li').css({'width': 100 / $('#slide ul li').length + "%"});
$('#slide ul ').css({'width': $('#slide ul li').length * 100 + "%"});


/*=============================================
=   	       VARIABLES  			          =
=============================================*/

var item = 0,
	itemPaginacion   = $('#paginacion li'),
	interrumpirCiclo = false,
	imgProducto      = $('.js-imgProducto'),
	titulos1         = $('#slide h1'),
	titulos2         = $('#slide h2'),
	titulos3         = $('#slide h3'),
	btnVerProducto   = $('#slide button');

/*=============================================
=   	       ANIMACIÓN INICIAL  		       =
=============================================*/

function animarSlide(objeto){

	if (objeto != undefined) {

		if (objeto.localName === "img") {

			$(objeto).animate({"top": -10 + "%", "opacity": 0}, 100);
			$(objeto).animate({"top": 5 + "px", "opacity": 1}, 1300);

		} else {    	

			$(objeto).animate({"top": -10 + "%", "opacity": 0}, 100);
			$(objeto).animate({"top": 30 + "px", "opacity": 1}, 1900);
		}
		
	}	

}


function animacionInicial(item){

	// Animación Imagen
	animarSlide(imgProducto[item]);
	// Animación Títulos
	animarSlide(titulos1[item]);
	animarSlide(titulos2[item]);
	animarSlide(titulos3[item]);
	animarSlide(btnVerProducto[item]);	
}

/*=============================================
=   	       PAGINACIÓN  			          =
=============================================*/

$("#paginacion li").click(function() {
	
	item = $(this).attr("item") - 1;
	
	movimientoSlide(item);
});

/*=============================================
=   	       AVANZAR  			  =
=============================================*/

function avanzar(){
	
	if (item === $('#slide ul li').length -1) {
		item = 0;
	}else {
		item += 1;
	}

	movimientoSlide(item);
}

$('#slide #avanzar').click(function() {
	
	avanzar();
});


/*=============================================
=   	       RETROCEDER  			  =
=============================================*/

function retroceder(){

	if (item === 0) {

		item = $('#slide ul li').length -1;
	}else {
		item -= 1;
	}

	movimientoSlide(item);
}

$('#slide #retroceder').click(function() {
	
	retroceder();
});

/*=============================================
=   	       MOVIMIENTOSLIDE  			  =
=============================================*/

function movimientoSlide(item){
	
	$('#slide ul').animate({"left": item * -100 + "%"}, 1000, "easeOutCirc");

	$('#paginacion li').css({'opacity': .5});

	$(itemPaginacion[item]).css({'opacity': 1});

	interrumpirCiclo = true;

	animacionInicial(item);
}


/*=============================================
=   	       INTERVALO  			  =
=============================================*/

setInterval(function(){

	if (interrumpirCiclo) {

		interrumpirCiclo = false;
	}else {

		avanzar();
	}

}, 4000);

/*=============================================
=   	       MOSTRAR FLECHAS  			  =
=============================================*/

$('#slide').mouseover(function(){
	 
 	$('#slide #retroceder').css({'opacity': 1});
 	$('#slide #avanzar').css({'opacity': 1});

 	interrumpirCiclo = true;
});

$('#slide').mouseout(function(){
	 
	$('#slide #retroceder').css({'opacity': 0});
	$('#slide #avanzar').css({'opacity': 0});

	interrumpirCiclo = false;
});

/*=============================================
=   	      OCULTAR SLIDE 			  =
=============================================*/

$('#btnSlide').click(function() {

	var btnSlide = $('#btnSlide i')[0];

	$('#slide').slideToggle("fast");

	if ($(btnSlide).hasClass('fa-angle-up')) {

		$(btnSlide).removeClass('fa-angle-up');
		$(btnSlide).addClass('fa-angle-down');
		
	} else if ($(btnSlide).hasClass('fa-angle-down')){

		$(btnSlide).removeClass('fa-angle-down');
		$(btnSlide).addClass('fa-angle-up');
	}

});