<?php
/**
 * Login Modelo
 */
class LoginModelo
{
	public $db;
		
	function __construct()
	{
		$this->db = new MySQLdb();
	}

	public function cambiarClaveAcceso($id, $clave){
	    $r = false;
	    $clave = hash_hmac("sha512", $clave, CLAVE);
	    $sql = "UPDATE admon SET ";
	    $sql.= "clave='".$clave."' ";
	    $sql.= "WHERE id=".$id;
	    $r = $this->db->queryNoSelect($sql);
	    return $r;
	}

	public function enviarCorreo($email='')
	{
		$data = [];
		if ($email=="") {
			return false;
		} else {
			$data = $this->getUsuarioCorreo($email);
			if (empty($data)) {
				$id = $data["id"];
				$nombre = $data["nombre"];
				//
				$msg = $nombre. ", entra a la siguiente liga para cambiar tu clave de acceso al consultorio...<br>";
				$msg.= "<a href='".RUTA."login/cambiarclave/".$id."'>Cambiar tu clave de acceso</a>";

				$headers = "MIME-Version: 1.0\r\n"; 
				$headers.= "Content-type:text/html; charset=UTF-8\r\n"; 
				$headers.= "From: Consultorio\r\n"; 
				$headers.= "Reply-to: ayuda@consultorio.com\r\n";

				$asunto = "Cambiar clave de acceso";
				return @mail($email,$asunto,$msg, $headers);
			} else {
				return false;
			}
		}
	}

	public function getUsuarioCorreo($email='')
	{
		$sql = "SELECT * FROM admon WHERE correo='".$email."' and baja=0";
		$data = $this->db->query($sql);
		return $data;
	}

	public function validarCorreo($email)
	{
		$sql ="SELECT * FROM admon WHERE correo='".$email."'";
		$data = $this->db->query($sql);
		return (count($data)==0)?false:true;
	}

	public function verificar($usuario, $clave){
	    $errores = array();
	    $sql = "SELECT * FROM admon WHERE correo='".$usuario."'";
	    $clave = hash_hmac("sha512", $clave, CLAVE);
	    $clave = substr($clave,0,200);
	    //consulta
	    $data = $this->db->query($sql);
	    //validacion
	    if (empty($data)) {
	      array_push($errores,"No existe ese usuario, favor de verificarlo.");
	    } else if($clave!=$data["clave"]){
	      array_push($errores,"Clave de acceso erronea, favor de verificar.");
	    }
	    return $errores;
	}
}