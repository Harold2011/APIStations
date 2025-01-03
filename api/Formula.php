<?php

class Formulas {
    private $conn;
    private $table_name = "formulas";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para obtener todas las fórmulas
    public function getFormulas() {
        $query = "SELECT name, formula FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return ["error" => "Failed to fetch formulas"];
        }
    }

    // Método para crear una nueva fórmula
    public function createFormula($name, $formula) {
        $query = "INSERT INTO " . $this->table_name . " (name, formula) VALUES (:name, :formula)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":formula", $formula);

        if ($stmt->execute()) {
            return ["success" => "Formula created successfully"];
        } else {
            return ["error" => "Failed to create formula"];
        }
    }
}
