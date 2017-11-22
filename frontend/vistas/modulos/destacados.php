<?php  
	/*=============================================
	=             RUTA DEL SERVIDOR           =
	=============================================*/
	$urlServidor = Ruta::ctrRutaServidor();
?>


<!--============================
=            BANNER            =
=============================-->

<figure class="banner">
	<img src="http://localhost/ecommerce/backend/vistas/img/banner/default.jpg" class="img-responsive" width="100%">

	<div class="textoBanner textoCentro">
		<h1 style="color:#fff;">OFERTAS ESPECIALES</h1>
		<h2 style="color:#fff;"><strong>50% off</strong></h2>
		<h3 style="color:#fff;">Termina el 30 de Noviembre</h3>
	</div>
</figure>

<?php
	$precioFinal    = 0;	
	$titulosModulos =  array("ARTÍCULOS GRATUITOS", "LO MÁS VENDIDO", "LO MÁS VISTO");
	$rutaModulos    = array("articulos-gratis", "mas-vendidos", "mas-vistos");

	if ($titulosModulos[0] == "ARTÍCULOS GRATUITOS") 
	{
		$selector = "id_producto";
		$item     = "precio";
		$valor    = 0;
		$gratis   = ControladorProductos::ctrMostrarProductos($selector, $item, $valor);		
	}

	if ($titulosModulos[1] == "LO MÁS VENDIDO") 
	{
		$selector = "ventas";
		$item     = null;
		$valor    = null;
		$ventas   = ControladorProductos::ctrMostrarProductos($selector, $item, $valor);		
	}

	if ($titulosModulos[2] == "LO MÁS VISTO") 
	{
		$selector = "vistas";
		$item     = null;
		$valor    = null;
		$vistas   = ControladorProductos::ctrMostrarProductos($selector, $item, $valor);		
	}

	$modulos = array($gratis, $ventas, $vistas);

	for ($i = 0; $i < count($titulosModulos); $i++) 
	{
		echo '<div class="container-fluid well well-sm barraProductos">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 organizarProductos">
							<div class="btn-group pull-right">
								<button type="button" class="btn backColor btnGrid" id="btnGrid'.$i.'">
									<i class="fa fa-th" aria-hidden="true"> </i>

									<span class="col-xs-0 pull-right">GRID</span>
								</button>

								<button type="button" class="btn btnList" id="btnList'.$i.'">
									<i class="fa fa-list" aria-hidden="true"> </i>

									<span class="col-xs-0 pull-right">LIST</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid productos">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 tituloDestacado">
							<div class="col-sm-6 col-sm-12">
								<h1><small>'.$titulosModulos[$i].'</small></h1>
							</div>
							<div class="col-sm-6 col-sm-12">
								<a href="'.$rutaModulos[$i].'">
									<button class="btn btn-default backColor pull-right">
										VER MAS
										<span class="fa fa-chevron-right"></span>
									</button>
								</a>
							</div>
						</div>
						<div class="clearfix"></div>
						<hr>
					</div>
					<ul class="grid'.$i.'">';

					foreach ($modulos[$i] as $modulo =>	$value) 
					{
						echo '<li class="col-md-3 col-sm-6 col-xs-12">
								<figure>
									<a href="'.$value["ruta"].'" class="pixelProducto">
										<img src="'.$urlServidor.$value["portada"].'" class="img-responsive">
									</a>
								</figure>
								<h4>
									<small>
										<a href="'.$value["ruta"].'" class="pixelProducto">
											'.$value["titulo"].'
											<br>
											<span class="invisible">-</span>';

											if ($value["nuevo"] != 0) 
											{
												echo '<span class="label label-warning fontSize">Nuevo</span> ';
											}

											if ($value["descuento_oferta"] != 0) 
											{
												echo '<span class="label label-warning fontSize">- '.$value["descuento_oferta"].'%</span>';
											}

									echo '</a>
									</small>
								</h4>
								<div class="col-xs-6 precio">';

								if ($value["precio"] == 0) 
								{
									echo '<h2><small>GRATIS</small></h2>';
								} 
								else 
								{
									if ($value["oferta"] != 0) 
									{
									  	echo '
									  		<h2>
												<small>
													<strong class="oferta">USD $'.$value["precio"].'</strong>
												</small>

												<small>$'.$value["precio_oferta"].'</small>
											</h2>';

										$precioFinal = $value["precio_oferta"];
									}
									else 
									{
										echo '<h2><small>USD $'.$value["precio"].'</small></h2>';

										$precioFinal = $value["precio"];
									}
								}

								echo '
								</div>
								<div class="col-xs-6 enlaces">
									<div class="btn-group pull-right">
										<button type="button" class="btn btn-default btn-xs deseos" idProducto="'.$value["id_producto"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos">
											<i class="fa fa-heart" aria-hidden="true"></i>
										</button>';

										if ($value["tipo"] == "virtual") 
										{
											echo '<button type="button" class="btn btn-default btn-xs agregarCarro" idProducto="'.$value["id_producto"].'" imagen="'.$urlServidor.$value["portada"].'" data-toggle="tooltip" title="Agregar al carro de compras" titulo="'.$value["titulo"].'" precio="'.$precioFinal.'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'">
													<i class="fa fa-shopping-cart" aria-hidden="true"></i>
												</button>';
										}

										echo '
										<a href="'.$value["ruta"].'" class="pixelProducto">
											<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
												<i class="fa fa-eye" aria-hidden="true"></i>
											</button>
										</a>
									</div>
								</div>
							</li>';
					}

					echo '</ul>
				</div>
			</div>';
	}
	// echo json_encode($productos); 
?>

<!--============================
=		BARRA PRODUCTOS		=
=============================-->

<div class="container-fluid well well-sm barraProductos">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 organizarProductos">
				<div class="btn-group pull-right">
					<button type="button" class="btn backColor btnGrid" id="btnGrid0">
						<i class="fa fa-th" aria-hidden="true"> </i>

						<span class="col-xs-0 pull-right">GRID</span>
					</button>

					<button type="button" class="btn btnList" id="btnList0">
						<i class="fa fa-list" aria-hidden="true"> </i>

						<span class="col-xs-0 pull-right">LIST</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!--============================
= VITRINA DE PRODUCTOS GRATIS 	=
=============================-->

<div class="container-fluid productos">
	<div class="container">
		<div class="row">
			<!--============================
			=		BARRA TÍTULOS		=
			=============================-->

			<div class="col-xs-12 tituloDestacado">
				<!-- ======================================== -->

				<div class="col-sm-6 col-sm-12">
					<h1><small>ARTÍCULOS GRATUITOS</small></h1>
				</div>

				<!-- ======================================== -->
				
				<div class="col-sm-6 col-sm-12">
					<a href="articulos-gratis">
						<button class="btn btn-default backColor pull-right">
							VER MAS
							<span class="fa fa-chevron-right"></span>
						</button>
					</a>
				</div>

				<!-- ======================================== -->
			</div>
			<div class="clearfix"></div>
			<hr>
		</div>

		<!--========================================
		=  	VITRINA DE PRODUCTOS EN CUADRÍCULA		=
		===========================================-->

		<ul class="grid0">
			<!-- =========== Producto 1 ============ -->

			<li class="col-md-3 col-sm-6 col-xs-12">
				
				<!-- ====================================================================== -->

				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/vistas/img/productos/accesorios/accesorio04.jpg" class="img-responsive">
					</a>
				</figure>

				<!-- ====================================================================== -->
				
				<h4>
					<small>
						<a href="#" class="pixelProducto">
							Collar de diamantes
							<span class="label label-warning fontSize">-40%</span>
							
						</a>
					</small>
				</h4>

				<!-- ====================================================================== -->

				<div class="col-xs-6 precio">
					<h2><small>GRATIS</small></h2>
				</div>

				<!-- ====================================================================== -->

				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>
				</div>
			</li>
			
			<!-- =========== Producto 2 ============ -->

			<li class="col-md-3 col-sm-6 col-xs-12">
				
				<!-- ====================================================================== -->

				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/vistas/img/productos/accesorios/accesorio03.jpg" class="img-responsive">
					</a>
				</figure>

				<!-- ====================================================================== -->
				
				<h4>
					<small>
						<a href="#" class="pixelProducto">
							Mochila deportiva
						</a>
					</small>
				</h4>

				<!-- ====================================================================== -->

				<div class="col-xs-6 precio">
					<h2><small>GRATIS</small></h2>
				</div>

				<!-- ====================================================================== -->

				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>
				</div>
			</li>

			<!-- =========== Producto 3 ============ -->

			<li class="col-md-3 col-sm-6 col-xs-12">
				
				<!-- ====================================================================== -->

				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/vistas/img/productos/accesorios/accesorio06.jpg" class="img-responsive">
					</a>
				</figure>

				<!-- ====================================================================== -->
				
				<h4>
					<small>
						<a href="#" class="pixelProducto">
							Pañuelo Colores
						</a>
					</small>
				</h4>

				<!-- ====================================================================== -->

				<div class="col-xs-6 precio">
					<h2><small>GRATIS</small></h2>
				</div>

				<!-- ====================================================================== -->

				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>
				</div>
			</li>

			<!-- =========== Producto 2 ============ -->

			<li class="col-md-3 col-sm-6 col-xs-12">
				
				<!-- ====================================================================== -->

				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/vistas/img/productos/accesorios/accesorio01.jpg" class="img-responsive">
					</a>
				</figure>

				<!-- ====================================================================== -->
				
				<h4>
					<small>
						<a href="#" class="pixelProducto">
							Pulsera diamantes	
						</a>
					</small>
				</h4>

				<!-- ====================================================================== -->

				<div class="col-xs-6 precio">
					<h2><small>GRATIS</small></h2>
				</div>

				<!-- ====================================================================== -->

				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>
				</div>
			</li>
		</ul>

		<!--============================
		= VITRINA DE PRODUCTOS EN LISTA	=
		=============================-->

		<ul class="list0 hidden">
			<!-- =========== Producto 1 ============ -->

			<li class="col-xs-12">
				<!-- ======================================== -->
				
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<figure>
						 <a href="#" class="pixelProducto">
						 	<img src="http://localhost/ecommerce/backend/vistas/img/productos/accesorios/accesorio04.jpg" class="img-responsive">
						 </a>
					</figure>
				</div>

				<!-- ======================================== -->

				<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
					<h1>
						<small>
							<a href="#" class="pixelProducto">Collar de diamantes</a>
						</small>
					</h1>

					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, laboriosam, aspernatur. Officiis dicta soluta dolorum nesciunt itaque minus quam asperiores sed nemo pariatur blanditiis, repellat iste deserunt, aperiam eum doloribus atque, aliquid. Voluptas.</p>

					<h2><small>GRATIS</small></h2>
					
					<div class="btn-group pull-left enlaces">
						<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>

				</div>

				<div class="col-xs-12">
					<hr>
				</div>
			</li>

			<!-- =========== Producto 2 ============ -->

			<li class="col-xs-12">
				<!-- ======================================== -->
				
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<figure>
						 <a href="#" class="pixelProducto">
						 	<img src="http://localhost/ecommerce/backend/vistas/img/productos/accesorios/accesorio03.jpg" class="img-responsive">
						 </a>
					</figure>
				</div>

				<!-- ======================================== -->

				<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
					<h1>
						<small>
							<a href="#" class="pixelProducto">Mochila deportiva</a>
						</small>
					</h1>

					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, laboriosam, aspernatur. Officiis dicta soluta dolorum nesciunt itaque minus quam asperiores sed nemo pariatur blanditiis, repellat iste deserunt, aperiam eum doloribus atque, aliquid. Voluptas.</p>

					<h2><small>GRATIS</small></h2>
					
					<div class="btn-group pull-left enlaces">
						<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>

				</div>

				<div class="col-xs-12">
					<hr>
				</div>
			</li>

			<!-- =========== Producto 3 ============ -->

			<li class="col-xs-12">
				<!-- ======================================== -->
				
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<figure>
						 <a href="#" class="pixelProducto">
						 	<img src="http://localhost/ecommerce/backend/vistas/img/productos/accesorios/accesorio02.jpg" class="img-responsive">
						 </a>
					</figure>
				</div>

				<!-- ======================================== -->

				<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
					<h1>
						<small>
							<a href="#" class="pixelProducto">Mochila militar</a>
						</small>
					</h1>

					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, laboriosam, aspernatur. Officiis dicta soluta dolorum nesciunt itaque minus quam asperiores sed nemo pariatur blanditiis, repellat iste deserunt, aperiam eum doloribus atque, aliquid. Voluptas.</p>

					<h2><small>GRATIS</small></h2>
					
					<div class="btn-group pull-left enlaces">
						<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>

				</div>

				<div class="col-xs-12">
					<hr>
				</div>
			</li>	

			<!-- =========== Producto 4 ============ -->

			<li class="col-xs-12">
				<!-- ======================================== -->
				
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<figure>
						 <a href="#" class="pixelProducto">
						 	<img src="http://localhost/ecommerce/backend/vistas/img/productos/accesorios/accesorio01.jpg" class="img-responsive">
						 </a>
					</figure>
				</div>

				<!-- ======================================== -->

				<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
					<h1>
						<small>
							<a href="#" class="pixelProducto">Pulsera diamantes</a>
						</small>
					</h1>

					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, laboriosam, aspernatur. Officiis dicta soluta dolorum nesciunt itaque minus quam asperiores sed nemo pariatur blanditiis, repellat iste deserunt, aperiam eum doloribus atque, aliquid. Voluptas.</p>

					<h2><small>GRATIS</small></h2>
					
					<div class="btn-group pull-left enlaces">
						<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>

				</div>

				<div class="col-xs-12">
					<hr>
				</div>
			</li>			
		</ul>
	</div>
</div>

<!--============================
= BARRA PRODUCTOS MÁS VENDIDOS	=
=============================-->

<div class="container-fluid well well-sm barraProductos">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 organizarProductos">
				<div class="btn-group pull-right">
					<button type="button" class="btn btnGrid backColor" id="btnGrid1">
						<i class="fa fa-th" aria-hidden="true"> </i>

						<span class="col-xs-0 pull-right">GRID</span>
					</button>

					<button type="button" class="btn btnList" id="btnList1">
						<i class="fa fa-list" aria-hidden="true"> </i>

						<span class="col-xs-0 pull-right">LIST</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!--============================
= VITRINA DE PRODUCTOS MÁS VENDIDOS 	=
=============================-->

<div class="container-fluid productos">
	<div class="container">
		<div class="row">
			<!--============================
			=		BARRA TÍTULOS		=
			=============================-->

			<div class="col-xs-12 tituloDestacado">
				<!-- ======================================== -->

				<div class="col-sm-6 col-sm-12">
					<h1><small>ARTÍCULOS MÁS VENDIDOS</small></h1>
				</div>

				<!-- ======================================== -->
				
				<div class="col-sm-6 col-sm-12">
					<a href="articulos-mas-vendidos">
						<button class="btn btn-default backColor pull-right">
							VER MAS
							<span class="fa fa-chevron-right"></span>
						</button>
					</a>
				</div>

				<!-- ======================================== -->

			</div>
			<div class="clearfix"></div>
			<hr>
		</div>

		<!--========================================
		=  	VITRINA DE PRODUCTOS EN CUADRÍCULA		=
		===========================================-->

		<ul class="grid1">
			<!-- =========== Producto 1 ============ -->

			<li class="col-md-3 col-sm-6 col-xs-12">
				
				<!-- ====================================================================== -->

				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/vistas/img/productos/ropa/ropa03.jpg" class="img-responsive">
					</a>
				</figure>

				<!-- ====================================================================== -->
				
				<h4>
					<small>
						<a href="#" class="pixelProducto">
							Falda floreada

							<span class="label label-warning fontSize">Nuevo</span>

							<span class="label label-warning fontSize">-40%</span>
						</a>
					</small>
				</h4> 

				<!-- ====================================================================== -->

				<div class="col-xs-6 precio">
					<h2>
						<small>
							<strong class="oferta">USD $29</strong>
						</small>

						<small>$11</small>
					</h2>
				</div>

				<!-- ====================================================================== -->

				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>
				</div>
			</li>

			<!-- =========== Producto 2 ============ -->

			<li class="col-md-3 col-sm-6 col-xs-12">
				
				<!-- ====================================================================== -->

				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/vistas/img/productos/ropa/ropa04.jpg" class="img-responsive">
					</a>
				</figure>

				<!-- ====================================================================== -->
				
				<h4>
					<small>
						<a href="#" class="pixelProducto">
							VESTIDO JEAN

							<span class="label label-warning fontSize">-40%</span>
						</a>
					</small>
				</h4> 

				<!-- ====================================================================== -->

				<div class="col-xs-6 precio">
					<h2>
						<small>
							<strong class="oferta">USD $29</strong>
						</small>

						<small>$11</small>
					</h2>
				</div>

				<!-- ====================================================================== -->

				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>
				</div>
			</li>

			<!-- =========== Producto 3 ============ -->

			<li class="col-md-3 col-sm-6 col-xs-12">
				
				<!-- ====================================================================== -->

				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/vistas/img/productos/ropa/ropa02.jpg" class="img-responsive">
					</a>
				</figure>

				<!-- ====================================================================== -->
				
				<h4>
					<small>
						<a href="#" class="pixelProducto">
							Sombrero Style

							<span class="label label-warning fontSize">-40%</span>
						</a>
					</small>
				</h4> 

				<!-- ====================================================================== -->

				<div class="col-xs-6 precio">
					<h2>
						<small>
							<strong class="oferta">USD $29</strong>
						</small>

						<small>$11</small>
					</h2>
				</div>

				<!-- ====================================================================== -->

				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>
				</div>
			</li>

			<!-- =========== Producto 4 ============ -->

			<li class="col-md-3 col-sm-6 col-xs-12">
				
				<!-- ====================================================================== -->

				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/vistas/img/productos/ropa/ropa06.jpg" class="img-responsive">
					</a>
				</figure>

				<!-- ====================================================================== -->
				
				<h4>
					<small>
						<a href="#" class="pixelProducto">
							Top mujer
							<br>
						</a>
					</small>
				</h4> 

				<!-- ====================================================================== -->

				<div class="col-xs-6 precio">
					<h2>						
						<small>USD $29</small>
					</h2>
				</div>

				<!-- ====================================================================== -->

				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>
				</div>
			</li>
		</ul>

		<!--============================
		= VITRINA DE PRODUCTOS EN LISTA	=
		=============================-->

		<ul class="list1 hidden">
			<!-- =========== Producto 1 ============ -->

			<li class="col-xs-12">
				<!-- ======================================== -->
				
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<figure>
						 <a href="#" class="pixelProducto">
						 	<img src="http://localhost/ecommerce/backend/vistas/img/productos/ropa/ropa03.jpg" class="img-responsive">
						 </a>
					</figure>
				</div>

				<!-- ======================================== -->

				<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
					<h1>
						<small>
							<a href="#" class="pixelProducto">
								Falda floreada

								<span class="label label-warning">Nuevo</span> 								
								<span class="label label-warning">-40%</span>
							</a>
						</small>
					</h1>

					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, laboriosam, aspernatur. Officiis dicta soluta dolorum nesciunt itaque minus quam asperiores sed nemo pariatur blanditiis, repellat iste deserunt, aperiam eum doloribus atque, aliquid. Voluptas.</p>

					<h2>
						<small>
							<strong class="oferta">USD $29</strong>
						</small>	

						<small>$11</small>
					</h2>
					
					<div class="btn-group pull-left enlaces">
						<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>

				</div>

				<div class="col-xs-12">
					<hr>
				</div>
			</li> 			
		</ul>
	</div>
</div>

<!--============================
= BARRA PRODUCTOS POPULARES	=
=============================-->

<div class="container-fluid well well-sm barraProductos">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 organizarProductos">
				<div class="btn-group pull-right">
					<button type="button" class="btn btnGrid backColor" id="btnGrid2">
						<i class="fa fa-th" aria-hidden="true"> </i>

						<span class="col-xs-0 pull-right">GRID</span>
					</button>

					<button type="button" class="btn btnList" id="btnList2">
						<i class="fa fa-list" aria-hidden="true"> </i>

						<span class="col-xs-0 pull-right">LIST</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!--============================
= VITRINA DE PRODUCTOS POPULARES 	=
=============================-->

<div class="container-fluid productos">
	<div class="container">
		<div class="row">
			<!--============================
			=		BARRA TÍTULOS		=
			=============================-->

			<div class="col-xs-12 tituloDestacado">
				<!-- ======================================== -->

				<div class="col-sm-6 col-sm-12">
					<h1><small>ARTÍCULOS POPULARES</small></h1>
				</div>

				<!-- ======================================== -->
				
				<div class="col-sm-6 col-sm-12">
					<a href="articulos-populares">
						<button class="btn btn-default backColor pull-right">
							VER MAS
							<span class="fa fa-chevron-right"></span>
						</button>
					</a>
				</div>

				<!-- ======================================== -->

			</div>
			<div class="clearfix"></div>
			<hr>
		</div>

		<!--========================================
		=  	VITRINA DE PRODUCTOS EN CUADRÍCULA		=
		===========================================-->

		<ul class="grid2">
			<!-- =========== Producto 1 ============ -->

			<li class="col-md-3 col-sm-6 col-xs-12">
				
				<!-- ====================================================================== -->

				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/vistas/img/productos/cursos/curso05.jpg" class="img-responsive">
					</a>
				</figure>

				<!-- ====================================================================== -->
				
				<h4>
					<small>
						<a href="#" class="pixelProducto">
							Curso de Bootstrap

							<span class="label label-warning fontSize">-90%</span>
						</a>
					</small>
				</h4> 

				<!-- ====================================================================== -->

				<div class="col-xs-6 precio">
					<h2>
						<small>
							<strong class="oferta">USD $100</strong>
						</small>

						<small>$10</small>
					</h2>
				</div>

				<!-- ====================================================================== -->

				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<button type="button" class="btn btn-default btn-xs agregarCarro" idProducto="404" imagen="http://localhost/ecommerce/backend/vistas/img/productos/cursos/curso05.jpg" data-toggle="tooltip" title="Agregar al carro de compras" titulo="Curso de Bootstrap" precio="10" tipo="virtual" peso="0">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>
				</div>
			</li>

			<!-- =========== Producto 2 ============ -->

			<li class="col-md-3 col-sm-6 col-xs-12">
				
				<!-- ====================================================================== -->

				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/vistas/img/productos/cursos/curso04.jpg" class="img-responsive">
					</a>
				</figure>

				<!-- ====================================================================== -->
				
				<h4>
					<small>
						<a href="#" class="pixelProducto">
							Curso de Canvas y Javascript

							<span class="label label-warning fontSize">-90%</span>
						</a>
					</small>
				</h4> 

				<!-- ====================================================================== -->

				<div class="col-xs-6 precio">
					<h2>
						<small>
							<strong class="oferta">USD $100</strong>
						</small>

						<small>$10</small>
					</h2>
				</div>

				<!-- ====================================================================== -->

				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<button type="button" class="btn btn-default btn-xs agregarCarro" idProducto="404" imagen="http://localhost/ecommerce/backend/vistas/img/productos/cursos/curso04.jpg" data-toggle="tooltip" title="Agregar al carro de compras" titulo="Curso de Canvas y Javascript" precio="10" tipo="virtual" peso="0">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>
				</div>
			</li>

			<!-- =========== Producto 3 ============ -->

			<li class="col-md-3 col-sm-6 col-xs-12">
				
				<!-- ====================================================================== -->

				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/vistas/img/productos/cursos/curso02.jpg" class="img-responsive">
					</a>
				</figure>

				<!-- ====================================================================== -->
				
				<h4>
					<small>
						<a href="#" class="pixelProducto">
							Javascript desde cero

							<span class="label label-warning fontSize">-90%</span>
						</a>
					</small>
				</h4> 

				<!-- ====================================================================== -->

				<div class="col-xs-6 precio">
					<h2>
						<small>
							<strong class="oferta">USD $100</strong>
						</small>

						<small>$10</small>
					</h2>
				</div>

				<!-- ====================================================================== -->

				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<button type="button" class="btn btn-default btn-xs agregarCarro" idProducto="404" imagen="http://localhost/ecommerce/backend/vistas/img/productos/cursos/curso02.jpg" data-toggle="tooltip" title="Agregar al carro de compras" titulo="Javascript desde cero" precio="10" tipo="virtual" peso="0">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>
				</div>
			</li>

			<!-- =========== Producto 4 ============ -->

			<li class="col-md-3 col-sm-6 col-xs-12">
				
				<!-- ====================================================================== -->

				<figure>
					<a href="#" class="pixelProducto">
						<img src="http://localhost/ecommerce/backend/vistas/img/productos/cursos/curso03.jpg" class="img-responsive">
					</a>
				</figure>

				<!-- ====================================================================== -->
				
				<h4>
					<small>
						<a href="#" class="pixelProducto">
							Curso de Jquery

							<span class="label label-warning fontSize">-90%</span>
						</a>
					</small>
				</h4> 

				<!-- ====================================================================== -->

				<div class="col-xs-6 precio">
					<h2>
						<small>
							<strong class="oferta">USD $100</strong>
						</small>

						<small>$10</small>
					</h2>
				</div>

				<!-- ====================================================================== -->

				<div class="col-xs-6 enlaces">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs deseos" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<button type="button" class="btn btn-default btn-xs agregarCarro" idProducto="404" imagen="http://localhost/ecommerce/backend/vistas/img/productos/cursos/curso03.jpg" data-toggle="tooltip" title="Agregar al carro de compras" titulo="Curso de Jquery" precio="10" tipo="virtual" peso="0">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>
				</div>
			</li>
		</ul>

		<!--============================
		= VITRINA DE PRODUCTOS EN LISTA	=
		=============================-->

		<ul class="list2 hidden">
			<!-- =========== Producto 1 ============ -->

			<li class="col-xs-12">
				<!-- ======================================== -->
				
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<figure>
						 <a href="#" class="pixelProducto">
						 	<img src="http://localhost/ecommerce/backend/vistas/img/productos/cursos/curso05.jpg" class="img-responsive">
						 </a>
					</figure>
				</div>

				<!-- ======================================== -->

				<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
					<h1>
						<small>
							<a href="#" class="pixelProducto">
								Curso de Bootstrap

								<span class="label label-warning">-90%</span>
							</a>
						</small>
					</h1>

					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, laboriosam, aspernatur. Officiis dicta soluta dolorum nesciunt itaque minus quam asperiores sed nemo pariatur blanditiis, repellat iste deserunt, aperiam eum doloribus atque, aliquid. Voluptas.</p>

					<h2>
						<small>
							<strong class="oferta">USD $100</strong>
						</small>	

						<small>$10</small>
					</h2>
					
					<div class="btn-group pull-left enlaces">
						<button type="button" class="btn btn-default btn-xs deseos" idProducto="470" data-toggle="tooltip" title="Agregar a mi lista de deseos">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>

						<button type="button" class="btn btn-default btn-xs agregarCarro" idProducto="404" imagen="http://localhost/ecommerce/backend/vistas/img/productos/cursos/curso05.jpg" data-toggle="tooltip" title="Agregar al carro de compras" titulo="Curso de Bootstrap" precio="10" tipo="virtual" peso="0">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</button>

						<a href="#" class="pixelProducto">
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</button>
						</a>
					</div>

				</div>

				<div class="col-xs-12">
					<hr>
				</div>
			</li>			
		</ul>
	</div>
</div>