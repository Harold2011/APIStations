<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar un nuevo usuario
    public function register($name, $email, $password, $roleId) {
        // Verificar si el email ya existe
        $query = "SELECT id FROM Users WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Si el email ya existe, devolver error
            return ["error" => "Email already exists"];
        }

        // Encriptar la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insertar el nuevo usuario
        $query = "INSERT INTO Users (Name, Email, Password, id_role) VALUES (:name, :email, :password, :roleId)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->bindParam(":roleId", $roleId);

        if ($stmt->execute()) {
            // Si la inserción fue exitosa
            return ["success" => "User registered successfully"];
        } else {
            // En caso de error en la inserción
            return ["error" => "Failed to register user"];
        }
    }

    // Método para autenticar el login
    public function login($email, $password) {
        // Buscar el usuario por email
        $query = "SELECT id, Name, Email, Password, id_role FROM Users WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);

        if (!$stmt->execute()) {
            return ["error" => "Database query failed"];
        }

        if ($stmt->rowCount() === 0) {
            return ["error" => "No user found with the provided email"];
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar la contraseña
        if (!password_verify($password, $user['Password'])) {
            return ["error" => "Invalid password"];
        }

        // Si la contraseña es válida, eliminarla de los datos del usuario antes de responder
        unset($user['Password']);
        return [
            "success" => "Login successful",
            "user" => $user
        ];
    }

}
