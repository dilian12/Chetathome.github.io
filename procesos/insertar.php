<?php

require '../clases/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

    // Verificar que los campos requeridos no estén vacíos
    if (!empty($nombre) && !empty($correo) && !empty($telefono) && !empty($contrasena)) {
        // Crear un array con los datos
        $datos = [
            'nombre' => $nombre,
            'correo' => $correo,
            'telefono' => $telefono,
            'contrasena' => password_hash($contrasena, PASSWORD_BCRYPT), // Hashear la contraseña
        ];

        // Llama a la función para insertar los datos en MongoDB
        $idDocumentoInsertado = insertarDatosMongoDB($datos);

        // Mostrar alerta y redirigir a index.php
        echo "<script>
                alert('Datos registrados con éxito');
                window.location.href = '../index.php';
              </script>";
    } else {
        echo "Todos los campos son obligatorios.";
    }
} else {
    echo "Acceso no permitido.";
}

function insertarDatosMongoDB($datos) {
    $cliente = conectarMongoDB();
    $baseDeDatos = $cliente->platillosbebidas;
    $coleccion = $baseDeDatos->registros;

    $resultado = $coleccion->insertOne($datos);

    $cliente = null; // Cierra la conexión al finalizar la operación

    // Devuelve el ID del documento insertado
    return $resultado->getInsertedId();
}

?>
