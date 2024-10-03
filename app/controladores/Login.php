<?php  
/**
 * Controlador login
 */
class Login extends Controlador
{
	private $modelo;
	
	function __construct()
	{
		$this->modelo = $this->modelo("LoginModelo");
	}

	public function caratula()
	{
		$datos = [
			"titulo" => "Entrada",
			"subtitulo" => "Entrada al sistema"
		];
		$this->vista("loginVista",$datos);
	}

	public function olvido()
	{
		$datos = [
			"titulo" => "Olvido de contraseña",
			"subtitulo" => "¿Olvidaste tu contraseña?",
			"datos" => []
		];
		$this->vista("loginOlvidoVista",$datos);
	}
}


