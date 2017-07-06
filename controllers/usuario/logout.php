<?php
	require_once '../../models/routes.php';
	require_once '../../models/bl/usuarioBL.php';
	require_once '../../models/bl/accesoBL.php';

	session_start();
	$_SESSION['horaFinAcceso'] = date("H:i:s");

	UsuarioBL::getInstance()->changeConnection(new Usuario($_SESSION['usuario']), 0);
	$objAcceso = new Acceso($_SESSION['fechaAcceso'], $_SESSION['horaInicioAcceso'], $_SESSION['horaFinAcceso'], $_SESSION['usuario']);
	AccesoBL::getInstance()->insert($objAcceso);

	session_destroy();

	$_SESSION = array();

	header('Location: ' . RUTA);
?>