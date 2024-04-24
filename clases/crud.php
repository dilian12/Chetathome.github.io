<?php

require '../vendor/autoload.php';
include 'conexion.php'; 

function mostrarDatosMongoDB() {
    $cliente = conectarMongoDB();
    $baseDeDatos = $cliente->platillosbebidas;
    $coleccion = $baseDeDatos->registros;

    $resultados = $coleccion->find();

    $cliente = null; 
}

mostrarDatosMongoDB();

?>
