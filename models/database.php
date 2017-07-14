<?php

class Database {
  private $_dbUser;
	private $_dbPassword;
	private $_dbHost;
	protected $_dbName;
	private $_connection;
	private static $_instance;

  /*Singleton*/
  public static function getInstance() {
    if (!isset(self::$_instance)) {
      $class = __CLASS__;
      self::$_instance = new $class;
    }
    return self::$_instance;
  }

	private function __construct() {
    try {		   
      $config = parse_ini_file(dirname(dirname(__FILE__)) . '/config/config.ini'); //cargando desde config/config.ini
      $this->_dbHost = $config["host"];
	    $this->_dbUser = $config["user"];
      $this->_dbPassword = $config["password"];
	    $this->_dbName = $config["database"];

      $this->_connection = new PDO('mysql:host='.$this->_dbHost.'; dbname='.$this->_dbName, $this->_dbUser, $this->_dbPassword);
      $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->_connection->exec("SET CHARACTER SET utf8mb4");
    } catch (\PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  }

  public function prepare($sql) {
    return $this->_connection->prepare($sql);
  }

  // Obtener conexion
  public function getConnection() {
    return $this->_connection;
  }

  /** Evita que el objeto se pueda clonar*/
  public function __clone() {
    trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
  }

  public function __destruct() {
    $this->_connection = null;
  }

}