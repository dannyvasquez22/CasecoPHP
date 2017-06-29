<?php

require_once dirname(dirname(__FILE__)) . '/dto/usuario.php';

interface IUsuario {

    public static function getAll();
	public static function getById($usuario);
    public static function authenticate($usuario, $password);
    public static function update(Usuario $usuario, $cuenta, $contraseña, $modo);
    public static function insert(Usuario $usuario);
    public static function delete(Usuario $usuario, $status);
    public static function changeConnection(Usuario $usuario, $connection);
    
    // listar accesos de usuario
    public static function getAccesoUsuarioByFilter($params);
    
    // listar conexiones de usuario
    public static function getConexionUsuarioByFilter($params);
    
    // listar usuarios en su interfaz de crud
    public static function getUsuarioByStatus($status);

}