<?php

class Tables {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createTable($name, $boardId) {
        $query = "INSERT INTO tables (name, id_board) VALUES (:name, :boardId)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":boardId", $boardId);

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
    
}
