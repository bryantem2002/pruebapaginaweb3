<?php
// Iniciar la sesión
session_start();

// Configuración de la base de datos
$host = "localhost"; // Cambiar si es necesario
$dbname = "etuchisa";
$username = "root"; // Cambiar si es necesario
$password = ""; // Cambiar si es necesario

// Conexión a la base de datos
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recoge los datos del formulario
        $correo = $_POST['email'];
        $contrasena = $_POST['password']; // No encriptada

        // Consulta para verificar el correo y la contraseña
        $sql = "SELECT * FROM usuarios WHERE correo = :correo AND contraseña = :contrasena";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->execute();

        // Comprueba si se encontró algún registro
        if ($stmt->rowCount() > 0) {
            // Obtiene los datos del usuario
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Guardar el correo en la sesión
            $_SESSION['email'] = $usuario['correo'];

            // Verifica si es el correo y contraseña específicos de administrador
            if ($correo == "etuchisa.grupo5@gmail.com" && $contrasena == "trabajofinal123") {
                // Redirigir a admin.php si es administrador
                header("Location: pagAdmi.php");
            } else {
                // Si es un usuario válido pero no es administrador, redirigir a pagUser.php
                header("Location: pagUser.php");
            }
            exit();
        } else {
            // Si no se encuentra el usuario, mostrar un mensaje de error o redirigir
            echo "Correo o contraseña incorrectos.";
        }
    }
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>
