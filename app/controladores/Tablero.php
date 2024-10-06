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
      //
      $id = $_POST['id'] ?? "";
      $nombre = $_POST['nombre'] ?? "";
      $correo = $_POST['correo'] ?? "";
      $clave = $_POST['clave'] ?? "";
      $clave1 = $_POST['nuevaClave'] ?? "";
      $clave2 = $_POST['confirmacion'] ?? "";

      if($id==""){
        array_push($errores,"Error en el identificador del usuario");
      }

      if($nombre==""){
        array_push($errores,"El nombre es un valor requerido");
      }

      if($correo==""){
        array_push($errores,"El correo electrónico es requerido");
      }

      if($clave=="xxxxxxxxxxxx"){
        $clave1 = $clave2 = "";
      } else {
        if($this->modelo->verificar($id,$clave)){
          if ($clave1=="") {
            array_push($errores, "La nueva clave de acceso es requerida");
          }
          if ($clave2=="") {
            array_push($errores, "La clave de acceso de verificación es requerida");
          }
          if ($clave1!=$clave2) {
            array_push($errores, "Las nuevas claves de acceso no coinciden");
          }
        } else {       
          array_push($errores, "Algún dato es erróneo, favor de verificar.");
        } 
      }
      if (empty($errores)) {
        //Iniciamos sesión
        if($this->modelo->setUsuario($id, $nombre, $correo, $clave1)){
          $sesion = new Sesion();
          $data = $this->modelo->getUsuarioId($id);
          $sesion->iniciarLogin($data);
          //
          header("location:".RUTA."tablero");
        } else {
          print "Error al actualizar los datos";
          exit(0);
        }
      }      
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