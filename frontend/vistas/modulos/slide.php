<!--===============================
=            SLIDESHOW            =
================================-->


<div class="container-fluid" id="slide">	
	<div class="row">

		<!--============================
		=            SLIDES            =
		=============================-->
		
			<ul>		

				<?php 

					/*=============================================
					=             RUTA DEL SERVIDOR           =
					=============================================*/
					$urlServidor = Ruta::ctrRutaServidor();


					$slides =  ControladorSlide::ctrMostrarSlide();

					foreach ($slides as $slide) 
					{
						$estiloImgProducto = json_decode($slide["estilo_img_producto"], true);
						$estitloTextoSlide = json_decode($slide["estilo_texto_slide"], true);
						$titulo1           = json_decode($slide["titulo_1"], true);
						$titulo2           = json_decode($slide["titulo_2"], true);
						$titulo3           = json_decode($slide["titulo_3"], true);

						echo '<li>

							<img src="'.$urlServidor.$slide["img_fondo"].'" alt="slide">

							<div class="slideOpciones '.$slide["tipo_slide"].'">

								<img class="js-imgProducto" src="'.$urlServidor.$slide["img_producto"].'" alt="" style="top:'.$estiloImgProducto["top"].'; right:'.$estiloImgProducto["right"].'; width: '.$estiloImgProducto["width"].'; left: '.$estiloImgProducto["left"].';">

								<div class="textosSlide" style="top:'.$estitloTextoSlide["top"].'; right:'.$estitloTextoSlide["right"].'; width: '.$estitloTextoSlide["width"].'; left: '.$estitloTextoSlide["left"].';">

									<h1 style="color:'.$titulo1["color"].';">'.$titulo1["texto"].'</h1>

									<h2 style="color:'.$titulo2["color"].';">'.$titulo2["texto"].'</h2>

									<h3 style="color:'.$titulo3["color"].';">'.$titulo3["texto"].'</h3>

									<a href="'.$slide["url"].'">
										'.$slide["boton"].'
									</a>

								</div>

							</div>
						</li>';						
					}
				?>
			</ul>		
		<!--====  End of SLIDES  ====-->	


		<!--=============================
		=            PAGINACIÓN           =
		==============================-->

		<ol id="paginacion">

			<?php 
			
				$numSlides = count($slides);

				for ($i = 1; $i <= $numSlides ; $i++) 
				{
					echo '<li item="'.$i.'"><span class="fa fa-circle"></span></li>';
				}

			?>

		</ol>

		<!--=============================
		=            FLECHAS           =
		==============================-->

		<div class="flechas" id="retroceder"><span class="fa fa-chevron-left"></span></div>
		<div class="flechas" id="avanzar"><span class="fa fa-chevron-right"></span></div>
	</div>
</div>

<center>
	<button id="btnSlide" class="backColor">
		<i class="fa fa-angle-up"></i>
	</button>
</center>