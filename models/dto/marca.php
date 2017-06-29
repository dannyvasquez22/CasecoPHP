<?php

class Marca {
	private $nombre;
    private $descripcion;

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

    public function __construct2($nombre, $descripcion) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    public function getNombre() {
        return $nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getDescripcion() {
        return $descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
}