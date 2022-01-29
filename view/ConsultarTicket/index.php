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

		<title>Consultar Ticket</title>
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

				<header class="section-header">
					<div class="tbl">
						<div class="tbl-row">
							<div class="tbl-cell">
								<h3>Consultar Ticket</h3>
								<ol class="breadcrumb breadcrumb-simple">
									<li><a href="#">Home</a></li>
									<li class="active">Consultar Ticket</li>
								</ol>
							</div>
						</div>
					</div>
				</header>
		

				<div class="box-typical box-typical-padding">
					<table id="ticket_data" class="table table-bordered table-striped table-vcenter js-datatable-full">
						<thead>
							<tr>
								<th style="width: 5%;">Nro.Ticket</th>
								<th style="width: 15%;">Categoria</th>
								<th class="d-none d-sm-table-cell" style="width: 40%;">Titulo</th>
								<th class="d-none d-sm-table-cell" style="width: 5%;">Estado</th>
								<th class="d-none d-sm-table-cell" style="width: 10%;">Fecha creación</th>
								<th class="d-none d-sm-table-cell" style="width: 10%;">Fecha asignación</th>
								<th class="d-none d-sm-table-cell" style="width: 10%;">Soporte</th>
								<th class="text-center" style="width: 5%;"></th>
							</tr>
						</thead>
					</table>
				</div>

				</div><!--.container-fluid-->
			</div><!--.page-content-->
			<!--Contenido termina-->


			<?php
				require_once(realpath(dirname(__FILE__) . "/../ConsultarTicket/modalasignar.php"));
			?>


			<?php
				require_once(realpath(dirname(__FILE__) . "/../MainJs/js.php"));
			?>

			<script type="text/javascript" src="/PERSONAL_HelpDesk/view/ConsultarTicket/consultarticket.js"></script>

		</body>
		</html>
	
		

		<?php
		// Si no se está logueado se redirige al login
			}else{
				header("Location:".Conectar::ruta()."view/index.php");
			}	
	    ?>