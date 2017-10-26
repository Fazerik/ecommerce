<?php 
class ControladorPlantilla 
{

	/*=============================================
	=            SE LLAMA A LA PLANTILLA         =
	=============================================*/	
	
	public function plantilla()
	{
		include "vistas/plantilla.php";
	}

	/*=============================================
	=       ESTILOS DINÁMICOS DE LA PLANTILLA     =
	=============================================*/

	public function ctrEstiloPlantilla() 
	{
		$tabla = "plantilla";

		$respuesta = ModeloPlantilla::mdlEstiloPlantilla($tabla);

		return $respuesta;
	}




}

?>