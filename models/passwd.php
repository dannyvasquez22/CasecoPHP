<?php

class Password {
	function encriptar($texto){
	    $key='a';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
	    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $texto, MCRYPT_MODE_CBC, md5(md5($key))));
	    
	    return $encrypted;
	}

	function desencriptar($texto){
	    $key='a';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
	    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($texto), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	    
	    return $decrypted;
	}
}