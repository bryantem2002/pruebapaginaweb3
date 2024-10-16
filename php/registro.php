<?php
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
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fechaNacimiento = $_POST['fecha-nacimiento'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena']; // No encriptada
        $numeroCelular = $_POST['celular'];

        // Prepara la consulta SQL para insertar los datos
        $sql = "INSERT INTO usuarios (nombre, apellido, fecha_nacimiento, numero_celular, correo, contraseña)
                VALUES (:nombre, :apellido, :fecha_nacimiento, :numero_celular, :correo, :contrasena)";

        // Prepara la declaración
        $stmt = $conn->prepare($sql);

        // Vincula los parámetros
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':fecha_nacimiento', $fechaNacimiento);
        $stmt->bindParam(':numero_celular', $numeroCelular);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            header("Location: ../login.html");
            exit(); 
        } else {
            echo "Hubo un problema al registrar el usuario.";
        }
    }
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>