<?php

class Board {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createBoard($name, $id_user) {
        $query = "INSERT INTO board (name, id_user) VALUES (:name, :id_user)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":id_user", $id_user);

        if ($stmt->execute()) {
            return ["success" => "Board created successfully", "board_id" => $this->conn->lastInsertId()];
        } else {
            return ["error" => "Failed to create board"];
        }
    }

    public function getBoards() {
        $query = "SELECT * FROM Boards";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
