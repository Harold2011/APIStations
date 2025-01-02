<?php
// GetUserBoards.php

function getUserBoards($pdo, $user_id) {
    try {
        // Consulta SQL modificada para obtener toda la información relacionada
        $query = "
            SELECT 
                station.id AS station_id,
                station.Name AS station_name,
                station.Description AS station_description,
                station.location AS station_location,
                board.id AS board_id,
                board.Name AS board_name,
                tables.id AS table_id,
                tables.name AS table_name,
                sensor.id AS sensor_id,
                sensor.Name AS sensor_name,
                sensor.unit_measurement AS sensor_unit_measurement,
                parameter.id AS parameter_id,
                parameter.measurement AS parameter_measurement,
                parameter.dataTime AS parameter_dataTime
            FROM 
                station
            INNER JOIN 
                station_board ON station.id = station_board.id_station
            INNER JOIN 
                board ON station_board.id_board = board.id
            INNER JOIN 
                tables ON board.id = tables.id_board
            INNER JOIN 
                sensor_variable ON tables.id = sensor_variable.id_table
            INNER JOIN 
                sensor ON sensor_variable.id_sensor = sensor.id
            LEFT JOIN 
                parameter ON sensor.id = parameter.id_sensor AND station.id = parameter.id_station
            WHERE 
                station.id_user = :user_id
        ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $response = [];
        foreach ($results as $row) {
            $station_id = $row['station_id'];
            $board_id = $row['board_id'];
            $table_id = $row['table_id'];

            // Estructura la respuesta para que sea organizada por estación, tablero y tabla
            if (!isset($response[$station_id])) {
                $response[$station_id] = [
                    'station_name' => $row['station_name'],
                    'station_description' => $row['station_description'],
                    'station_location' => $row['station_location'],
                    'boards' => []
                ];
            }

            if (!isset($response[$station_id]['boards'][$board_id])) {
                $response[$station_id]['boards'][$board_id] = [
                    'board_name' => $row['board_name'],
                    'tables' => []
                ];
            }

            if (!isset($response[$station_id]['boards'][$board_id]['tables'][$table_id])) {
                $response[$station_id]['boards'][$board_id]['tables'][$table_id] = [
                    'table_name' => $row['table_name'],
                    'sensors' => []
                ];
            }

            $sensor_data = [
                'sensor_id' => $row['sensor_id'],
                'sensor_name' => $row['sensor_name'],
                'sensor_unit_measurement' => $row['sensor_unit_measurement']
            ];

            // Añadir los parámetros si existen
            if (isset($row['parameter_id'])) {
                $sensor_data['parameter'] = [
                    'parameter_id' => $row['parameter_id'],
                    'parameter_measurement' => $row['parameter_measurement'],
                    'parameter_dataTime' => $row['parameter_dataTime']
                ];
            }

            $response[$station_id]['boards'][$board_id]['tables'][$table_id]['sensors'][] = $sensor_data;
        }

        return ['data' => array_values($response)];
    } catch (Exception $e) {
        return ['error' => 'Error al procesar la solicitud: ' . $e->getMessage()];
    }
}
?>
