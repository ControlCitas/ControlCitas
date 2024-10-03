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
		$errores = [];
		if ($_SERVER['REQUEST_METHOD']=="POST") {
			//Recepción de los datos
			$email = $_POST["correo"]??"";
			//Validación
			if ($email=="") {
				array_push($errores,"El correo electrónico es requerido");
			}
			if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
				array_push($errores,"El correo electrónico no es válido");
			}
			//Proceso
			if (empty($errores)) {
				if ($this->modelo->validarCorreo($email)) {
					var_dump("Si se encontró el correo");
					exit(0);
				} else {
					array_push($errores,"El correo electrónico no se encuentra en nuestra base de datos.");
				}
				
			} else {
				$datos = [
				"titulo" => "Olvido de contraseña",
				"subtitulo" => "¿Olvidaste tu contraseña?",
				"errores" => $errores,
				"datos" => []
				];
				$this->vista("loginOlvidoVista",$datos);
			}
		} else {
			$datos = [
			"titulo" => "Olvido de contraseña",
			"subtitulo" => "¿Olvidaste tu contraseña?",
			"errores" => $errores,
			"datos" => []
			];
			$this->vista("loginOlvidoVista",$datos);
		}
	}
}