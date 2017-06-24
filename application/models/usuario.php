<?php
	include '../controlllers/commons/funciones.php'

	class Usuario extends db_config {

		public function aunthenticate() {
			$conectar = parent::conectar();
			parent::set_names();

			if (empty($_POST['usuario']) && empty($_POST['password'])) {
				header('Location' . db_config::ruta() . 'index.php');
				exit();
			} else {
				$user =  $_POST['usuario'];
				$password = $_POST['password'];

				$sql = "SELECT usu_contraseñaPHP, carg_nombre FROM usuario INNER JOIN detalle_cargo ON usuario.detcarg_codigo = detalle_cargo.detcarg_codigo WHERE usu_cuenta = ? LIMIT 1";
				$sql = $conectar->prepare($sql);
				$sql->bindValue(1, $user);
				$sql->execute();
				$result = $sql->fetch(PDO::FETCH_ASSOC);

				$count = count($result);
				if (is_array($result) && $count >= 1) {
					if ($result['carg_nombre'] == 'Dueño' || $result['carg_nombre'] == DUEÑO'') {
						$encriptado = encriptar($password);
						if(strcmp($encriptado, $result['usu_contraseñaPHP']) == 0) {
							$_SESSION['usuario'] = $user;
							header('Location:' . db_config::ruta() . 'welcome.php');
							exit();
						} else {							
							$msg = 'Contraseña incorrecta.';
							header('Location' . db_config::ruta() . 'index.php');
							exit();
						}
					} else {
						$msg = 'El usuario no es administrador.';
						header('Location' . db_config::ruta() . 'index.php');
						exit();
					}
				} else {
					$msg = 'No existe usuario';
					header('Location' . db_config::ruta() . 'index.php');
					exit();
				}
			}
		}

	}