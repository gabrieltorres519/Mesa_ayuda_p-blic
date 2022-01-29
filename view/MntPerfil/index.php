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

		<title>Perfil</title>
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
								<h3>Perfil</h3>
								<ol class="breadcrumb breadcrumb-simple">
									<li><a href="#">Home</a></li>
									<li class="active">Cambiar contraseña</li>
								</ol>
							</div>
						</div>
					</div>
					</header>
				</div><!--.container-fluid-->

				<div class="box-typical box-typical-padding">
					<p>
						Desde esta vista podrás cambiar la contraseña de tu usuario
					</p>


					<h5 class="m-t-lg with-border">Ingresar información</h5>

					<div class="row">
						
							<div class="col-lg-6">
								<fieldset class="form-group">
									<label class="form-label semibold" for="exampleInput">Nueva contraseña</label>
									<input type="password" class="form-control" id="txtpass" name="txtpass" >
							
								</fieldset>
							</div>


							<div class="col-lg-6">
								<fieldset class="form-group">
										<label class="form-label semibold" for="exampleInput">Confirmar contraseña</label>
										<input type="password" class="form-control" id="txtpassnew" name="txtpassnew" >
							
								</fieldset>
							</div>
		
							<div class="col-lg-12">
								<button type="button" id="btnactualizar" name="action" class="btn btn-rounded btn-inline btn-primary">Actualizar</button>
							</div>

						
					</div><!--.row-->

				</div>

			</div><!--.page-content-->
			<!--Contenido termina-->

			<?php
				require_once(realpath(dirname(__FILE__) . "/../MainJs/js.php"));
			?>

			<script type="text/javascript" src="/PERSONAL_HelpDesk/view/MntPerfil/mntperfil.js"></script>

		</body>
		</html>
	
		

		<?php
		// Si no se está logueado se redirige al login
			}else{
				header("Location:".Conectar::ruta()."view/index.php");
			}	
	    ?>