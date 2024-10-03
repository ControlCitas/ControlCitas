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

	public function validarCorreo($email)
	{
		$sql ="SELECT * FROM admon WHERE correo='".$email."'";
		$data = $this->db->query($sql);
		return (count($data)==0)?false:true;
	}
}