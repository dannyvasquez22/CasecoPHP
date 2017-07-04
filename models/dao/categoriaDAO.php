<?php

require_once dirname(dirname(__FILE__)) . '/database.php';
require_once dirname(dirname(__FILE__)) . '/interface/icategoria.php';
require_once dirname(dirname(__FILE__)) . '/dto/categoria.php';

class CategoriaDAO implements ICategoria {
	private static $categoria = null;
	private static $listCategorias = null;
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
        $categoria = null;
        $sql = Database::getInstance()->prepare("SELECT cate_nombre AS nombre, cate_descripcion AS descripcion FROM categoria WHERE cate_nombre = :categoria ORDER BY cate_nombre");
        $sql->bindParam(':categoria', $nombre);
        $sql->execute();
        $categoria = $sql->setFetchMode(PDO::FETCH_CLASS, 'Categoria');  

        return $categoria;
    }

    public function getAll($nombre) {
        $listCategorias = array();
        $categoria = null;
        if (isEmpty($nombre)) {
            $sql = Database::getInstance()->prepare("SELECT cate_nombre, cate_descripcion FROM categoria ORDER BY cate_nombre");
        } else {
            $sql = Database::getInstance()->prepare("SELECT cate_nombre, cate_descripcion FROM categoria WHERE cate_nombre LIKE :nombre ORDER BY cate_nombre");
            $sql->bindParam(':nombre', $nombre . '%');
        }
        $sql->execute();
        
        while ($sql->fetch()) {
            $categoria = $sql->setFetchMode(PDO::FETCH_CLASS, 'Categoria');
            array_push($listCategorias, $categoria);
        }
        
        return $listCategorias;
    }

    public function insert(Categoria $categoria) {
        $result = 0;
        $sql = Database::getInstance()->prepare("INSERT INTO categoria (cate_nombre, cate_descripcion) VALUES (:nombre, :descripcion)");
        $sql->bindParam(':nombre', $categoria->getNombre());
        $sql->bindParam(':descripcion', $categoria->getDescripcion());
        $result = $sql->execute();

        return $result > 0;
    }

    public function update(Categoria $categoria, $categoriaAnterior) {
        $result = 0;
        $sql = Database::getInstance()->prepare("UPDATE categoria SET cate_nombre = :nombre, cate_descripcion = :descripcion WHERE cate_nombre = :categoriaAnterior");
        $sql->bindParam(':nombre', $categoria->getNombre());
        $sql->bindParam(':descripcion', $categoria->getDescripcion());
        $sql->bindParam(':categoriaAnterior', $categoriaAnterior);
        $result = $sql->execute();
        
        return $result > 0;
    }

    public function delete(Categoria $categoria) {
        $result = 0;
        $sql = Database::getInstance()->prepare("DELETE FROM categoria WHERE cate_nombre = :nombre");
        $sql->bindParam(':nombre', $categoria->getNombre());
        $result = $sql->execute();
        
        return $result > 0;
    }

    public function getElementChild($categoria) {
        $result = 0;
        $sql = Database::getInstance()->prepare("SELECT COUNT(cate_nombre) AS total FROM producto WHERE cate_nombre = :nombre");
        $sql->bindParam(':nombre', $categoria->getNombre());
        $sql->execute();
        while ($row = $sql->fetch()) {
            $result = $row['total'];
        }
        
        return $result;
    }
    
}