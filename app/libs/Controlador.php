<?php

class Controlador{

    function __construct(){}

    public function modelo($modelos=''){

        require_once("../app/modelos/".$modelos.".php");
        return new $modelo();
    }

    public function vista($vista='',$datos=[]){
        if (file_exists("../app/vistas/".$vista.".php")) {

                require_once("../app/vistas/".$vista."php");



        } else {
            die("la vista".$vista."no existe");
        }
        
    }   
}




?>