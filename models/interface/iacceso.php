<?php

require_once dirname(dirname(__FILE__)) . '/dto/acceso.php';

interface IAcceso {

    public function getById($nombre);
    public function getAll();
    public function update(Acceso $acceso);
    public function insert(Acceso $acceso);
    public function delete(Acceso $acceso);

}