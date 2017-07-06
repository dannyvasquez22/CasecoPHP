<?php

require_once dirname(dirname(__FILE__)) . '/dto/almacen.php';

interface IAlmacen {

    public function getById($codigo);
    public function getByName($nombre);
    public function getAll();
    public function getElementChild($codigo);
    public function getNameByCombo();
    public function getNameByStoreByCombo($tiendaRazonSocial);
    public function update(Almacen $almacen);
    public function insert(Almacen $almacen);
    public function delete(Almacen $almacen);

}