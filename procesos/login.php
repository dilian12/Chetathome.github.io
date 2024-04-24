<?php
session_start();

require '../clases/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

    // Verificar que los campos requeridos no estén vacíos
    if (!empty($correo) && !empty($contrasena)) {
        // Llama a la función para verificar las credenciales en MongoDB
        $usuarioValido = verificarCredencialesMongoDB($correo, $contrasena);

        if ($usuarioValido) {
            // Almacenar el nombre del usuario en la variable de sesión
            $_SESSION['nombre_usuario'] = $usuario['nombre'];

            // Mostrar alerta y redirigir a index.php
            echo "<script>
                    alert('Inicio de sesión exitoso');
                    window.location.href = '../inicio.php';
                  </script>";
            exit; // Termina el script después de la redirección
        } else {
            echo "Credenciales incorrectas.";
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
} else {
    echo "Acceso no permitido.";
}

function verificarCredencialesMongoDB($correo, $contrasena) {
    $cliente = conectarMongoDB();
    $baseDeDatos = $cliente->platillosbebidas;
    $coleccion = $baseDeDatos->registros;

    // Buscar el usuario por el correo
    $usuario = $coleccion->findOne(['correo' => $correo]);

    $cliente = null; // Cierra la conexión al finalizar la operación

    // Verificar la contraseña si se encontró el usuario
    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        return true;
    }

    return false;
}

?>
