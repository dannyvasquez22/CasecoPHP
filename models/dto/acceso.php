<?php

class Acceso {
	private $codigo; // PK
    private $fecha;
    private $horaInicio;
    private $horaFin;
    private $usuario;

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

    public function __construct5($codigo, $fecha, $horaInicio, $horaFin, $usuario) {
        $this->codigo = $codigo;
        $this->fecha = $fecha;
        $this->horaInicio = $horaInicio;
        $this->horaFin = $horaFin;
        $this->usuario = $usuario;
    }

    public function __construct4($fecha, $horaInicio, $horaFin, $usuario) {
        $this->fecha = $fecha;
        $this->horaInicio = $horaInicio;
        $this->horaFin = $horaFin;
        $this->usuario = $usuario;
    }
    
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getHoraInicio() {
        return $this->horaInicio;
    }

    public function setHoraInicio($horaInicio) {
        $this->horaInicio = $horaInicio;
    }

    public function getHoraFin() {
        return $this->horaFin;
    }

    public function setHoraFin($horaFin) {
        $this->horaFin = $horaFin;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
}