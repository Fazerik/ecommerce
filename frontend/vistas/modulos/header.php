<!--=====================================
=           TOP            =
======================================-->


<div class="container-fluid barraSuperior" id="top">
	
	<div class="container">
		
		<div class="row">
			
			<!--=====================================
			=            Redes sociales            =
			======================================-->
			
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 social">
				
				<ul>

					<?php 

					$social = ControladorPlantilla::ctrEstiloPlantilla();

					$jsonRedesSociales = json_decode($social["redes_sociales"], true);

					foreach ($jsonRedesSociales as $key => $value) 
					{
						echo '<li>
								<a href="'.$value["url"].'" target="_blank">
									<i class="fa '.$value["red"].' redSocial '.$value["estilo"].'" aria-hidden="true"></i>
								</a>
							</li>';
					}
					?>
				</ul>
			</div>

			<!--=====================================
			=            Registro            =
			======================================-->
			
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">

				<ul>
					
					<li><a href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
					<li>|</li>
					<li><a href="#modalRegistro" data-toggle="modal">Crear una Cuenta</a></li>
				</ul>
			</div>	
			
		</div>
	</div>
</div>

<!--=====================================
=            HEADER            =
======================================-->

<header class="container-fluid">
	
	<div class="container">
		
		<div class="row" id="header">
			
			<!--=====================================
			=            LOGOTIPO            =
			======================================-->

			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="logotipo">
				
				<a href="#">
					
					<img src="http://localhost/ecommerce/backend/<?php echo $social["logo"] ?>" alt="" class="img-responsive">
				</a>
			</div>

			<!--=====================================
			=            CATEGORÍA Y BUSCADOR       =
			======================================-->
	
			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				
				<!--=====================================
				=            Botón categorías      =
				======================================-->

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 backColor" id="btnCategorias">
					
					<p>

						CATEGORÍAS
						<span class="pull-right">
							<i class="fa fa-bars" aria-hidden="true"></i>
						</span>
					</p>
				</div>

				<!--=====================================
				=            Buscador                 =
				======================================-->

				<div class="input-group col-lg-8 col-md-8 col-sm-8 col-xs-12" id="buscador">
					
					<input type="search" name="buscar" class="form-control" placeholder="Buscar">

					<span class="input-group-btn">
						
						<a href="#">
							
							<button type="submit" class="btn btn-default backColor">								
								<i class="fa fa-search"></i>
							</button>
						</a>
					</span>
				</div>
			</div>

			<!--=====================================
			=            CARRO DE COMPRAS       =
			======================================-->

			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="carro">
				
				<a href="#">

					<button class="btn btn-default pull-left backColor">
						
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</button>

					<p>
						
						TU CESTA
						<span class="cantidadCesta">3</span>
						<br>
						USD $
						<span class="sumaCesta">20</span>
					</p>
				</a>
			</div>
		</div>

		<!--=====================================
		=            CATEGORÍAS       =
		======================================-->

		<div class="col-xs-12 backColor" id="categorias">

			<?php

				$item  = null;
				$valor = null; 

				//obtenemos las categorias desde la BD
				$categorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

				/*==========================================
				=            MOSTRAR CATEGORIAS            =
				==========================================*/
				foreach ($categorias as $categoria)
				{

					echo '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<h4>
								<a href="'.$categoria["ruta"].'" class="pixelCategorias">'.$categoria["categoria"].'</a>
							</h4>
							<hr>
							<ul>';

					$item  = "id_categoria";
					$valor = $categoria["id_categoria"];

					//obtenemos las subcategorias de la bd					
					$subcategorias = ControladorProductos::ctrMostrarSubcategorias($item, $valor);

					/*==========================================
					=            MOSTRAR CATEGORIAS            =
					==========================================*/
					
					foreach ($subcategorias as $subcategoria) 
					{
						echo '<li><a href="'.$subcategoria["ruta"].'" class="pixelSubCategorias">'.$subcategoria["subcategoria"].'</a></li>';
					}

					echo	'</ul>
						</div>';
				}
			?>			
		</div>
	</div>
</header>