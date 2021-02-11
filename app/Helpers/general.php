<?php

use App\Paises;
use App\Repositories\PaisesRepository;

function routePais($name,$params = []) {
    $codigoPais = request()->segment(1);
    array_unshift($params,$codigoPais);
    return route($name,$params);
}

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function paises() 
{
    return Paises::whereEnabled(true)->orderBy('nombre')->get();
}

function paisActual($codigoPais=null) {
    if (!$codigoPais) {
        $codigoPais = request()->segment(1);
    }
    
    $repo = \App::make(PaisesRepository::class);
    return $repo->porCodigo($codigoPais);
}