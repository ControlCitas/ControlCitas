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
            //var_dump($url);

        }
        //Cargamos a la clase controladora

        require_once("../app/controladores/".ucwords($this->controlador).".php");

        //Creamos la instancia

        $this->controlador=new $this->controlador;

        //Metodo
        if (isset($url[1])) {
            if (method_exists($this->controlador, $url[1])) {
                $this->metodo=$url[1];
                unset($url[1]);
            }
        }

   //Parametros
   $this->parametros= $url?array_values($url):[];
   call_user_func_array([$this->controlador,$this->metodo],$this->parametros);
 
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

