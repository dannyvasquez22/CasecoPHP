<?php
	require_once 'models/bl/usuarioBL.php';

	session_start(); //Iniciar una nueva sesión o reanudar la existente

	if(!empty($_POST)) {
		$_SESSION["usuario"] = $_POST['usuario'];
/*		var_dump($_POST);*/
		$usuario = $_POST['usuario'];
		$password = $_POST['password'];
		$msg = UsuarioBL::getInstance()->authenticate($usuario, $password);

		if (strcmp($msg, 'OK') == 0) {
			/*header('Location: welcome.php');*/
			echo "<script language='javascript'>window.location='welcome.php'</script>;";
		} else {
			echo $msg;
		}
	} else {
		/*header('Location: index.php');*/
		echo "<script language='javascript'>window.location='index.php'</script>;";
	}

?>