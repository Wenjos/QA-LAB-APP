<?php
// Inicia sesión o incluye la conexión a la base de datos y otros archivos necesarios
require_once('../config/load.php');

// Verifica que el usuario esté autenticado (opcional según tu configuración)
if (!$session->isUserLoggedIn(true)) { 
    http_response_code(403); // Forbidden
    echo json_encode(["status" => "error", "message" => "No tienes permiso para realizar esta acción."]);
    exit;
}

// Obtén los datos de la solicitud POST
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['tracking'])) {
    $tracking = $data['tracking'];
    
    // Marca la notificación como vista en la base de datos
    $sql = "UPDATE test_reviewed SET Viewed = 1 WHERE Tracking = '{$tracking}'";
    $result = $db->query($sql);

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Notificación marcada como vista."]);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(["status" => "error", "message" => "No se pudo actualizar la notificación."]);
    }
} else {
    http_response_code(400); // Bad Request
    echo json_encode(["status" => "error", "message" => "Solicitud incorrecta."]);
}
?>