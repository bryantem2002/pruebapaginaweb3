<?php
session_start();

// Configuración de la base de datos
$host = "localhost"; 
$dbname = "etuchisa";
$username = "root"; 
$password = ""; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si el usuario está logueado
    if (isset($_SESSION['email'])) {
        $correo = $_SESSION['email'];

        // Consulta para obtener los datos del usuario
        $sql = "SELECT nombre, apellido, fecha_nacimiento, correo, numero_celular FROM usuarios WHERE correo = :correo";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        // Si se encuentra el usuario, obtener sus datos
        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "No se encontraron datos del usuario.";
            exit();
        }
    } else {
        echo "No hay usuario logueado.";
        exit();
    }
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .logout-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #d9534f;
            color: white;
            text-align: center;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Datos del Usuario</h1>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Correo</th>
                    <th>Número de Celular</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['apellido']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['fecha_nacimiento']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['correo']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['numero_celular']); ?></td>
                </tr>
            </tbody>
        </table>
        <a href="../login.html" class="logout-btn">Cerrar sesión</a>
    </div>
</body>
</html>
