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

	/*	function enviarEmail($email, $nombre, $asunto, $cuerpo) {		
		require_once 'PHPMailer/PHPMailerAutoload.php';
		
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tipo de seguridad'; //Modificar
		$mail->Host = 'dominio'; //Modificar
		$mail->Port = puerto; //Modificar
		
		$mail->Username = 'correo emisor'; //Modificar
		$mail->Password = 'password de correo emisor'; //Modificar
		
		$mail->setFrom('correo emisor', 'nombre de correo emisor'); //Modificar
		$mail->addAddress($email, $nombre);
		
		$mail->Subject = $asunto;
		$mail->Body    = $cuerpo;
		$mail->IsHTML(true);
		
		if($mail->send())
			return true;
		else
			return false;
	}*/
}