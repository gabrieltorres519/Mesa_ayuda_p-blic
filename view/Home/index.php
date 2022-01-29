  <?php //Este condicional envuelve a todo el index, con esto si se está loggeado podrá accederse en el navegador
		//usando simplemente la ruta a home, sino redirigirá al login 
		require_once(realpath(dirname(__FILE__) . '/../../config/conexion.php'));
		if(isset($_SESSION["usu_id"])){	
?>	

		<!DOCTYPE html>
		<html>


			<?php // Dado que el código se separó en módulos aquí se llama al archivo php con el header
				require_once(realpath(dirname(__FILE__) . '/../MainHead/mainhead.php'));
			?>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
		<!-- <link rel="stylesheet" href="/PERSONAL_HelpDesk/grafico/graficocss/morris.css"> -->
		<title>Home</title>
		</head> <!--Se deja la etiqueta de cierre para que habra desde el require y cierre aquí-->
		<body class="with-side-menu">

			<?php // Dado que el código se separó en módulos aquí se llama al archivo php con el header
				require_once(realpath(dirname(__FILE__) . '/../MainHeader/header.php'));
			?>

			<div class="mobile-menu-left-overlay"></div>

			<?php
				require_once(realpath(dirname(__FILE__) . "/../MainNav/nav.php"));
			?>

			<!--Contenido inicia-->
			<div class="page-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-12">
							<div class="row">

								<div class="col-sm-4">
									<article class="statistic-box yellow">
										<div>
											<div class="number" id="lbltotal"></div>
											<div class="caption"><div>Total de Tickets</div></div>
										</div>
									</article>
								</div>

								<div class="col-sm-4">
									<article class="statistic-box green">
										<div>
											<div class="number" id="lbltotalabierto"></div>
											<div class="caption"><div>Total de Tickets Abiertos</div></div>
										</div>
									</article>
								</div>

								<div class="col-sm-4"> 
									<article class="statistic-box red">
										<div>
											<div class="number" id="lbltotalcerrado"></div>
											<div class="caption"><div>Total de Tickets Cerrados</div></div>
										</div>
									</article>
								</div>



							</div>
						</div>
					</div>
				</div><!--.container-fluid-->
			</div><!--.page-content-->
			<!--Contenido termina-->


			<div class="page-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-12">
							<div class="row">

									<!--probando sustitución de gráfico de barras-->

									<div class="col-sm-3">
									<article class="statistic-box purple">
										<div>
											<div class="number" id="lbltotalhardware"></div>
											<div class="caption"><div>Tickets Hardware</div></div>
										</div>
									</article>
								</div>

								<div class="col-sm-3">
									<article class="statistic-box yellow">
										<div>
											<div class="number" id="lbltotalsoftware"></div>
											<div class="caption"><div>Tickets Software</div></div>
										</div>
									</article>
								</div>

								<div class="col-sm-3"> 
									<article class="statistic-box red">
										<div>
											<div class="number" id="lbltotalincidencia"></div>
											<div class="caption"><div>Tickets Incidencia</div></div>
										</div>
									</article>
								</div>

								<div class="col-sm-3"> 
									<article class="statistic-box green">
										<div>
											<div class="number" id="lbltotalservicio"></div>
											<div class="caption"><div>Tickets Petición de Servicio</div></div>
										</div>
									</article>
								</div>

								<!--probando sustitución de gráfico de barras-->

							</div>
						</div>
					</div>
				</div><!--.container-fluid-->
			</div><!--.page-content-->
			<!--Contenido termina-->


			<?php
				require_once(realpath(dirname(__FILE__) . "/../MainJs/js.php"));
			?>
			 <!-- <script src="/PERSONAL_HelpDesk/grafico/graficojs/raphael-min.js"></script>
			 <script src="/PERSONAL_HelpDesk/grafico/graficojs/morris.min.js"></script> -->

			 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	         <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

			<script type="text/javascript" src="/PERSONAL_HelpDesk/view/Home/home.js"></script>
			

		</body>
		</html>
	
		

		<?php
		// Si no se está logueado se redirige al login
			}else{
				header("Location:".Conectar::ruta()."view/index.php");
			}	
	    ?>