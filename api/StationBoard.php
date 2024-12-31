<?php

class StationBoard {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para asociar una estación a un tablero
    public function createStationBoard($boardId, $stationId) {
        $query = "INSERT INTO station_board (id_board, id_station) VALUES (:boardId, :stationId)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":boardId", $boardId);
        $stmt->bindParam(":stationId", $stationId);

        if ($stmt->execute()) {
            return ["success" => "Station successfully associated with board", "station_board_id" => $this->conn->lastInsertId()];
        } else {
            return ["error" => "Failed to associate station with board"];
        }
    }

    // Método para obtener estaciones asociadas a un tablero
    public function getStationsByBoard($boardId) {
        $query = "SELECT * FROM station_board WHERE id_board = :boardId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":boardId", $boardId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
