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

		<title>Detalle Ticket</title>
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
									<h3 id="lblnomidticket">Detalle Ticket</h3>
									<div id="lblestado"></div>
									<span class="label label-pill label-primary" id="lblnomusuario"></span>
									<span class="label label-pill label-default" id="lblfechcrea">99/99/9999</span>
									<ol class="breadcrumb breadcrumb-simple">
									<li><a href="#">Home</a></li>
									<li class="active">Detalle Ticket</li>
									</ol>
								</div>
							</div>
						</div>
					</header>


					<div class="box-typical box-typical-padding">
						<div class="row" >
									
								<div class="col-lg-6">
											<fieldset class="form-group">
												<label class="form-label semibold" for="exampleInput">Categoría</label>
												<input type="text" class="form-control" id="cat_nom" name="cat_nom" readonly> <!--Id controlado desde nuevoticket.js-->
										
									</fieldset>
								</div>

								<div class="col-lg-6">
									<fieldset class="form-group">
										<label class="form-label semibold" for="tick_titulo">Título</label>
										<input type="text" class="form-control" id="tick_titulo" name="tick_titulo" readonly>
									</fieldset>
								</div>

								<div class="col-lg-12">
									<fieldset class="form-group">
										<label class="form-label semibold" for="tick_titulo">Documentos Adicionales</label>
										<table id="documentos_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
											<thead>
												<tr>
													<th style="width: 90%;">Nombre</th>
													<th class="text-center" style="width: 10%;"></th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>
									</fieldset>
								</div>

								<div class="col-lg-12">
									<fieldset class="form-group">
									<label class="form-label semibold" for="tickd_descripusu">Descripción</label>
									<div class="summernote-theme-1">
										<textarea id="tickd_descripusu" name="tickd_descripusu" class="summernote" name="name"></textarea>
									</div>

									</fieldset>
								</div>
								


						</div>
					</div>



					<section class="activity-line" id="lbldetalle">

					
						
					</section><!--.activity-line-->


					<div class="box-typical box-typical-padding" id="pnldetalle"> <!--Se usó el id para controlar la aparición del panel después de que se cierra un ticket, para ya no mostrarlo-->


						<p>Ingrese su duda o consulta</p>

						<div class="row">

								<div class="col-lg-12">
									<fieldset class="form-group">
										<label class="form-label semibold" for="tickd_descrip">Descripción</label>
										<div class="summernote-theme-1">
											<textarea  id="tickd_descrip" name="tickd_descrip"  class="summernote" name="name"></textarea> <!--No se dejó ningún espacio pues nunca lo detectaría como vacío-->
										</div>
									</fieldset>
								</div>
								<!-- //Sección 13_37_3 -->
								<div class="col-lg-12"> 
									<button type="button" id="btnenviar" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
									<button type="button"  id="btncerrarticket" class="btn btn-rounded btn-inline btn-warning">Cerrar Ticket</button>
								</div>
								<!-- //Final Sección 13_37_3 -->
						</div><!--.row-->

					</div>


				</div><!--.container-fluid-->
			</div><!--.page-content-->
			<!--Contenido termina-->

			<?php
				require_once(realpath(dirname(__FILE__) . "/../MainJs/js.php"));
			?>

			<script type="text/javascript" src="/PERSONAL_HelpDesk/view/DetalleTicket/detalleticket.js"></script>

		</body>
		</html>
	
		

		<?php
		// Si no se está logueado se redirige al login
			}else{
				header("Location:".Conectar::ruta()."view/index.php");
			}	
	    ?>