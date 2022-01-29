<?php
    class Categoria extends Conectar{ //Extend en POO se refiere a que esta clase herede o pueda usar las funciones de la clase Conectar en conexion.php

        public function get_categoria(){
           $conectar = parent::conexion();
           parent::set_names();
           //$sql="SELECT * FROM tm_categoria WHERE est=1;";
           $sql="call sp_get_categoria()";
           $sql=$conectar->prepare($sql);
           $sql->execute();
           return $resultado=$sql->fetchAll(); 
        }


    }
?>