<?php
// Especificar que la respuesta será JSON
header('Content-Type: application/json');

// Incluir archivos necesarios para la base de datos y otras funciones
require_once('../include/load.php');


    // Recupera los valores enviados desde el formulario
    $miembro_id = isset($_POST['inputId']) ? remove_junk($db->escape($_POST['inputId'])) : '';
    $cedula = isset($_POST['cedula']) ? remove_junk($db->escape($_POST['cedula'])) : '';
    $nombre = isset($_POST['nombre']) ? remove_junk($db->escape($_POST['nombre'])) : '';
    $apellido = isset($_POST['apellido']) ? remove_junk($db->escape($_POST['apellido'])) : '';
    $telefono = isset($_POST['telefono']) ? remove_junk($db->escape($_POST['telefono'])) : '';
    $correo = isset($_POST['correo']) ? remove_junk($db->escape($_POST['correo'])) : '';
    $ocupacion = isset($_POST['ocupacion']) ? remove_junk($db->escape($_POST['ocupacion'])) : '';

    // Variables de éxito y mensaje
    $success = false;
    $message = '';

    // Verifica si se ha proporcionado un ID de servidor válido
    if ($miembro_id) {
        // Realiza la operación de actualización en la base de datos
        $query = "UPDATE miembros 
                  SET nombre = '{$nombre}', apellido = '{$apellido}', telefono = '{$telefono}', correo = '{$correo}', cedula = '{$cedula}', ocupacion = '{$ocupacion}'
                  WHERE id = '{$miembro_id}'";

        // Ejecuta la consulta y verifica si fue exitosa
        if ($db->query($query)) {
            $success = true;
            $message = 'Operación exitosa: Servidor editado con éxito.';
        } else {
            $message = 'Hubo un error al editar el servidor.';
        }
    } else {
        $message = 'ID de servidor no proporcionado o inválido.';
    }

    // Devuelve la respuesta JSON
    echo json_encode(['success' => $success, 'message' => $message]);
