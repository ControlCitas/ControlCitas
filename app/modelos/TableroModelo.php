<?php
/**
 * Tablero Modelo
 */
class TableroModelo
{
	public $db;
		
	function __construct()
	{
		$this->db = new MySQLdb();
	}

	public function setUsuario($id, $nombre, $correo, $clave){
	    $sql = "UPDATE admon SET ";
	    $sql.= "nombre='".$nombre."', ";
	    $sql.= "correo='".$correo."' ";
	    if($clave!=""){
	      $clave = hash_hmac("sha512", $clave, LLAVE);
	      $sql.= ", clave='".$clave."' ";
	    }
	    $sql.= "WHERE id=".$id;
	    return $this->db->queryNoSelect($sql);
	}

	public function getUsuarioId($id){
		$sql = "SELECT * FROM admon WHERE id=".$id." AND baja=0";
		$data = $this->db->query($sql);
		return $data;
	}
}