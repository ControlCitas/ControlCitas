<?php
/**
 * Controlador Login
 */
class Tablero extends Controlador{
  private $modelo;

  function __construct()
  {
    $this->modelo = $this->modelo("TableroModelo");
  }

  function caratula(){
    $sesion = new Sesion();
    if ($sesion->getLogin()) {
      //
      $datos = [
        "titulo" => "Bienvenid@ a nuestro consultorio",
        "subtitulo" => "Bienvenid@ a nuestro consultorio",
        "menu" => true
      ];
      $this->vista("tableroCaratulaVista",$datos);
    } else {
      header("location:".RUTA);
    }
  }

  public function logout(){
    session_start();
    if (isset($_SESSION["usuario"])) {
      $sesion = new Sesion();
      $sesion->finalizarLogin();
    }
    header("location:".RUTA);
  }

    public function perfil(){
    $errores = [];
    if ($_SERVER['REQUEST_METHOD']=="POST") {
      
    } 
    //Leemos los datos del registro del id
    session_start();
    if (isset($_SESSION["usuario"])) {
      $data = $_SESSION["usuario"];
    } else {
      header("location:".RUTA);
    }
    //Vista Alta
    $datos = [
      "titulo" => "Perfil del usuario",
      "subtitulo" => "Perfil del usuario",
      "menu" => true,
      "activo" => 'perfil',
      "errores" => $errores,
      "data" => $data
    ];
    $this->vista("tableroPerfilVista",$datos);
  }

}
?>