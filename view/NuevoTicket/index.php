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

		<title>Nuevo Ticket</title>
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
									<h3>Nuevo Ticket</h3>
									<ol class="breadcrumb breadcrumb-simple">
										<li><a href="#">Home</a></li>
										<li class="active">Nuevo Ticket</li>
									</ol>
								</div>
							</div>
						</div>
						</header>
					</div><!--.container-fluid-->

					<div class="box-typical box-typical-padding">
						<p>
							Desde esta vista podrás generar nuevos tickets de HelpDesk
						</p>


						<h5 class="m-t-lg with-border">Ingresar información</h5>

						<div class="row">
							<form method="post" id="ticket_form">

								<input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"]?>">


								<div class="col-lg-6">
									<fieldset class="form-group">
										<label class="form-label semibold" for="tick_titulo">Título</label>
										<input type="text" class="form-control" id="tick_titulo" name="tick_titulo" placeholder="Ingrese Título">
									</fieldset>
								</div>

								<div class="col-lg-6">
									<fieldset class="form-group">
										<label class="form-label semibold" for="exampleInput">Categoría</label>
										<select id="cat_id" name="cat_id"  class="form-control"> <!--Id controlado desde nuevoticket.js-->
											
										</select>
									</fieldset>
								</div>


								<div class="col-lg-6">
									<fieldset class="form-group">
											<label class="form-label semibold" for="exampleInput">Documentos adicionales</label>
											<input type="file" name="fileElem" id="fileElem" class="form-control" multiple>

									</fieldset>
								</div>
								



								<div class="col-lg-12">
									<fieldset class="form-group">
										<label class="form-label semibold" for="tick_descrip" >Descripción</label>
										<div class="summernote-theme-1">
											<textarea  id="tick_descrip" name="tick_descrip"  class="summernote" name="name"></textarea>
										</div>
									</fieldset>
								</div>
			
								<div class="col-lg-12">
									<button type="submit"  name="action"  value="add" class="btn btn-rounded btn-inline btn-primary">Guardar</button>
									<!-- <input type="button" onclick="sendEmail()" name="action"  value="email" class="btn btn-rounded btn-inline btn-primary"> -->
							
								</div> 
								<!-- Se agregó onclick para enviar el correo y se cambió type submit por button-->

							</form>	
						</div><!--.row-->

				</div>

			</div><!--.page-content-->
			<!--Contenido termina-->





			<?php
				require_once(realpath(dirname(__FILE__) . "/../MainJs/js.php"));
			?>

			<script type="text/javascript" src="/PERSONAL_HelpDesk/view/NuevoTicket/nuevoticket.js"></script>

		</body>
		</html>
	
		

		<?php
		// Si no se está logueado se redirige al login
			}else{
				header("Location:".Conectar::ruta()."view/index.php");
			}	
	    ?>