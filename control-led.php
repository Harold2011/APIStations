<?php
// Iniciar la sesión para almacenar el estado del LED
session_start();

// Verificar si la solicitud es POST para controlar el LED
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Guardar el estado del LED en la sesión
        if ($action === 'ON' || $action === 'OFF') {
            $_SESSION['led_status'] = $action;
            echo "LED $action";
        } else {
            echo "Acción no válida";
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Responder con el estado actual del LED
    if (isset($_SESSION['led_status'])) {
        echo $_SESSION['led_status'];
    } else {
        echo "OFF"; // Estado por defecto si no hay sesión
    }
} else {
    echo "Método no soportado";
}
?>
