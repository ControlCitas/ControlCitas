<?php
/*
primer parametro : Controlador
segundo parametro:el metodo

*/

class Control {

    private $controlador="Login";
    private $metodo="caratula";
    private $parametros=[];


    function __construct()
	{
		$url = $this->separarURL();
        if ($url!="" && file_exists("../app/controladores/".ucwords($url[0]).".php")) {

            $this->controlador=ucwords($url[0]);
            unset($url[0]);
            var_dump($url);

        }
        //Cargamos a la clase controladora

        require_once("../app/controladores/".ucwords($this->controlador).".php");

        //Creamos la instancia

        $this->controlador=new $this->controlador;
	}

	public function separarURL()
	{
		$url = "";
		if (isset($_GET['url'])) {
			// eliminamos el caracter final
			$url = rtrim($_GET['url'],"/");
			$url = rtrim($_GET['url'],"\\");
			//Sanitizamos
			$url = filter_var($url, FILTER_SANITIZE_URL);
			//
			$url = explode("/",$url);
		}
		return $url;
	}


}


?>