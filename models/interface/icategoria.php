<?php

require_once dirname(dirname(__FILE__)) . '/dto/categoria.php';

interface ICategoria {

    public function getById($nombre);
    public function getAll($nombre);
    public function update(Categoria $categoria, $categoriaAnterior);
    public function insert(Categoria $categoria);
    public function delete(Categoria $categoria);
    public function getElementChild($nombre);

}