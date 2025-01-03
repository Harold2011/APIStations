<?php

class Tables {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createTable($name, $boardId, $id_station) {
        $query = "INSERT INTO tables (name, id_board, id_station) VALUES (:name, :boardId, :id_station)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":boardId", $boardId);
        $stmt->bindParam(":id_station", $id_station);

        if ($stmt->execute()) {
            return ["success" => "Table created successfully", "table_id" => $this->conn->lastInsertId()];
        } else {
            return ["error" => "Failed to create table"];
        }
    }

    public function getTablesByBoard($boardId) {
        $query = "SELECT * FROM tables WHERE id_board = :boardId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":boardId", $boardId);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTablesWithRelations() {
        $query = "
            SELECT 
                t.id AS table_id, 
                t.name AS table_name, 
                b.id AS board_id, 
                b.name AS board_name, 
                s.id AS station_id, 
                s.name AS station_name
            FROM 
                tables t
            INNER JOIN 
                board b ON t.id_board = b.id
            INNER JOIN 
                station s ON t.id_station = s.id
        ";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
