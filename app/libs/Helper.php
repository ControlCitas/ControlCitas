<?php
/**
 * 
 */
class Helper
{ 
  function __construct(){}

  public static function encriptar($data)
  {
    $llaveEncriptada = base64_decode(LLAVE);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-cbc"));
    $cadena = openssl_encrypt($data, "aes-256-cbc", $llaveEncriptada,0,$iv);
    return base64_encode($cadena."::".$iv);
  }

  public static function desencriptar($data)
  {
    $llaveEncriptada = base64_decode(LLAVE);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-cbc"));
    list($cadena,$iv) = array_pad(explode("::",base64_decode($data),2),2,null);
    return openssl_decrypt($cadena, "aes-256-cbc", $llaveEncriptada,0,$iv);
  }

  public static function cadena($cadena){
    //
    $buscar  = array('^', 'delete', 'drop','truncate','exec','system');
    $reemplazar = array('-', 'dele*te', 'dr*op','truneca*te','ex*ec','syst*em');
    $cadena = trim(str_replace($buscar, $reemplazar, $cadena));
    $cadena = addslashes(htmlentities($cadena));
    return $cadena;
  }

  public static function fecha($cadena=""){
    //ISO AAAA-MM-DD
    $salida = false;
    if ($cadena!="") {
      $fecha_array = explode("-", $cadena);
      $salida = checkdate($fecha_array[1], $fecha_array[2], $fecha_array[0]);
    }
    return $salida;
  }

  public static function numero($cadena){
    $buscar  = array(' ', '$', ',');
    $reemplazar = array('', '', '');
    $numero = str_replace($buscar, $reemplazar, $cadena);
    return $numero;
  }

  public static function calcularEdad($fecha='')
  {
    $edad = 0;
    if(Helper::fecha($fecha)){
      $nacimiento = new DateTime($fecha);
      $ahora = new DateTime(date("Y-m-d"));
      $edad = $ahora->diff($nacimiento);
    }
    return $edad->format("%y");
  }

  public static function horario($hr=""){
     if($hr==""){
      return false;
     }
     $horas = explode(":",$hr);
     if (count($horas)!=2) {
       return false;
     } else if ($horas[0]<"0" || $horas[0]>"24") {
       return false;
     } else if ($horas[1]<"0" || $horas[1]>"60") {
       return false;
     } else {
       return true;
     }
  }

  public static function correo($correo='')
  {
    return filter_var($correo, FILTER_VALIDATE_EMAIL);
  }
}
?>