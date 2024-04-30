<?php
// Especificar que la respuesta será JSON
header('Content-Type: application/json');

// Incluir archivos necesarios para la base de datos y otras funciones
require_once('../include/load.php');


    // Recupera los valores enviados desde el formulario
    $miembro_id = isset($_POST['inputId']) ? remove_junk($db->escape($_POST['inputId'])) : '';
    $cedula = isset($_POST['edit_cedula']) ? remove_junk($db->escape($_POST['edit_cedula'])) : '';
    $nombre = isset($_POST['edit_nombre']) ? remove_junk($db->escape($_POST['edit_nombre'])) : '';
    $apellido = isset($_POST['edit_apellido']) ? remove_junk($db->escape($_POST['edit_apellido'])) : '';
    $telefono = isset($_POST['edit_telefono']) ? remove_junk($db->escape($_POST['edit_telefono'])) : '';
    $celular = isset($_POST['edit_celular']) ? remove_junk($db->escape($_POST['edit_celular'])) : '';
    $correo = isset($_POST['edit_correo']) ? remove_junk($db->escape($_POST['edit_correo'])) : '';
    $ocupacion = isset($_POST['edit_ocupacion']) ? remove_junk($db->escape($_POST['edit_ocupacion'])) : '';
    $provincia = isset($_POST['edit_provincia']) ? remove_junk($db->escape($_POST['edit_provincia'])) : '';
    $municipio = isset($_POST['edit_municipio']) ? remove_junk($db->escape($_POST['edit_municipio'])) : '';
    $direccion = isset($_POST['edit_direccion']) ? remove_junk($db->escape($_POST['edit_direccion'])) : '';
    $fechanacimiento = isset($_POST['edit_fechanacimiento']) ? remove_junk($db->escape($_POST['edit_fechanacimiento'])) : '';
    $sexo = isset($_POST['edit_sexo']) ? remove_junk($db->escape($_POST['edit_sexo'])) : '';

    // Variables de éxito y mensaje
    $success = false;
    $message = '';

    // Verifica si se ha proporcionado un ID de servidor válido
    if ($miembro_id) {
        // Realiza la operación de actualización en la base de datos
        $query = "UPDATE miembros 
                  SET nombre = '{$nombre}', apellido = '{$apellido}', telefono = '{$telefono}', correo = '{$correo}', cedula = '{$cedula}', ocupacion = '{$ocupacion}', provincia = '{$provincia}', municipio = '{$municipio}', direccion = '{$direccion}', sexo = '{$sexo}', celular = '{$celular}',fecha_nacimiento = '{$fechanacimiento}'
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
