<?php

require_once dirname(dirname(__FILE__)) . '/dao/cargoDAO.php';
require_once dirname(dirname(__FILE__)) . '/dto/cargo.php';

class CargoBL {
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

	public static function insert(Cargo $cargo) {
        return CargoDAO::getInstance()->insert($cargo);
    }

    public static function delete(Cargo $cargo, $status) {
        return CargoDAO::getInstance()->delete($cargo, $status);
    }

    public static function update(Cargo $cargo, $nombreAnterior) {
        return CargoDAO::getInstance()->update($cargo, $nombreAnterior);
    }

    public function listAllByCombo($estado) {
        return CargoDAO::getInstance()->getAllByCombo($estado);
    }
    
    public function listAllByStatus($estado) {
        return CargoDAO::getInstance()->getByAllByStatus($estado);
    }
    
    public function listByName($nombre) {
        return CargoDAO::getInstance()->getById($nombre);
    }

    public function count($nombre) {
        return CargoDAO::getInstance()->countElemntChild($nombre);
    }

}