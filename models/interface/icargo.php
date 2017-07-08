<?php

require_once dirname(dirname(__FILE__)) . '/dto/cargo.php';

interface ICargo {

    public function getById($nombre);
    public function getByAllByStatus($modoEstado);
    public function insert(Cargo $cargo);
    public function update(Cargo $cargo, $nombreAnterior);
    public function delete(Cargo $cargo, $status);
    public function getAllByCombo($estado);
    public function countElemntChild($nombre);

}