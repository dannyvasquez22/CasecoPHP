<?php

require_once dirname(dirname(__FILE__)) . '/database.php';
require_once dirname(dirname(__FILE__)) . '/interface/imarca.php';
require_once dirname(dirname(__FILE__)) . '/dto/marca.php';

class MarcaDAO implements IMarca {
	private static $marca = null;
	private static $listMarcas = null;
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
        $marca = null;
        $sql = Database::getInstance()->prepare("SELECT marca_nombre AS nombre, marca_descripcion AS descripcion FROM marca WHERE marca_nombre = :marca ORDER BY marca_nombre");
        $sql->bindParam(':marca', $nombre);
        $sql->execute();
        $marca = $sql->setFetchMode(PDO::FETCH_CLASS, 'Marca');  

        return $marca;
    }

    public function getAll($nombre) {
        $listMarcas = array();
        $marca = null;
        if (isEmpty($nombre)) {
            $sql = Database::getInstance()->prepare("SELECT marca_nombre, marca_descripcion FROM marca ORDER BY marca_nombre");
        } else {
            $sql = Database::getInstance()->prepare("SELECT marca_nombre, marca_descripcion FROM marca WHERE marca_nombre LIKE :nombre ORDER BY marca_nombre");
            $sql->bindParam(':nombre', $nombre . '%');
        }
        $sql->execute();
        
        while ($sql->fetch()) {
            $marca = $sql->setFetchMode(PDO::FETCH_CLASS, 'Marca');
            array_push($listMarcas, $marca);
        }
        
        return $listMarcas;
    }

    public function insert(Marca $marca) {
        $result = 0;
        $sql = Database::getInstance()->prepare("INSERT INTO marca (marca_nombre, marca_descripcion) VALUES (:nombre, :descripcion)");
        $sql->bindParam(':nombre', $marca->getNombre());
        $sql->bindParam(':descripcion', $marca->getDescripcion());
        $result = $sql->execute();
        
        return $result > 0;
    }

    public function update(Marca $marca, $marcaAnterior) {
        $result = 0;
        $sql = Database::getInstance()->prepare("UPDATE marca SET marca_nombre = :nombre, marca_descripcion = :descripcion WHERE marca_nombre = :marcaAnterior");
        $sql->bindParam(':nombre', $marca->getNombre());
        $sql->bindParam(':descripcion', $marca->getDescripcion());
        $sql->bindParam(':marcaAnterior', $marcaAnterior);
        $result = $sql->execute();
        
        return $result > 0;
    }

    public function delete(Marca $marca) {
        $result = 0;
        $sql = Database::getInstance()->prepare("DELETE FROM marca WHERE marca_nombre = :nombre");
        $sql->bindParam(':nombre', $marca->getNombre());
        $result = $sql->execute();
        
        return $result > 0;
    }

    public function getElementChild($marca) {
        $result = 0;
        $sql = Database::getInstance()->prepare("SELECT COUNT(marca_nombre) AS total FROM producto WHERE marca_nombre = :nombre");
        $sql->bindParam(':nombre', $marca->getNombre());
        $sql->execute();
        while ($row = $sql->fetch()) {
            $result = $row['total'];
        }
        
        return $result;
    }
    
}