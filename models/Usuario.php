<?php
    class Usuario extends Conectar{ //Extend en POO se refiere a que esta clase herede o pueda usar las funciones de la clase Conectar en conexion.php

        public function login(){
            $conectar = parent::conexion(); //Función conexion de la clase Conectar 
            parent::set_names(); 
            if(isset($_POST["enviar"])){ // si al enviarse datos con post se encuentra que se envió la cadena "enviar" hacer esto.
                $correo = $_POST["usu_correo"]; // al presionarse enviar, entonces se enviarán los datos ingresados en estos campos
                $pass = $_POST["usu_pass"];
                $rol = $_POST["rol_id"];
                if(empty($correo) and empty($pass)){
                    header("Location:".conectar::ruta()."view/index.php?m=2"); // si los campos estan vacios nos redirige a la ruta del index con un mensaje = 2
                    exit();
                }else{ // En caso de que sí halla información dentro de los campos se inicia el proceso de Login
                    //$sql = "SELECT * FROM tm_usuario WHERE usu_correo =? AND usu_pass = MD5(?) AND rol_id = ? AND est = 1"; // consultando datos de la tabla delimitando por el usuario ingresado y si está activo
                    $sql="call sp_login('$correo','$pass',$rol)"; //Cuando se pasa una variable string va entre comillas '$var'
                    $stmt=$conectar->prepare($sql);
                    $stmt->bindValue(1,$correo);
                    $stmt->bindValue(2,$pass);
                    $stmt->bindValue(3,$rol);
                    $stmt->execute(); // Se ejecuta el gestor

                    $resultado = $stmt->fetch(); // Se guarda lo que se ha ejecutado en la variable resultado
                                                 // si se ejecutó correctamente, la info. recuperada se guardará en resultado
                    
                    if(is_array($resultado) and count($resultado)>0){ // si los datos devueltos son cadenas de caracteres 
                        $_SESSION["usu_id"]=$resultado["usu_id"]; // Variables de sesión (asegurarse de que se llamen igual que en home, donde validaremos la sesión)
                        $_SESSION["usu_nom"]=$resultado["usu_nom"];
                        $_SESSION["usu_ape"]=$resultado["usu_ape"];
                        $_SESSION["rol_id"]=$resultado["rol_id"];
                        header("Location:".conectar::ruta()."view/Home/");  // Enviar a Home del usuario si el proceso fue exitoso
                        exit();
                    }else{ // si no se decolvió nada
                        header("Location:".conectar::ruta()."view/index.php?m=1"); // si los campos eson incorrectos nos redirige a la ruta del index con un mensaje = 1
                        exit();
                    }
                }
            }

        }

        public function insert_usuario($usu_nom, $usu_ape, $usu_correo, $usu_pass, $rol_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="call sp_insert_usuario(NULL, '$usu_nom', '$usu_ape', '$usu_correo', '$usu_pass', $rol_id, now(), NULL, NULL, '1'); ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_ape);
            $sql->bindValue(3, $usu_correo);
            $sql->bindValue(4, $usu_pass);
            $sql->bindValue(5, $rol_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(); 
        }

        public function update_usuario($usu_id,$usu_nom,$usu_ape,$usu_correo,$usu_pass,$rol_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_update_usuario($usu_id,'$usu_nom','$usu_ape','$usu_correo','$usu_pass',$rol_id)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_ape);
            $sql->bindValue(3, $usu_correo);
            $sql->bindValue(4, $usu_pass);
            $sql->bindValue(5, $rol_id);
            $sql->bindValue(6, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_delete_usuario(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_get_usuario()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function get_usuario_x_rol(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_get_usuario_x_rol()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function get_usuario_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_get_usuario_x_id (?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        public function get_usuario_total_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_get_usuario_total_x_id(?)"; 
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function get_usuario_totalabierto_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where usu_id = ? and tick_estado='Abierto'";
            $sql="call sp_get_usu_totalabierto_x_id(?)"; 
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_totalcerrado_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where usu_id = ? and tick_estado='Cerrado'";
            $sql="call sp_get_usu_totalcerrado_x_id (?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        //Comienza prueba de sustitución de gráfica del usuario común

        public function get_usuario_totalhardware_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_get_usu_totalhardware_x_id(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_totalsoftware_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_get_usu_totalsoftware_x_id(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_totalincidencia_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where usu_id = ? and cat_id=3";
            $sql="call sp_get_usu_totalincidencia_x_id(?)";  
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_totalservicio_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where usu_id = ? and cat_id=4";
            $sql="call sp_get_usu_totalservicio_x_id(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        


        //Termina prueba de sustitución de gráfica del usuario común


        public function update_usuario_pass($usu_id,$usu_pass){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_update_usuario_pass ($usu_id,'$usu_pass')";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_pass);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>