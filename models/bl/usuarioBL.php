<?php

require_once dirname(dirname(__FILE__)) . '/dao/usuarioDAO.php';
require_once dirname(dirname(__FILE__)) . '/dto/usuario.php';

class UsuarioBL {
	private static $_instance = null;

	protected function __construct() {

	}

	/*Singleton*/
	public static function getInstance() {
		if (!isset(self::$_instance)) {
			$class = __CLASS__;
			self::$_instance = new $class;
		}
		return self::$_instance;
	}

	public static function insert(Usuario $acceso) {
        return UsuarioDAO::getInstance()->insert($acceso);
    }

    public static function delete(Usuario $usuario, $status) {
        return UsuarioDAO::getInstance()->delete($usuario, $status);
    }

    public static function update(Usuario $usuario, $cuenta, $contraseña, $modo) {
        return UsuarioDAO::getInstance()->update($usuario, $cuenta, $contraseña, $modo);
    }

    public static function listAll() {
        return UsuarioDAO::getInstance()->getByAll();
    }

    public static function search($cuenta) {
        return UsuarioDAO::getInstance()->getById($cuenta);
    }
       
    public static function authenticate($user, $password) {
        return UsuarioDAO::getInstance()->authenticate($user, $password);
    }
    
    public static function changeConnection(Usuario $usuario, $connection) {
        return UsuarioDAO::getInstance()->changeConnection($usuario, $connection);
    }
    
    //listar accesos de usuarios
    public static function listAccesoUsuarioByFilter($params) {
        return UsuarioDAO::getInstance()->getAccesoUsuarioByFilter($params);
    }
    
    // listar conexiones de usuarios
    public static function listConexionUsuarioByFilter($params) {
        return UsuarioDAO::getInstance()->getConexionUsuarioByFilter($params);
    }
    
    // listar usuarios en su lista de crud
    public static function listUsuarioByStatus($params) {
        return UsuarioDAO::getInstance()->getUsuarioByStatus($params);
    }
}