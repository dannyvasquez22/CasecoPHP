<?php

require_once dirname(dirname(__FILE__)) . '/database.php';
require_once dirname(dirname(__FILE__)) . '/interface/iusuario.php';
require_once dirname(dirname(__FILE__)) . '/dto/usuario.php';
include_once dirname(dirname(__FILE__)) . '/passwd.php';

class UsuarioDAO implements IUsuario {
	private static $usuario = null;
	private static $listUsuarios = null;
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

	public static function getAll() {
		$listUsuarios = null;
		$sql = Database::getInstance()->prepare("SELECT usu_cuenta, usu_contraseña, usu_ipReferencia, usu_estadoConexion, usu_estado, detcarg_codigo FROM usuario");
		$sql->execute();
		/*$data = $sql->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $clave => $valor) {
			$usuario = new Usuario();
			$usuario->setCuenta( $data[$clave]["usu_cuenta"] );
			$usuario->setContraseña( $data[$clave]["usu_contraseña"] );
			$usuario->setIpReferencia( $data[$clave]["usu_ipReferencia"] );
			$usuario->setEstadoConexion( $data[$clave]["usu_estadoConexion"] );
			$usuario->setEstado( $data[$clave]["usu_estado"] );
			$usuario->setDetallecargo( $data[$clave]["detcarg_codigo"] );
			array_push($listUsuarios, $usuario);
		}
		return $listUsuarios;
		*/

		$listUsuarios = $sql->setFetchMode(PDO::FETCH_CLASS, 'Usuario');

		return $listUsuarios;
	}

    public static function getById($cuenta) {         
        $usuario = null;
        $sql = Database::getInstance()->prepare("SELECT usu_cuenta, usu_contraseña, usu_ipReferencia, usu_estadoConexion, usu_estado, detcarg_codigo FROM usuario WHERE usu_cuenta = :cuenta LIMIT 1");
        $sql->bindParam(':cuenta', $cuenta);
        $sql->execute();
		$usuario = $sql->setFetchMode(PDO::FETCH_CLASS, 'Usuario');  
        
        return $usuario;
    }

    public static function insert(Usuario $usuario) {
        $contraseña = new Password();
        $result = 0;
        $sql = Database::getInstance()->prepare("INSERT INTO usuario (usu_cuenta, usu_contraseña, usu_ipReferencia, detcarg_codigo) VALUES (:cuenta, :contraseña, :ip, :detalleCargo)");
        $passwd = $contraseña->encriptar($usuario->getContraseña());

        $sql->bindParam(':cuenta', $usuario->getCuenta());
        $sql->bindParam(':contraseña', $passwd);
        $sql->bindParam(':ip', $usuario->getIpReferencia());
        $sql->bindParam(':detalleCargo', $usuario->getDetalleCargo());
        
        $result = $sql->execute();
        
        return $result > 0;
    }

    public static function update(Usuario $usuario, $cuenta, $contraseña, $modo) {
        $contraseña = new Password();
        $result = 0;
        if ($modo == 0) {
            if ($contraseña == null) { // Cambiar usuario
                $sql = Database::getInstance()->prepare("UPDATE usuario SET usu_cuenta = :cuentaNueva WHERE usu_cuenta = :cuentaAntigua AND usu_contraseña = :contraseña");
                $passwd = $contraseña->encriptar($usuario->getContraseña());
                $sql->bindParam(':cuentaNueva', $cuenta);
                $sql->bindParam(':cuentaAntigua', $usuario->getCuenta());
                $sql->bindParam(':contraseña', $passwd);
            } else { // Cambiar contraseña
                $sql = Database::getInstance()->prepare("UPDATE usuario SET usu_contraseña = :contraseña WHERE usu_cuenta = :cuenta");
                $passwd = $contraseña->encriptar($usuario->getContraseña());
                $sql->bindParam(':contraseña', $passwd);
                $sql->bindParam(':cuenta', $usuario->getCuenta());
            } 
        } else { // Cambiar otros atributos
            $sql = Database::getInstance()->prepare("UPDATE usuario SET usu_cuenta = :cuentaNueva, usu_ipReferencia = :ip WHERE usu_cuenta = :cuentaAntigua");
            $sql->bindParam(':cuentaNueva', $cuenta);
            $sql->bindParam(':ip', $contraseña); //actua como ip
            $sql->bindParam(':cuentaAntigua', $usuario->getCuenta());
        }
        $result = $sql->execute();
        
        return ($result > 0);
    }

    public static function delete(Usuario $usuario, $status) {
        $result = 0;
        $sql = Database::getInstance()->prepare("UPDATE usuario SET usu_estado = :estado WHERE usu_cuenta = :cuenta");
        $sql->bindParam(':estado', $status);
        $sql->bindParam(':cuenta', $usuario->getCuenta());        
        $result = $sql->execute();
        
        return ($result > 0);
    }

    public static function authenticate($user, $password) {
        $contraseña = new Password();
        $usuario = null;
        $sql = Database::getInstance()->prepare("SELECT usu_contraseñaPHP, carg_nombre, usu_estado FROM usuario INNER JOIN detalle_cargo ON
        	 usuario.detcarg_codigo = detalle_cargo.detcarg_codigo WHERE usu_cuenta = :cuenta");
        $sql->bindParam(':cuenta', $user);
        $sql->execute();
		$rows = $sql->rowCount();
		$msg = '';
		if($rows > 0) {
			while ($row = $sql->fetch()) {
				$passwd = $row['usu_contraseñaPHP'];
				$cargo = $row['carg_nombre'];
				$status = $row['usu_estado'];
			}
			if($status) {
				$encriptado = $contraseña->encriptar($password);
				if(strcmp($passwd, $encriptado) == 0) {
					$_SESSION['cargo_usuario'] = $cargo;
					$msg = 'OK';
				} else {					
					$msg = 'La contraseña es incorrecta';
				}
			} else {
				$msg = 'El usuario esta inactivo';
			}
		} else {
			$msg = 'El nombre de usuario no existe';
		}

		return $msg;
    }

    public static function changeConnection(Usuario $usuario, $status) {
        $result = 0;
        $sql = Database::getInstance()->prepare("UPDATE usuario SET usu_estadoConexion = :estado WHERE usu_cuenta = :estado");
        $sql->bindParam(':estado', $status);
        $sql->bindParam(':cuenta', $usuario->getCuenta());
        $result = $sql->execute();
        
        return $result > 0;
    }

    public static function getAccesoUsuarioByFilter($elementsQuery) {
        $listUsuarios = null;
        $usuario = null;
        $sql = Database::getInstance()->prepare("CALL sp_listarUsuarios(:1, :2, :3, NULL, 0)");
        if ($elementsQuery[0] == null) {
            $sql->bindParam(':1', $elementsQuery[0] = NULL, PDO::PARAM_STR);
        } else {
            $sql->bindParam(':1', $elementsQuery[0]);
        }
        if ($elementsQuery[1] == null) {
            $sql->bindParam(':2', $elementsQuery[1] = NULL, PDO::PARAM_STR);
        } else{
            $sql->bindParam(':2', $elementsQuery[1]);
        }
        if ($elementsQuery[2] == null) {
            $sql->bindParam(':3', $elementsQuery[2] = NULL, PDO::PARAM_STR);
        } else{
            $sql->bindParam(':3', $elementsQuery[2]);
        }        
        $sql->execute();

/*        while(rs.next()){
            userAccessDTO = new AccesoUsuarioP(
                    rs.getString("nombres"), 
                    rs.getString("cuenta"),
                    rs.getString("fecha"), 
                    rs.getString("horaInicio"), 
                    rs.getString("horaFin"));
            userAccessList.add(userAccessDTO);
        }
        
        return userAccessList;*/
    }

    public static function getConexionUsuarioByFilter($elementsQuery) {
/*        connectedUsersList = new ArrayList<>();
        connectedUsersDTO = null;
        call = dbInstance.getConnection().prepareCall("{CALL sp_listarUsuarios(?, ?, ?, ?, 1)}");
        if (elementsQuery[0] == null) {
            call.setNull(1, Types.VARCHAR);
        } else {
            call.setString(1, elementsQuery[0]); 
        }
        if (elementsQuery[1] == null) {
            call.setNull(2, Types.VARCHAR); 
        } else{
            call.setString(2, elementsQuery[1]);
        }
        if (elementsQuery[2] == null) {
            call.setNull(3, Types.VARCHAR); 
        } else{
            call.setString(3, elementsQuery[2]);
        }
        if (elementsQuery[3] == null) {
            call.setNull(4, Types.VARCHAR);
        } else {
            call.setInt(4, Integer.parseInt(elementsQuery[3]));
        }
        rs = call.executeQuery();
        while(rs.next()){
            connectedUsersDTO = new ConectadoUsuarioP(
                    rs.getString("nombres"), 
                    rs.getString("cuenta"),
                    rs.getString("cargo"), 
                    rs.getString("estado"), 
                    rs.getString("ip"));
            connectedUsersList.add(connectedUsersDTO);
        }
        rs.close();
        call.close();
                
        return connectedUsersList;*/
    }
    
    public static function getUsuarioByStatus($status) {
/*        listCrudList = new ArrayList<>();
        listCrudDTO = null;
        call = dbInstance.getConnection().prepareCall("{CALL sp_listarUsuarios(NULL, NULL, NULL, ?, 2)}");
        if (status < 0) {
            call.setNull(1, Types.INTEGER);
        } else {
            call.setInt(1, status);
        }        
        rs = call.executeQuery();
        while(rs.next()){
            listCrudDTO = new ListaCrudUsuarioP(
                    rs.getString("codigo"),
                    rs.getString("nombres"), 
                    rs.getString("cargo"), 
                    rs.getString("cuenta"),                    
                    rs.getString("estado"), 
                    rs.getString("ip"));
            listCrudList.add(listCrudDTO);
        }
        rs.close();
        call.close();
                
        return listCrudList;*/
    }

    /*public function selectUsuarios(){

		$data_source = new DataSource();
		$data_table = $data_source->ejecutarConsulta("SELECT * FROM usuario");
		$usuario = null;
		$usuarios = array();

		foreach ($data_table as $clave => $valor) {
			$usuario = new Usuario();
			$usuario->setIdusuario( $data_table[$clave]["idusuario"] );
			$usuario->setNombre( $data_table[$clave]["nombre"] );
			$usuario->setApellidoPaterno( $data_table[$clave]["apellidoPaterno"] );
			$usuario->setApellidoMaterno( $data_table[$clave]["apellidoMaterno"] );
			$usuario->setNacionalidad( $data_table[$clave]["nacionalidad"] );
			$usuario->setSexo( $data_table[$clave]["sexo"] );
			$usuario->setCorreo( $data_table[$clave]["correo"] );
			$usuario->setClave( $data_table[$clave]["clave"] );
			array_push($usuarios, $usuario);
		}
		return $usuarios;
	}*/
}