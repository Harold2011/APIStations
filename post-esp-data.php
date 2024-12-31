<?php

$servername = "localhost";
$dbname = "station";
$username = "Discientic";
$password = "12345678";

// Clave API configurada
$api_key_value = "tPmAT5Ab3j7F9";

$api_key = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    
    if ($api_key == $api_key_value) {
        $id_station = 1;
        $id_sensor = 1; // Inicializa el ID del sensor
        
        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Recorre todas las variables esperadas
        $variables = [
            "COR1", "COR2", "COR3", "COR4", "COR5", "COR6",
            "VOL1", "VOL2", "VOL3", "VOL4",
            "RPM1", "RPM2", "RPM3",
            "VEL1", "VEL2",
            "DIR1"
        ];

        foreach ($variables as $var) {
            if (isset($_POST[$var])) {
                $measurement = test_input($_POST[$var]);

                // Insertar datos en la tabla "Parameter"
                $sql = "INSERT INTO Parameter (id_station, id_sensor, measurement, dataTime) 
                        VALUES ('$id_station', '$id_sensor', '$measurement', NOW())";

                if ($conn->query($sql) === TRUE) {
                    echo "Record for $var created successfully.<br>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
                }

                // Incrementar $id_sensor para cada registro
                $id_sensor++;
            }
        }

        $conn->close();
    } else {
        echo "Wrong API Key provided.";
    }

} else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
