<?php
	if($_SESSION["rol_id"] == 1){
?>
		<nav class="side-menu">
		<ul class="side-menu-list">


			<li class="blue-dirty">
				<a href="/PERSONAL_HelpDesk/view/Home/">
					<span class="glyphicon glyphicon-th"></span>
					<span class="lbl">Inicio</span>
				</a>
			</li>


			<li class="blue-dirty">
				<a href="/PERSONAL_HelpDesk/view/NuevoTicket/">
					<span class="glyphicon glyphicon-th"></span>
					<span class="lbl">Nuevo Ticket</span>
				</a>
			</li>


			<li class="blue-dirty">
				<a href="/PERSONAL_HelpDesk/view/ConsultarTicket/">
					<span class="glyphicon glyphicon-th"></span>
					<span class="lbl">Consultar Ticket</span>
				</a>
			</li>

		</ul>

		</nav><!--.side-menu-->

<?php
	}else{
		?>

			<nav class="side-menu">
					<ul class="side-menu-list">


						<li class="blue-dirty">
							<a href="/PERSONAL_HelpDesk/view/Home/">
								<span class="glyphicon glyphicon-th"></span>
								<span class="lbl">Inicio</span>
							</a>
						</li>


						<li class="blue-dirty">
							<a href="/PERSONAL_HelpDesk/view/MntUsuario/">
								<span class="glyphicon glyphicon-th"></span>
								<span class="lbl">Mantenimiento Usuario</span>
							</a>
						</li>


						<li class="blue-dirty">
							<a href="/PERSONAL_HelpDesk/view/ConsultarTicket/">
								<span class="glyphicon glyphicon-th"></span>
								<span class="lbl">Consultar Ticket</span>
							</a>
						</li>

					</ul>

			</nav><!--.side-menu-->


        <?php
	}
?>

