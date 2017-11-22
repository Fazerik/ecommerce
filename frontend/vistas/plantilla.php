<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="title" content="Tienda Virtual Ecommerce">
	<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis, natus.">
	<meta name="keyword" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit.">

	<title>Tienda Virtual</title>
	<!-- ícono -->
	<?php 

		/*=============================================
		=             RUTA DEL PROYECTO           =
		=============================================*/		
		$url = Ruta::ctrRuta();

		/*=============================================
		=             RUTA DEL SERVIDOR           =
		=============================================*/
		$urlServidor = Ruta::ctrRutaServidor();

		/*=============================================
		=             ÍCONO DE PESTAÑA           =
		=============================================*/
		$icono = ControladorPlantilla::ctrEstiloPlantilla();
		echo '<link rel="icon" href="'.$urlServidor.$icono["icono"].'">';


	?>	

	<!--=======================================
	=            RECURSOS EXTERNOS            =
	========================================-->
	
	<!-- Hojas de estilo -->
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/font-awesome.min.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plantilla.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/header.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/slide.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/productos.css">
	<!-- Fuentes -->
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
	<!-- Scripts -->
	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.min.js"></script>
	<script src="<?php echo $url; ?>vistas/js/plugins/bootstrap.min.js"></script>
	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.easing.js"></script>

</head>
<body>

	<?php 

	/*=============================================
	HEADER           	
	=============================================*/
	
	include "modulos/header.php";

	$rutas = array();
	$ruta  = null;
	
	/*=============================================
	=             URL'S AMIGABLES		          =
	=============================================*/

	if (isset($_GET["ruta"])) 
	{
		//separamos la url con explode 
		$rutas = explode("/", $_GET["ruta"]);

		$item  = "ruta";
		$valor = $rutas[0];

		/*=============================================
		=           URL AMIGABLES CATEGORIAS          =
		=============================================*/

		$rutaCategorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

		if ($valor == $rutaCategorias["ruta"]) 
		{
			$ruta = $valor;
		}

		/*=============================================
		=          URL AMIGABLES SUBCATEGORIAS        =
		=============================================*/

		$rutaSubcategorias = ControladorProductos::ctrMostrarSubcategorias($item, $valor);

		foreach ($rutaSubcategorias as $valueRutaSub) 
		{
			if ($valor == $valueRutaSub["ruta"]) 
			{
				$ruta = $rutas[0];
				var_dump($valor);
			}
		}

		/*=============================================
		=             LISTA BLANCA URL'S           =
		=============================================*/

		if ($ruta != null || $rutas[0] == "articulos-gratis" || $rutas[0] == "mas-vendidos" || $rutas[0] == "mas-vistos") 
		{
			include "modulos/productos.php";
		}
		else
		{
			include "modulos/error404.php";
		}
	}
	else
	{
		/*=============================================
		=        	     SLIDE (INDEX)           =
		=============================================*/

		include "modulos/slide.php";
		include "modulos/destacados.php";
	}

	?>

	<!--=============================
	=            SCRIPTS            =
	==============================-->
	<script src="<?php echo $url; ?>vistas/js/header.js"></script>
	<script src="<?php echo $url; ?>vistas/js/plantilla.js"></script>
	<script src="<?php echo $url; ?>vistas/js/slide.js"></script>	
</body>
</html>