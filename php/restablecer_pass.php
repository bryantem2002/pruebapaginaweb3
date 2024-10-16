<?php // Conexión a la base de datos
$host = "localhost"; 
$user = "root"; 
$password = ""; 
$dbname = "etuchisa";

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $correo = $_POST['correo'];
    $nuevaContrasena = $_POST['nueva-contrasena'];
    $confirmarContrasena = $_POST['confirmar-contrasena'];

    // Verificar si las contraseñas coinciden
    if ($nuevaContrasena === $confirmarContrasena) {
        // Almacenar la contraseña sin hashear (NO RECOMENDADO)
        $nuevaContrasenaHash = $nuevaContrasena;

        // Preparar la consulta para actualizar la contraseña
        $sql = "UPDATE usuarios SET contraseña = ? WHERE correo = ?";

        // Usar una sentencia preparada para evitar inyecciones SQL
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nuevaContrasenaHash, $correo);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Contraseña actualizada correctamente.";
        } else {
            echo "Error al actualizar la contraseña: " . $stmt->error;
        }

        // Cerrar la sentencia y la conexión
        $stmt->close();
    } else {
        echo "Las contraseñas no coinciden.";
    }
}

// Cerrar la conexión
$conn->close();
?>