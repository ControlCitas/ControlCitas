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
	public function cambiarclave($id='')
	{
		$errores = [];
		if ($_SERVER['REQUEST_METHOD']=="POST") {
			$id = isset($_POST["id"])?$_POST["id"]:"";
			$clave1 = isset($_POST["clave"])?$_POST["clave"]:"";
			$clave2 = isset($_POST["verifica"])?$_POST["verifica"]:"";
			//validaciones
			if ($clave1=="") {
				array_push($errores, "La clave de acceso es requerida");
			}
			if ($clave2=="") {
				array_push($errores, "La clave de acceso de verificación es requerida");
			}
			if ($clave1!=$clave2) {
				array_push($errores, "Las claves de acceso no coinciden");
			}
			if (count($errores)) {
				//si hay errores
				$datos = [
				"titulo" => "Cambia clave de acceso",
				"subtitulo" => "Cambia clave de acceso",
				"menu" => false,
				"errores" => $errores,
				"data" => $id
				];
				$this->vista("loginCambiaVista",$datos);
			} else {
				//No hay errores
				if ($this->modelo->cambiarClaveAcceso($id, $clave1)) {
					$datos = [
					"titulo" => "Modificar clave de acceso",
					"menu" => false,
					"errores" => [],
					"data" => $id,
					"subtitulo" => "Modificar clave de acceso",
					"texto" => "La modificación de la clave de acceso fue exitosa. Bienvenido nuevamente.",
					"color" => "alert-success",
					"url" => "login",
					"colorBoton" => "btn-success",
					"textoBoton" => "Regresar"
					];
					$this->vista("mensajeVista",$datos);
				} else {
					$datos = [
					"titulo" => "Error al modificar la clave de acceso",
					"menu" => false,
					"errores" => [],
					"data" => [],
					"subtitulo" => "Error al modificar la clave de acceso",
					"texto" => "Existió un error al modificar la clave de acceso.",
					"color" => "alert-danger",
					"url" => "login",
					"colorBoton" => "btn-danger",
					"textoBoton" => "Regresar"
					];
					$this->vista("mensajeVista",$datos);
				}
			}
		} else {
			$datos = [
			"titulo" => "Cambio de contraseña",
			"subtitulo" => "Cambio de contraseña",
			"errores" => $errores,
			"data" => $id
			];
			$this->vista("loginCambiaVista",$datos);
		}
	}
}

