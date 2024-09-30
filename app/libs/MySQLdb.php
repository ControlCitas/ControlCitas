<?php

class MySQLdb{


        private $host="localhost";
        private $usuario="root";

        private $clave="";

        private $db="consultorio";

        private $puerto="";
        private $conn;

        function __construct(){

            $this->conn=mysqli_connect($this->host,$this->usuario,$this->clave,$this->db);
            if (mysqli_connect_errno()) {
                print("Error al conectarse a la Base de Datos");
                exit();
            }else{
               // print("Conexion Exitosa");
            }

            if (mysqli_set_charset($this->conn,"utf8")) {
                
              //  print("El conjunto de caracteres es ".mysqli_character_set_name($this->conn)); "<br>";

            }else{

                print("Error en la conversion de caracteres d ela base de datos");
                exit();
            }
        }

}






?>