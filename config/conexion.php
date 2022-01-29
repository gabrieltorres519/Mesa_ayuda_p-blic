<?php
    session_start();

    class Conectar{
        protected $dbh; //tipo de acceso al atributo dbh (dbHost) de la clase

        protected function Conexion(){  //creación de la cadena de conexión
            try{ //Tratar de conectar
                $conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=andercode_helpdesk","root","");

                return $conectar;
            } catch (Exception $e) { //Caso de fallo
                print "¡Error de conexión BD!: " . $e->getMessage() . "<br/>";
                die();
            }
        }


        public function set_names(){ //Para evitar problemas con la escritura 
            return $this->dbh->query("SET NAMES 'utf8'");
        }

        public function ruta(){ // Ruta del sitio retornada por la función
            return "http://localhost:80/PERSONAL_HelpDesk/"; 
        }

    }

?>