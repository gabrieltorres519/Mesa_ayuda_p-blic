<?php
    //require_once("config/conexion.php");
    require_once(realpath(dirname(__FILE__) . '/../config/conexion.php'));
    if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
        //require_once("models/Usuario.php");
        require_once(realpath(dirname(__FILE__) . '/../models/Usuario.php'));
        $usuario = new Usuario();
        $usuario->login();
    }
?>




<!DOCTYPE html>
<html>
<head lang="es">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Acceso</title>

	<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="img/favicon.png" rel="icon" type="image/png">
	<link href="img/favicon.ico" rel="shortcut icon">


    <link rel="stylesheet" href="/PERSONAL_HelpDesk/public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="/PERSONAL_HelpDesk/public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="/PERSONAL_HelpDesk/public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/PERSONAL_HelpDesk/public/css/main.css">
</head>
<body>

    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">

  

                <form class="sign-box" action="" method="post" id="login_form">
                    <input type="hidden" id="rol_id" name="rol_id" value="1">
                    <div class="sign-avatar">
                        <img src="/PERSONAL_HelpDesk/public/1.jpg" alt="" id="imgtipo">
                    </div>
                    <header class="sign-title" id="lbltitulo">Acceso Usuario</header>

                    <?php
                        if(isset($_GET["m"])){
                            switch($_GET["m"]){
                                // Usuario.php nos provee nos datos pasa los cases dependiendo el número de error resultante en las funciones header()
                                case "1";
                                
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-ios-checkmarck alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                                            <span>El usuario y/o contraseña son incorrectos</span>
                                        </div>
                                    </div>
                                <?php

                                break;



                                case "2";

                                    ?>
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-ios-checkmarck alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                                            <span>Los campos están vacíos</span>
                                        </div>
                                    </div>
                                    <?php

                                break;
                            }
                        }
                    ?>


                    <div class="form-group">
                        <input type="text" id="usu_correo" name="usu_correo" class="form-control" placeholder="E-Mail">
                    </div>
                    <div class="form-group">
                        <input type="password" id="usu_pass" name="usu_pass" class="form-control" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <!-- <div class="float-right reset">
                            <a href="reset-password.html">Cambiar contraseña</a>
                        </div> -->
                        <div class="float-left reset">
                            <a href="#" id="btnsoporte">Acceso soporte</a>
                        </div>
                    </div>

                    <input type="hidden" name="enviar" class="form_control" value="si"> <!--hidden para ocultar esta clase de control-->
                    <button type="submit" class="btn btn-rounded">Acceder</button>
                    <!-- <p class="sign-note">New to our website? <a href="sign-up.html">Sign up</a></p> -->
                  
                </form>
            </div>
        </div>
    </div>


<script src="/PERSONAL_HelpDesk/public/js/lib/jquery/jquery.min.js"></script>
<script src="/PERSONAL_HelpDesk/public/js/lib/tether/tether.min.js"></script>
<script src="/PERSONAL_HelpDesk/public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="/PERSONAL_HelpDesk/public/js/plugins.js"></script>
    <script type="text/javascript" src="/PERSONAL_HelpDesk/public/js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>
<script src="/PERSONAL_HelpDesk/public/js/app.js"></script>

<script type="text/javascript" src="/PERSONAL_HelpDesk/view/index.js"></script>

</body>
</html>