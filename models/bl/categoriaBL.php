<?php

require_once dirname(dirname(__FILE__)) . '/dao/categoriaDAO.php';
require_once dirname(dirname(__FILE__)) . '/dto/categoria.php';

class CategoriaBL {
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

	public static function insert(Categoria $categoria) {
        return CategoriaDAO::getInstance()->insert($categoria);
    }

    public static function delete(Categoria $categoria) {
        return CategoriaDAO::getInstance()->delete($categoria);
    }

    public static function update(Categoria $categoria, $referencia) {
        return CategoriaDAO::getInstance()->update($categoria, $referencia);
    }

    public static function listAll($categoria) {
        return CategoriaDAO::getInstance()->getAll($categoria);
    }

    public static function search($categoria) {
        return CategoriaDAO::getInstance()->getById($categoria);
    }

}