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
}
?>