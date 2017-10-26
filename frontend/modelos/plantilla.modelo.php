<?php 

require_once "conexion.php";

class ModeloPlantilla 
{


	//Se traen los datos del estilo de la plantilla (Redes sociales)
	static public function mdlEstiloPlantilla($tabla) {

		$stmt = Conexion::conectar()->prepare("select * from $tabla");

		$stmt -> execute();

		//si se devuelve más de una fila desde la BD, se utiliza fetchAll()
		return $stmt -> fetch(); 

		$stmt -> close();
	}
}

