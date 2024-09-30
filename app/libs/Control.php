<?php
/*
primer parametro : Controlador
segundo parametro:el metodo

*/

class Control {

    function __construct()
	{
		$url = $this->separarURL();
		var_dump($url);
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