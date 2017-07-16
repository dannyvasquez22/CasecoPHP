<?php

function redirectTo($urlDestino = false) {
    if ($urlDestino === false) {
        $urlDestino = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '';
    }
    
    if (empty($urlDestino)) { //<-- aquí se podría mejorar controlando además si el destino es o no valido.
        //si no se especificó una url destino y no se encontro un referer, indico destion por defecto al index.php
        $urlDestino = 'index.php';
    }
    //verifico si ya fue enviado algun header:
    if (!headers_sent()) {
        //si no fue enviado un header, hago un redirect con PHP
        header('Location: ' . $urlDestino);
        exit;
    } else {
        //si ya fue enviado un header, hago un redirect con Javascript
        echo '<script type="text/javascript">window.location="' . $urlDestino . '";</script>';
        exit;
    }
}