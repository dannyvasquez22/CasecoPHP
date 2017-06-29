<?php  
	
	$DB_HOST ='localhost';
	$DB_PORT = '3306';
	$DB_DATABASE = 'ferreteria_dino';
	$DB_USERNAME = 'root';
	$DB_PASSWORD = '1234';

	$mysqli = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
	$mysqli->query("SET NAMES 'utf8'");
	if ($mysqli->connect_error) {
		die('Error en la conexión ' . $mysqli->connect_error);
	} else {
		//printf("Información de servidor: %s\n", $mysqli->server_info);
	}

/*session_start();

class db_config {
	protected $DB_HOST ='localhost';
	protected $DB_PORT = '3306';
	protected $DB_DATABASE = 'ferreteria_dino';
	protected $DB_USERNAME = 'root';
	protected $DB_PASSWORD = '1234';
	protected $conn;

	protected function conectar() {
		try {
			$conectar = $this->conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD);
			return $conectar;
		} catch (PDOException $ex) {
			echo 'ERROR: ' . $ex->getMessage();
		}
	}

	public function set_names() {
		return $this->conn->query("SET NAMES 'utf8'");
	}

	public function ruta() {
		return 'localhost/CasecoPHP/application/';
	}
}*/