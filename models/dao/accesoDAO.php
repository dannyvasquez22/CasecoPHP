<?php

require_once dirname(dirname(__FILE__)) . '/database.php';
require_once dirname(dirname(__FILE__)) . '/interface/iacceso.php';
require_once dirname(dirname(__FILE__)) . '/dto/acceso.php';

class AccesoDAO implements IAcceso {
	private static $acceso = null;
	private static $listAccesos = null;
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
        $acceso = null;
        $sql = Database::getInstance()->prepare("SELECT acc_codigo, acc_fecha, acc_horaInicio, acc_horaFin, usu_cuenta FROM acceso WHERE acc_codigo = :codigo");
        $sql->bindParam(':codigo', $codigo);
        $sql->execute();
        $acceso = $sql->setFetchMode(PDO::FETCH_CLASS, 'Acceso');  

        return $acceso;
    }

    public function getAll() {
        $listAccesos = array();
        $acceso = null;
        $sql = Database::getInstance()->prepare("SELECT acc_codigo, acc_fecha, acc_horaInicio, acc_horaFin, usu_cuenta FROM acceso");
        $sql->execute();
        
        while ($sql->fetch()) {
            $acceso = $sql->setFetchMode(PDO::FETCH_CLASS, 'Acceso');
            array_push($listAccesos, $acceso);
        }
        
        return $listAccesos;
    }

    public function insert(Acceso $acceso) {
        $result = 0;
        $sql = Database::getInstance()->prepare("INSERT INTO acceso (acc_fecha, acc_horaInicio, acc_horaFin, usu_cuenta) VALUES (:fecha, :inicio, :fin, :usuario)");
        $sql->bindParam(':fecha', $acceso->getFecha());
        $sql->bindParam(':inicio', $acceso->getHoraInicio());
        $sql->bindParam(':fin', $acceso->getHoraFin());
        $sql->bindParam(':usuario', $acceso->getUsuario());
        $result = $sql->execute();

        return $result > 0;
    }

    public function update(Acceso $acceso) {
        $result = 0;
        $sql = Database::getInstance()->prepare("UPDATE acceso SET acc_fecha = COALESCE(:fecha, acc_fecha), acc_horaInicio = COALESCE(:inicio, acc_horaInicio), acc_horaFin = COALESCE(:fin, acc_horaFin), usu_cuenta = COALESCE(:usuario, usu_cuenta) WHERE acc_codigo = :codigo");
        $sql->bindParam(':fecha', $acceso->getFecha());
        $sql->bindParam(':inicio', $acceso->getHoraInicio());
        $sql->bindParam(':fin', $acceso->getHoraFin());
        $sql->bindParam(':usuario', $acceso->getUsuario());
        $sql->bindParam(':codigo', $acceso->getCodigo());
        $result = $sql->execute();
        
        return $result > 0;
    }

    public function delete(Acceso $acceso) {
        $result = 0;
        $sql = Database::getInstance()->prepare("DELETE FROM acceso WHERE acc_codigo = :codigo");
        $sql->bindParam(':codigo', $acceso->getCodigo());
        $result = $sql->execute();
        
        return $result > 0;
    }    
}