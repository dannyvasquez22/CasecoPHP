<?php

class Almacen {
	private $codigo; // table almacen PK
    private $nombre; // table almacen
    private $direccion; //table almacen

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

    public function __construct3($codigo, $nombre, $direccion) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
    }
    
    public function __construct2($nombre, $direccion) {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
    }
    
    public function __construct1($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

}