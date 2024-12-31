<!DOCTYPE html>
<html>
<head>
    <title>Control de LED y Datos de Luminosidad</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .pagination { margin: 10px 0; text-align: center; }
        .pagination a { margin: 0 5px; text-decoration: none; color: #007BFF; }
        form { margin-bottom: 20px; }
        button { padding: 10px 15px; font-size: 16px; margin-right: 10px; }
    </style>
</head>
<body>
<h2>Control de LED y Datos de Luminosidad</h2>

<!-- Botones para controlar el LED -->
<form method="post" action="control-led.php">
    <button type="submit" name="action" value="ON">Encender LED</button>
    <button type="submit" name="action" value="OFF">Apagar LED</button>
</form>

<?php
// Configuración de la base de datos
$servername = "localhost";
$dbname = "sensorData";
$username = "sensorData";
$password = "12345678";

// Paginación
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta con paginación
$sql = "SELECT id, lux_value, is_day, timestamp FROM luminosity ORDER BY id DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Mostrar datos en una tabla
echo '<table>
        <tr>
            <th>ID</th>
            <th>Lux Value</th>
            <th>Es de Día</th>
            <th>Timestamp</th>
        </tr>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . htmlspecialchars($row["id"]) . '</td>
                <td>' . htmlspecialchars($row["lux_value"]) . '</td>
                <td>' . ($row["is_day"] ? "Sí" : "No") . '</td>
                <td>' . htmlspecialchars($row["timestamp"]) . '</td>
              </tr>';
    }
} else {
    echo '<tr><td colspan="4">No hay datos disponibles</td></tr>';
}
echo '</table>';

// Paginación
$total = $conn->query("SELECT COUNT(*) AS total FROM luminosity")->fetch_assoc()['total'];
$totalPages = ceil($total / $limit);

echo '<div class="pagination">';
for ($i = 1; $i <= $totalPages; $i++) {
    echo '<a href="?page=' . $i . '">' . $i . '</a>';
}
echo '</div>';

$conn->close();
?>
</body>
</html>

