<?php

require_once dirname(dirname(__FILE__)) . '/database.php';
require_once dirname(dirname(__FILE__)) . '/interface/icargo.php';
require_once dirname(dirname(__FILE__)) . '/dto/cargo.php';

class CargoDAO implements ICargo {
	private static $cargo = null;
	private static $listCargos = null;
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

    public function getById($nombre) {
        $cargo = null;
        $sql = Database::getInstance()->prepare("SELECT carg_nombre AS nombre, carg_descripcion AS descripcion, DATE_FORMAT(carg_fechaCreacion, '%d/%m/%Y') AS creacion, carg_sueldoMin AS minimo, carg_sueldoMax AS maximo, IF(carg_estado = 1, 'Activo', 'Inactivo') AS estado FROM cargo WHERE carg_nombre = :nombre");
        $sql->bindParam(':nombre', $nombre);
        $sql->execute();
        $cargo = $sql->setFetchMode(PDO::FETCH_CLASS, 'Cargo');  

        return $cargo;
    }

    public function getByAllByStatus($modoEstado) {
        $listCargos = array();
        $cargo = null;
        if ($modoEstado == 0) {
            $sql = Database::getInstance()->prepare("SELECT carg_nombre AS nombre, carg_descripcion AS descripcion, DATE_FORMAT(carg_fechaCreacion, '%d/%m/%Y') AS creacion, carg_sueldoMin AS minimo, carg_sueldoMax AS maximo, IF(carg_estado = 1, 'Activo', 'Inactivo') AS estado FROM cargo WHERE carg_estado = 0 ORDER BY carg_nombre");
        } else {
            if ($modoEstado == 1) {
                $sql = Database::getInstance()->prepare("SELECT carg_nombre AS nombre, carg_descripcion AS descripcion, DATE_FORMAT(carg_fechaCreacion, '%d/%m/%Y') AS creacion, carg_sueldoMin AS minimo, carg_sueldoMax AS maximo, IF(carg_estado = 1, 'Activo', 'Inactivo') AS estado FROM cargo WHERE carg_estado = 1 ORDER BY carg_nombre");
            } else {
                $sql = Database::getInstance()->prepare("SELECT carg_nombre AS nombre, carg_descripcion AS descripcion, DATE_FORMAT(carg_fechaCreacion, '%d/%m/%Y') AS creacion, carg_sueldoMin AS minimo, carg_sueldoMax AS maximo, IF(carg_estado = 1, 'Activo', 'Inactivo') AS estado FROM cargo ORDER BY carg_nombre");
            }
        }
        $sql->execute();
        
        while ($sql->fetch()) {
            $cargo = $sql->setFetchMode(PDO::FETCH_CLASS, 'Cargo');
            array_push($listCargos, $cargo);
        }
        
        return $listCargos;
    }

    public function insert(Cargo $cargo) {
        $result = 0;
        $sql = Database::getInstance()->prepare("INSERT INTO cargo (carg_nombre, carg_descripcion, carg_fechaCreacion, carg_sueldoMin, carg_sueldoMax, carg_estado) VALUES (:nombre, :descripcion, :fechaCreacion, :sueldoMin, :sueldoMax, :estado)");
        $sql->bindParam(':nombre', $cargo->getNombre());
        $sql->bindParam(':descripcion', $cargo->getDescripcion());
        $sql->bindParam(':fechaCreacion', $cargo->getFechaCreacion());
        $sql->bindParam(':sueldoMin', $cargo->getSueldoMin());
        $sql->bindParam(':sueldoMax', $cargo->getSueldoMax());
        $sql->bindParam(':estado', $cargo->getEstado());
        $result = $sql->execute();

        return $result > 0;
    }

    public function update(Cargo $cargo, $nombreAnterior) {
        $result = 0;
        $sql = Database::getInstance()->prepare("UPDATE cargo SET carg_nombre = :nombre, carg_descripcion = :descripcion, carg_sueldoMin = :sueldoMin, carg_sueldoMax = :sueldoMax WHERE carg_nombre = :nombreAnterior");
        $sql->bindParam(':nombre', $cargo->getNombre());
        $sql->bindParam(':descripcion', $cargo->getDescripcion());
        $sql->bindParam(':sueldoMin', $cargo->getSueldoMin());
        $sql->bindParam(':sueldoMax', $cargo->getSueldoMax());
        $sql->bindParam(':nombreAnterior', $nombreAnterior);
        $result = $sql->execute();
        
        return $result > 0;
    }

    public function delete(Cargo $cargo, $status) {
        $result = 0;
        $sql = Database::getInstance()->prepare("UPDATE cargo SET carg_estado = :status WHERE carg_nombre = :nombre");
        $sql->bindParam(':status', $status);
        $sql->bindParam(':nombre', $cargo->getNombre());
        $result = $sql->execute();
        
        return $result > 0;
    }

    public function getAllByCombo($estado) {
        $listCargos = null;
        $sql = Database::getInstance()->prepare("SELECT carg_nombre FROM cargo WHERE carg_estado = :status");
        $sql->bindParam(':status', $estado);
        $result = $sql->execute();
        while ($row = $sql->fetch()){
            array_push($listCargos, $row['carg_nombre']);
        }
        
        return $listCargos;
    }

    public function countElemntChild($nombre) {
        $result = 0;
        $sql = Database::getInstance()->prepare("SELECT COUNT(detcarg_codigo) AS elementos FROM detalle_cargo WHERE carg_nombre = :nombre");
        $sql->bindParam(':nombre', $nombre);
        $result = $sql->execute();
        while ($row = $sql->fetch()) {
            $result = $row['elementos'];
        }
        
        return $result;
    }

}