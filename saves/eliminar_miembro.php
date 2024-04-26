<?php
// Especificar que la respuesta será JSON
header('Content-Type: application/json');

// Incluir archivos necesarios para la base de datos y otras funciones
require_once('../include/load.php');

$inputData = file_get_contents('php://input');
// Decodifica el JSON a un arreglo asociativo
$data = json_decode($inputData, true);

// Recupera el ID del servidor enviado desde la solicitud POST
$miembro_id = isset($data['id']) ? remove_junk($db->escape($data['id'])) : '';
$message = 'Hubo un error al eliminar el servidor 2.';
// Variables de éxito y mensaje
$success = false;
$message = '';

// Verifica si se ha proporcionado un ID de servidor válido
if ($miembro_id) {
    // Realiza la operación de eliminación en la base de datos
    $query = "DELETE FROM miembros WHERE id = '{$miembro_id}'";

    // Ejecuta la consulta y verifica si fue exitosa
    if ($db->query($query)) {
        $success = true;
        $message = 'Operación exitosa: Servidor eliminado con éxito.';
    } else {
        $message = 'Hubo un error al eliminar el servidor 2.';
    }
} else {
    $message = 'ID de servidor no proporcionado o inválido.';
}

// Devuelve la respuesta JSON
echo json_encode(['success' => $success, 'message' => $message]);

