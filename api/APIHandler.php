<?php

require_once "Database.php";
require_once "Station.php";
require_once "User.php";
require_once "Tables.php";
require_once 'Board.php';
require_once 'StationBoard.php'; // Incluir la clase StationBoard
require_once 'TableSensor.php'; // Incluir la clase TableSensor
require_once "GetUserBoards.php";

class APIHandler {
    private $db;
    private $station;
    private $user;
    private $board;
    private $table;
    private $stationBoard;
    private $tableSensor; // Nueva propiedad

    public function __construct() {
        // Conectar con la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        $this->station = new Station($this->db);
        $this->user = new User($this->db);
        $this->board = new Board($this->db);
        $this->table = new Tables($this->db);
        $this->stationBoard = new StationBoard($this->db); // Instanciar la clase StationBoard
        $this->tableSensor = new TableSensor($this->db); // Instanciar la clase TableSensor
    }

    public function handleRequest($endpoint) {
        switch ($endpoint) {
            case "stations":
                $this->respond($this->station->getStationData());
                break;

            case "register":
                $this->handleRegister();
                break;

            case "login":
                $this->handleLogin();
                break;

            case "board":
                $this->handleCreateBoard();
                break;

            case "table":
                $this->handleCreateTable();
                break;

            case "station_board": // Endpoint para la tabla station_board
                $this->handleStationBoard();
                break;

            case "table_sensor": // Endpoint para la nueva tabla table_sensor
                $this->handleTableSensor();
                break;

            case "user_boards": // Nuevo endpoint
                $this->handleUserBoards();
                break;

            default:
                $this->respond(["error" => "Invalid endpoint"], 400);
                break;
        }
    }

    private function handleTableSensor() {
        // Obtener la acción deseada, ya sea crear una asociación o consultar
        $data = json_decode(file_get_contents("php://input"), true);

        // Verificar si la acción es la creación de una nueva asociación
        if (isset($data['action']) && $data['action'] === 'create') {
            if (!isset($data['tableId'], $data['sensorId'])) {
                $this->respond(["error" => "Invalid input"], 400);
                return;
            }

            $result = $this->tableSensor->createTableSensor($data['tableId'], $data['sensorId']);
            $this->respond($result);
        }
        // Consultar los sensores asociados a una tabla
        else if (isset($data['tableId'])) {
            $result = $this->tableSensor->getSensorsByTable($data['tableId']);
            $this->respond($result);
        } else {
            $this->respond(["error" => "Invalid input"], 400);
        }
    }

    private function handleCreateBoard() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['name'])) {
            $this->respond(["error" => "Invalid input"], 400);
            return;
        }

        $result = $this->board->createBoard($data['name']);
        $this->respond($result);
    }

    private function handleCreateTable() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['name'], $data['id_board'])) {
            $this->respond(["error" => "Invalid input"], 400);
            return;
        }

        $result = $this->table->createTable($data['name'], $data['id_board']);
        $this->respond($result);
    }

    private function handleRegister() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['name'], $data['email'], $data['password'], $data['role_id'])) {
            $this->respond(["error" => "Invalid input"], 400);
            return;
        }

        $result = $this->user->register($data['name'], $data['email'], $data['password'], $data['role_id']);
        $this->respond($result);
    }

    private function handleLogin() {
        $data_raw = file_get_contents("php://input");
        error_log("Raw POST data: " . $data_raw);

        $data = json_decode($data_raw, true);
        error_log("Decoded data: " . print_r($data, true));

        if (!$data || !isset($data['email'], $data['password'])) {
            $this->respond([
                "error" => "Invalid input. Please provide valid JSON with 'email' and 'password'.",
                "raw_data" => $data_raw
            ], 400);
            return;
        }

        $result = $this->user->login(trim($data['email']), trim($data['password']));

        error_log("Login result: " . print_r($result, true));

        if (isset($result['error'])) {
            $this->respond($result, 401);
        } else {
            $this->respond($result);
        }
    }

    private function handleStationBoard() {
        // Obtener la acción deseada, ya sea crear una asociación o consultar
        $data = json_decode(file_get_contents("php://input"), true);

        // Verificar si la acción es la creación de una nueva asociación
        if (isset($data['action']) && $data['action'] === 'create') {
            if (!isset($data['boardId'], $data['stationId'])) {
                $this->respond(["error" => "Invalid input"], 400);
                return;
            }

            $result = $this->stationBoard->createStationBoard($data['boardId'], $data['stationId']);
            $this->respond($result);
        }
        // Consultar las estaciones asociadas a un tablero
        else if (isset($data['boardId'])) {
            $result = $this->stationBoard->getStationsByBoard($data['boardId']);
            $this->respond($result);
        } else {
            $this->respond(["error" => "Invalid input"], 400);
        }
    }
    
    // Cambiar el endpoint para aceptar una solicitud POST
    private function handleUserBoards() {
        // Verificar si el cuerpo de la solicitud contiene el parámetro user_id
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['user_id'])) {
            $this->respond(['error' => 'El parámetro user_id es obligatorio.'], 400);
            return;
        }

        $user_id = intval($data['user_id']); // Obtener el user_id del cuerpo JSON
        $result = getUserBoards($this->db, $user_id); // Llamada a la función que ejecuta la consulta

        // Devolver los resultados
        $this->respond($result);
    }


    private function respond($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}
