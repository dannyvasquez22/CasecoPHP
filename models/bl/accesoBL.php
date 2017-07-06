<?php

require_once dirname(dirname(__FILE__)) . '/dao/accesoDAO.php';
require_once dirname(dirname(__FILE__)) . '/dto/acceso.php';

class AccesoBL {
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

	public static function insert(Acceso $acceso) {
        return AccesoDAO::getInstance()->insert($acceso);
    }

    public static function delete(Acceso $acceso) {
        return AccesoDAO::getInstance()->delete($acceso);
    }

    public static function update(Acceso $acceso) {
        return AccesoDAO::getInstance()->update($acceso);
    }

    public static function listAll() {
        return AccesoDAO::getInstance()->getAll();
    }

    public static function search($acceso) {
        return AccesoDAO::getInstance()->getById($acceso);
    }

}