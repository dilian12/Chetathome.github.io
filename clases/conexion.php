<?php

require '../vendor/autoload.php';
use MongoDB\Client as MongoClient;

function conectarMongoDB() {
    $uri = "mongodb://localhost:27017"; 
    $cliente = new MongoClient($uri);

    return $cliente;
}
?>

