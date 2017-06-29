<?php

require_once dirname(dirname(__FILE__)) . '/dao/marcaDAO.php';
require_once dirname(dirname(__FILE__)) . '/dto/marca.php';

class MarcaBL {
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

	public static function insert(Marca $marca) {
        return MarcaDAO::getInstance()->insert($marca);
    }

    public static function delete(Marca $marca) {
        return MarcaDAO::getInstance()->delete($marca);
    }

    public static function update(Marca $marca, $referencia) {
        return MarcaDAO::getInstance()->update($marca, $referencia);
    }

    public static function listAll($marca) {
        return MarcaDAO::getInstance()->getAll($marca);
    }

    public static function search($marca) {
        return MarcaDAO::getInstance()->getById($marca);
    }

}