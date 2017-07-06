<?php

require_once dirname(dirname(__FILE__)) . '/database.php';
require_once dirname(dirname(__FILE__)) . '/interface/ialmacen.php';
require_once dirname(dirname(__FILE__)) . '/dto/almacen.php';

class AlmacenDAO implements IAlmacen {
    private static $almacen = null;
    private static $listAlmacen = null;
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

    public function getById($codigo) {
        $almacen = null;
        $sql = Database::getInstance()->prepare("SELECT alm_codigo, alm_nombre, alm_direccion FROM almacen WHERE alm_codigo = :codigo");
        $sql->bindParam(':codigo', $codigo);
        $sql->execute();
        $almacen = $sql->setFetchMode(PDO::FETCH_CLASS, 'Almacen');

        return $almacen;
    }

    public function getAll() {
        $listAlmacen = array();
        $almacen = null;
        $sql = Database::getInstance()->prepare("SELECT alm_codigo, alm_nombre, alm_direccion FROM almacen");
        $sql->execute();
        
        while ($sql->fetch()) {
            $almacen = $sql->setFetchMode(PDO::FETCH_CLASS, 'Almacen');
            array_push($listAlmacen, $almacen);
        }
        
        return $listAlmacen;
    }

    public function getByName($nombre) {
        $listAlmacen = array();
        $almacen = null;
        $sql = Database::getInstance()->prepare("SELECT alm_codigo, alm_nombre, alm_direccion FROM almacen WHERE alm_nombre = :nombre");
        $sql->bindParam(':nombre', $nombre);
        $sql->execute();
        
        while ($sql->fetch()) {
            $almacen = $sql->setFetchMode(PDO::FETCH_CLASS, 'Almacen');
            array_push($listAlmacen, $almacen);
        }
        
        return $listAlmacen;
    }

    public function insert(Almacen $almacen) {
        $result = 0;
        $sql = Database::getInstance()->prepare("INSERT INTO almacen (alm_nombre, alm_direccion) VALUES (:nombre, :direccion)");
        $sql->bindParam(':nombre', $almacen->getNombre());
        $sql->bindParam(':direccion', $almacen->getDireccion());
        $result = $sql->execute();

        return $result > 0;
    }

    public function update(Almacen $almacen) {
        $result = 0;
        $sql = Database::getInstance()->prepare("UPDATE almacen SET alm_nombre = :nombre, alm_direccion = :direccion WHERE alm_codigo = :codigo");
        $sql->bindParam(':nombre', $almacen->getNombre());
        $sql->bindParam(':direccion', $almacen->getDireccion());
        $sql->bindParam(':codigo', $almacen->getCodigo());
        $result = $sql->execute();
        
        return $result > 0;
    }

    public function delete(Almacen $almacen) {
        $result = 0;
        $sql = Database::getInstance()->prepare("DELETE FROM almacen WHERE alm_codigo = :codigo");
        $sql->bindParam(':codigo', $almacen->getCodigo());
        $result = $sql->execute();
        
        return $result > 0;
    }    

    public function getElementChild($codigo) {
        $result = 0;
        $sql = Database::getInstance()->prepare("SELECT COALESCE(COUNT(dettien_codigo), 0) AS total FROM detalle_tienda WHERE alm_codigo = :codigo");
        $sql->bindParam(':codigo', $codigo);
        $sql->execute();
        while ($row = $sql->fetch()) {
            $result = $row["total"];
        }
        
        return $result;
    }

    public function getNameByCombo() {
        $listAlmacen = null;
        $almacen= null;
        $sql = Database::getInstance()->prepare("SELECT alm_nombre AS nombre FROM almacen ORDER BY alm_nombre");
        $sql->execute();
        while ($row = $sql->fetch()) {
            $almacen = row['nombre'];
            array_push($listAlmacen, $almacen);
        }

        return $listAlmacen;
    }

    public function getNameByStoreByCombo($tiendaRazonSocial) {
        $listAlmacen = null;
        $almacen = null;
        $sql = Database::getInstance()->prepare("SELECT al.alm_nombre AS nombre "
                + "FROM almacen AS al "
                + "INNER JOIN detalle_tienda AS dt ON al.alm_codigo = dt.alm_codigo "
                + "INNER JOIN tienda AS ti ON dt.tienda_codigo = ti.tienda_codigo "
                + "WHERE ti.tienda_razonSocial = :razon");
        $sql->bindParam(':razon', $tiendaRazonSocial);
        $sql->execute();
        while ($row = $sql->fetch()) {
            $almacen = $row['nombre'];
            array_push($listAlmacen, $almacen);
        }
        
        return $listAlmacen;
    }
}