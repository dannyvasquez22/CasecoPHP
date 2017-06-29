<?php

require_once dirname(dirname(__FILE__)) . '/dto/marca.php';

interface IMarca {

    public function getById($nombre);
    public function getAll($nombre);
    public function update(Marca $marca, $marcaAnterior);
    public function insert(Marca $marca);
    public function delete(Marca $marca);
    public function getElementChild($nombre);

}