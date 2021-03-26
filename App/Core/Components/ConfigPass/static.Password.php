<?php
class Password{
	/**
	 * Para convertir hora del archivo excel
	 *
	 * @param Cadena $contraseña

	 */

	function encriptar($texto){
    $key='lp12';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
    return $encrypted;
	}
	
	function desencriptar($texto){
	    $key='lp12';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
	    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	    return $decrypted;
	}

}
?>
