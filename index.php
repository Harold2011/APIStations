<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once "api/APIHandler.php"; // Asegúrate de que esté apuntando correctamente al archivo APIHandler.php

// Leer el endpoint de la solicitud
$endpoint = isset($_GET['endpoint']) ? $_GET['endpoint'] : null;

// Verificar si el endpoint está presente
if ($endpoint) {
    // Crear instancia del manejador de API
    $apiHandler = new APIHandler();
    
    // Manejar la solicitud
    $apiHandler->handleRequest($endpoint);
} else {
    // Responder con error si no se especifica un endpoint
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(["error" => "No endpoint specified"], JSON_PRETTY_PRINT);
}