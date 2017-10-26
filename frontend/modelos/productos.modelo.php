<?php 

require_once "conexion.php";

class ModeloProductos
{
	/*==========================================
	=            OBTENER CATEGORIAS            =
	==========================================*/
	
	static public function mdlMostrarCategorias($tabla, $item, $valor)
	{
		if ($item != null) 
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
			
		}

		$stmt -> close();

		/**
		 * Si se requiere realizar una desconexión más segura
		 * se recomienda dejar la variable $stmt en nulo ($stmt=null;)
		 */
		
		$stmt = null;
	}

	/*==========================================
	=            OBTENER SUBCATEGORIAS         =
	==========================================*/

	static public function mdlMostrarSubcategorias($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		/**
		 * Si se requiere realizar una desconexión más segura
		 * se recomienda dejar la variable $stmt en nulo ($stmt=null;)
		 */
		
		$stmt = null;
	}
}