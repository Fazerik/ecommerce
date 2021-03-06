<?php 

	
class ControladorProductos
{
	/*==========================================
	=            MOSTRAR CATEGORIAS            =
	==========================================*/
	
	static public function ctrMostrarCategorias($item, $valor)
	{
		$tabla = "categorias";

		$respuesta = ModeloProductos::mdlMostrarCategorias($tabla, $item, $valor);

		return $respuesta;	
	}	
	

	/*==========================================
	=            MOSTRAR SUBCATEGORIAS            =
	==========================================*/

	static public function ctrMostrarSubcategorias($item, $valor)
	{
		$tabla = "subcategoria";

		$respuesta = ModeloProductos::mdlMostrarSubcategorias($tabla, $item, $valor);

		return $respuesta;
	}

	/*==========================================
	=            MOSTRAR PRODUCTOS            =
	==========================================*/

	static public function ctrMostrarProductos($selector, $item, $valor)
	{
		$tabla = "producto";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $selector, $item, $valor);

		return $respuesta;
	}

}