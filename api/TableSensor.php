<?php

class TableSensor {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para asociar un sensor a una tabla
    public function createTableSensor($tableId, $sensorId, $stationId) {
        $query = "INSERT INTO sensor_variable (id_table, id_sensor, id_station) VALUES (:tableId, :sensorId, :stationId)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tableId", $tableId);
        $stmt->bindParam(":sensorId", $sensorId);
        $stmt->bindParam(":stationId", $stationId);

        if ($stmt->execute()) {
            return ["success" => "Sensor successfully associated with table", "table_sensor_id" => $this->conn->lastInsertId()];
        } else {
            return ["error" => "Failed to associate sensor with table"];
        }
    }

    // Método para obtener los sensores asociados a una tabla
    public function getSensorsByTable($tableId) {
        $query = "SELECT * FROM sensor_variable WHERE id_table = :tableId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tableId", $tableId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
