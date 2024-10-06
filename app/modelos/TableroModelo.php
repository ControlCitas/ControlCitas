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
}