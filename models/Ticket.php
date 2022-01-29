<?php
    class Ticket extends Conectar{ //Extend en POO se refiere a que esta clase herede o pueda usar las funciones de la clase Conectar en conexion.php

        //Ya se implementó stored procedure
        public function insert_ticket($usu_id,$cat_id,$tick_titulo,$tick_descript){
           $conectar = parent::conexion();
           parent::set_names();
           $sql="call sp_insert_ticket(NULL, ?, ?, ?, ?, 'Abierto',now(),NULL,NULL, '1')";
           $sql=$conectar->prepare($sql);
           $sql->bindValue(1, $usu_id);
           $sql->bindValue(2, $cat_id);
           $sql->bindValue(3, $tick_titulo);
           $sql->bindValue(4, $tick_descript);
           $sql->execute();

           //Probando evitar conflicto de archivos con correos
             //$sql1="select last_insert_id() as 'tick_id';"; 
             $sql1="SELECT MAX(tick_id) as 'tick_id' 
                    FROM tm_ticket";
             $sql1=$conectar->prepare($sql1);
             $sql1->execute();
                
             return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
           //Termina probando evitar conflicto de archivos con correos 
        } 

        public function listar_ticket_x_usu($usu_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="call sp_listar_ticket_x_usu(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(); 
         }

         public function listar_ticket_x_id($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                tm_ticket.tick_id,
                tm_ticket.usu_id,
                tm_ticket.cat_id,
                tm_ticket.tick_titulo,
                tm_ticket.tick_descrip,
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_usuario.usu_correo,
                tm_categoria.cat_nom
                FROM 
                tm_ticket
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                WHERE
                tm_ticket.est = 1
                AND tm_ticket.tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

         public function listar_ticket(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="call sp_listar_ticket()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(); 
         }
         

         public function listar_ticketdetalle_x_ticket($tick_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="call sp_listar_ticketdetalle_x_ticket(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(); 
         }

            //Sección 13_37_1
            public function insert_ticketdetalle($tick_id,$usu_id,$tickd_descrip){
               $conectar= parent::conexion();
               parent::set_names();
               $sql="call sp_insert_ticketdetalle(NULL,?,?,?,now(),'1')";
               $sql=$conectar->prepare($sql);
               $sql->bindValue(1, $tick_id);
               $sql->bindValue(2, $usu_id);
               $sql->bindValue(3, $tickd_descrip);
               $sql->execute();
               return $resultado=$sql->fetchAll();
           }
           //Final Sección 13_37


           public function insert_ticketdetalle_cerrar($tick_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_insert_ticketdetalle_cerrar(NULL,?,?,'Ticket Cerrado...',now(),'1')";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
          
            $sql->execute();
            return $resultado=$sql->fetchAll();
          }

          public function insert_ticketdetalle_reabrir($tick_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="INSERT INTO td_ticketdetalle (tickd_id,tick_id,usu_id,tickd_descrip,fech_crea,est) VALUES (NULL,?,?,'Ticket Reabierto...',now(),'1');";
            $sql="call sp_insert_ticketdetalle_reabrir(NULL,?,?,'Ticket Reabierto...',now(),'1')"; 
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
          
            $sql->execute();
            return $resultado=$sql->fetchAll();
          }


         public function update_ticket($tick_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="call sp_update_ticket(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(); 
         }

         public function reabrir_ticket($tick_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="call sp_reabrir_ticket(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(); 
         }


         public function get_ticket_total(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_get_ticket_total()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function get_ticket_totalabierto(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_get_ticket_totalabierto()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalcerrado(){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where tick_estado='Cerrado'";
            $sql="call sp_get_ticket_totalcerrado()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        //Comienza prueba sustitución de gráfica para el usuario de soporte

        public function get_ticket_totalhardware(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_get_ticket_totalhardware()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 


        public function get_ticket_totalsoftware(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_get_ticket_totalsoftware()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function get_ticket_totalincidencia(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_get_ticket_totalincidencia()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function get_ticket_totalservicio(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_get_ticket_totalservicio()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        //Termina prueba sustitución de gráfica para el usuario de soporte

        public function update_ticket_asignacion($tick_id,$usu_asig){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="call sp_update_ticket_asignacion($tick_id,$usu_asig)"; //Cuando se trata de update se requiere pasar las variables en orden (?,?) no funciona
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_asig);
            $sql->bindValue(2, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(); 
        }

        

    }
?>