<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
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
        <h1>Datos del Administrador</h1>
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
                <?php
                // Conexión a la base de datos
                $host = "localhost"; // Cambia si es necesario
                $dbname = "etuchisa";
                $username = "root"; // Cambia si es necesario
                $password = ""; // Cambia si es necesario

                try {
                    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Consulta para obtener los datos del usuario administrador
                    $sql = "SELECT nombre, apellido, fecha_nacimiento, correo, numero_celular FROM usuarios WHERE correo = 'etuchisa.grupo5@gmail.com'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    // Verifica si se encontró el usuario
                    if ($stmt->rowCount() > 0) {
                        // Mostrar los datos en la tabla
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['apellido']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['fecha_nacimiento']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['correo']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['numero_celular']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No se encontraron datos para el administrador.</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='5'>Error en la conexión: " . $e->getMessage() . "</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="../login.html" class="logout-btn">Cerrar sesión</a>
    </div>
</body>
</html>
