<?php
	
	function isNull($user, $pass) {
		if(strlen(trim($user)) < 1 || strlen(trim($pass)) < 1) {
			return true;
		} else {
			return false;
		}		
	}
	
	/*function isEmail($email) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		} else {
			return false;
		}
	}*/
	
	function validaPassword($var1, $var2) {
		if (strcmp($var1, $var2) !== 0){
			return false;
		} else {
			return true;
		}
	}
	
	function minMax($min, $max, $valor) {
		if(strlen(trim($valor)) < $min) {
			return true;
		} else {
		 	if(strlen(trim($valor)) > $max) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	function usuarioExiste($usuario) {
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT usu_contraseña, carg_nombre FROM usuario INNER JOIN detalle_cargo ON" +
            " usuario.detcarg_codigo = detalle_cargo.detcarg_codigo WHERE usu_cuenta = ? AND usu_estado = 1 LIMIT 1");
		$stmt->bind_param("s", $usuario);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	/*function emailExiste($email) {
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE correo = ? LIMIT 1");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
		} else {
			return false;	
		}
	}*/
	
	function generateToken() {
		$gen = md5(uniqid(mt_rand(), false));	
		return $gen;
	}
	
	function hashPassword($password) {
		$hash = password_hash($password, PASSWORD_DEFAULT);
		return $hash;
	}
	
	function resultBlock($errors) {
		if(count($errors) > 0) {
			echo "<div id='error' class='alert alert-danger' role='alert'>
			<a href='#' onclick=\"showHide('error');\">[X]</a>
			<ul>";
			foreach($errors as $error) {
				echo "<li>".$error."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}
	
/*	function registraUsuario($usuario, $pass_hash, $nombre, $email, $activo, $token, $tipo_usuario) {		
		global $mysqli;
		
		$stmt = $mysqli->prepare("INSERT INTO usuarios (usuario, password, nombre, correo, activacion, token, id_tipo) VALUES(?,?,?,?,?,?,?)");
		$stmt->bind_param('ssssisi', $usuario, $pass_hash, $nombre, $email, $activo, $token, $tipo_usuario);
		
		if ($stmt->execute()){
			return $mysqli->insert_id;
		} else {
			return 0;	
		}		
	}*/
	
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
	
/*	function validaIdToken($id, $token) {
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token = ? LIMIT 1");
		$stmt->bind_param("is", $id, $token);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {
			$stmt->bind_result($activacion);
			$stmt->fetch();
			
			if($activacion == 1) {
				$msg = "La cuenta ya se activo anteriormente.";
			} else {
				if(activarUsuario($id)){
					$msg = 'Cuenta activada.';
				} else {
					$msg = 'Error al Activar Cuenta';
				}
			}
		} else {
			$msg = 'No existe el registro para activar.';
		}
		return $msg;
	}*/
	
/*	function activarUsuario($id) {
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET activacion=1 WHERE id = ?");
		$stmt->bind_param('s', $id);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}*/
	
	function isNullLogin($usuario, $password) {
		if(strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1) {
			return true;
		} else {
			return false;
		}		
	}
	
	function encriptar($texto){
	    $key='a';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
	    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $texto, MCRYPT_MODE_CBC, md5(md5($key))));
	    return $encrypted;
	};
	function desencriptar($texto){
	    $key='a';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
	    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($texto), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	    return $decrypted;
	}

	function login($usuario, $password) {
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT usu_contraseñaPHP, carg_nombre FROM usuario INNER JOIN detalle_cargo ON usuario.detcarg_codigo = detalle_cargo.detcarg_codigo WHERE usu_cuenta = ? LIMIT 1");
		$stmt->bind_param("s", $usuario);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {			
			if(isActivo($usuario)) {				
				$stmt->bind_result($passwd, $cargo);
				$stmt->fetch();	
				$encriptado = encriptar($password);
				if(strcmp($passwd, $encriptado) == 0) {					
					/*lastSession($usuario);*/
					$_SESSION['usuario'] = $usuario;
					$_SESSION['cargo_usuario'] = $cargo;
					echo 'Entro';
					header("location: welcome.php");
				} else {					
					$errors = "La contraseña es incorrecta";
				}
			} else {
				$errors = 'El usuario esta inactivo';
			}
		} else {
			$errors = "El nombre de usuario no existe";
		}
		return $errors;
	}
	
/*	function lastSession($id) {
		global $mysqli;		
		$stmt = $mysqli->prepare("UPDATE usuarios SET last_session=NOW(), token_password='', password_request=0 WHERE id = ?");
		$stmt->bind_param('s', $id);
		$stmt->execute();
		$stmt->close();
	}*/
	
	function isActivo($usuario)	{
		global $mysqli;		
		$stmt = $mysqli->prepare("SELECT usu_estado FROM usuario WHERE usu_cuenta = ? LIMIT 1");
		$stmt->bind_param('s', $usuario);
		$stmt->execute();
		$stmt->bind_result($activacion);
		$stmt->fetch();
		
		if ($activacion == 1) {
			return true;
		} else {
			return false;	
		}
	}	
	
/*	function generaTokenPass($user_id) {
		global $mysqli;		
		$token = generateToken();		
		$stmt = $mysqli->prepare("UPDATE usuarios SET token_password=?, password_request=1 WHERE id = ?");
		$stmt->bind_param('ss', $token, $user_id);
		$stmt->execute();
		$stmt->close();
		
		return $token;
	}*/
	
/*	function getValor($campo, $campoWhere, $valor) {
		global $mysqli;		
		$stmt = $mysqli->prepare("SELECT $campo FROM usuarios WHERE $campoWhere = ? LIMIT 1");
		$stmt->bind_param('s', $valor);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0) {
			$stmt->bind_result($_campo);
			$stmt->fetch();
			return $_campo;
		} else {
			return null;	
		}
	}*/
	
/*	function getPasswordRequest($id) {
		global $mysqli;		
		$stmt = $mysqli->prepare("SELECT password_request FROM usuarios WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($_id);
		$stmt->fetch();
		
		if ($_id == 1) {
			return true;
		} else {
			return null;	
		}
	}*/
	
/*	function verificaTokenPass($user_id, $token) {		
		global $mysqli;		
		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token_password = ? AND password_request = 1 LIMIT 1");
		$stmt->bind_param('is', $user_id, $token);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0) {
			$stmt->bind_result($activacion);
			$stmt->fetch();
			if($activacion == 1) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;	
		}
	}*/
	
/*	function cambiaPassword($password, $user_id, $token) {		
		global $mysqli;		
		$stmt = $mysqli->prepare("UPDATE usuarios SET password = ?, token_password='', password_request=0 WHERE id = ? AND token_password = ?");
		$stmt->bind_param('sis', $password, $user_id, $token);
		
		if($stmt->execute()) {
			return true;
		} else {
			return false;		
		}
	}	*/	