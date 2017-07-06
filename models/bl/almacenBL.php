<?php

require_once dirname(dirname(__FILE__)) . '/dao/almacenDAO.php';
require_once dirname(dirname(__FILE__)) . '/dto/almacen.php';

class AlmacenBL {
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

	public static function insert(Almacen $almacen) {
        return AlmacenDAO::getInstance()->insert($almacen);
    }

    public static function delete(Almacen $almacen) {
        return AlmacenDAO::getInstance()->delete($almacen);
    }

    public static function update(Almacen $almacen) {
        return AlmacenDAO::getInstance()->update($almacen);
    }

    public static function listAll() {
        return AlmacenDAO::getInstance()->getAll();
    }

    public static function search($almacen) {
        return AlmacenDAO::getInstance()->getById($almacen);
    }

    public static function getByName($name) {
        return AlmacenDAO::getInstance()->getByName($name);
    }
    
    public static function count($codigo) {
        return AlmacenDAO::getInstance()->getElementChild($codigo);
    }
    
    public static function listNamesCombo() {
        return AlmacenDAO::getInstance()->getNameByCombo();
    }
    
    public static function listNamesByStoreByCombo($tiendarazonSocial) {
        return AlmacenDAO::getInstance()->getNameByStoreByCombo($tiendarazonSocial);
    }

}