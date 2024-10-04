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
					if (!$this->modelo->enviarCorreo($email)) {
						$datos = [
						"titulo" => "Cambio de clave de acceso",
						"menu" => false,
						"errores" => [],
						"data" => [],
						"subtitulo" => "Cambio de clave de acceso",
						"texto" => "Se ha enviado un correo a <b>".$email."</b> para que puedas cambiar tu clave de acceso. Cualquier duda te puedes comunicar con nosotros. No olvides revisar tu bandeja de spam.",
						"color" => "alert-success",
						"url" => "login",
						"colorBoton" => "btn-success",
						"textoBoton" => "Regresar"
						];
						$this->vista("mensajeVista",$datos);
					} else {
						array_push($errores,"El correo electrónico no fue enviado correctamente.");
					}
				} else {
					array_push($errores,"El correo electrónico no se encuentra en nuestra base de datos.");
				}
			}
			if (!empty($errores)) {
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

