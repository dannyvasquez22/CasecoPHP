<?php

class Usuario {
    private $cuenta;
    private $contraseña;
    private $ipReferencia;
    private $estadoConexion;
    private $estado;
    private $detalleCargo;
    
    function __construct() {
        $params = func_get_args();  //obtengo un array con los parámetros enviados a la función
        $num_params = func_num_args(); //saco el número de parámetros que estoy recibiendo en la función 
        //cada constructor de un número dado de parámtros tendrá un nombre de funcion generado diferente
        //atendiendo al siguiente modelo __construct1() __construct2()...
        $funcion_constructor = '__construct' . $num_params;
        if (method_exists($this, $funcion_constructor)) { //compruebo si hay un constructor con ese número de parámetros
            call_user_func_array(array($this, $funcion_constructor), $params); //si existía esa función, la invoco, reenviando los parámetros que recibí en el constructor original
        }
    }

    /*falta resolver esta diferencia de objetos tipo string y el tipo detalleg cargo*/
    public function __construct1($cuenta) {
        $this->cuenta = $cuenta;
    }

    public function __construct2($cuenta, $estadoConexion) {
        $this->cuenta = $cuenta;
        $this->estadoConexion = $estadoConexion;
    }
    
/*    public function __construct1($detalleCargo) {
        $this->detalleCargo = $detalleCargo;
    }*/
    
    public function __construct3($cuenta, $contraseña, $detalleCargo) {
        $this->cuenta = $cuenta;
        $this->contraseña = $contraseña;
        $this->detalleCargo = $detalleCargo;
    }

    public function __construct4($cuenta, $contraseña, $ipReferencia, $detalleCargo) {
        $this->cuenta = $cuenta;
        $this->contraseña = $contraseña;
        $this->ipReferencia = $ipReferencia;
        $this->detalleCargo = $detalleCargo;
    }

    public function __construct6($cuenta, $contraseña, $ipReferencia, $estadoConexion, $estado, $detalleCargo) {
        $this->cuenta = $cuenta;
        $this->contraseña = $contraseña;
        $this->ipReferencia = $ipReferencia;
        $this->estadoConexion = $estadoConexion;
        $this->estado = $estado;
        $this->detalleCargo = $detalleCargo;
    }    

    public function getCuenta() {
        return $this->cuenta;
    }

    public function setCuenta($cuenta) {
        $this->cuenta = $cuenta;
    }

    public function getContraseña() {
        return $this->contraseña;
    }

    public function setContraseña($contraseña) {
        $this->contraseña = $contraseña;
    }

    public function getIpReferencia() {
        return $this->ipReferencia;
    }

    public function setIpReferencia($ipReferencia) {
        $this->ipReferencia = $ipReferencia;
    }

    public function getEstadoConexion() {
        return $this->estadoConexion;
    }

    public function setEstadoConexion($estadoConexion) {
        $this->estadoConexion = $estadoConexion;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getDetalleCargo() {
        return $this->detalleCargo;
    }

    public function setDetalleCargo($detalleCargo) {
        $this->detalleCargo = $detalleCargo;
    }

}