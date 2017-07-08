<?php

class Cargo {
    private $nombre;
    private $descripcion;
    private $fechaCreacion;
    private $sueldoMin;
    private $sueldoMax;
    private $estado;

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

    public function __construct1($nombre) {
        $this->nombre = $nombre;
    }

    public function __construct2($nombre, $fechaCreacion) {
        $this->nombre = $nombre;
        $this->fechaCreacion = $fechaCreacion;
    }

    public function __construct4($nombre, $descripcion, $sueldoMin, $sueldoMax) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->sueldoMin = $sueldoMin;
        $this->sueldoMax = $sueldoMax;
    }

    public function __construct6($nombre, $descripcion, $fechaCreacion, $sueldoMin, $sueldoMax, $estado) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->fechaCreacion = $fechaCreacion;
        $this->sueldoMin = $sueldoMin;
        $this->sueldoMax = $sueldoMax;
        $this->estado = $estado;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function getSueldoMin() {
        return $this->sueldoMin;
    }

    public function setSueldoMin($sueldoMin) {
        $this->sueldoMin = $sueldoMin;
    }

    public function getSueldoMax() {
        return $this->sueldoMax;
    }

    public function setSueldoMax($sueldoMax) {
        $this->sueldoMax = $sueldoMax;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

}