<?php
// Especificar que la respuesta será JSON
header('Content-Type: application/json');

// Incluir archivos necesarios para la base de datos y otras funciones
require_once('../include/load.php');

// Verifica si se recibió el formulario mediante la clave "add_server"

    // Recupera los valores enviados desde el formulario
    $cedula = isset($_POST['cedula']) ? remove_junk($db->escape($_POST['cedula'])) : '';
    $nombre = isset($_POST['nombre']) ? remove_junk($db->escape($_POST['nombre'])) : '';
    $apellido = isset($_POST['apellido']) ? remove_junk($db->escape($_POST['apellido'])) : '';
    $telefono = isset($_POST['telefono']) ? remove_junk($db->escape($_POST['telefono'])) : '';
    $correo = isset($_POST['correo']) ? remove_junk($db->escape($_POST['correo'])) : '';
    $ocupacion = isset($_POST['ocupacion']) ? remove_junk($db->escape($_POST['ocupacion'])) : '';
    // $fecha_nacimiento = isset($_POST['nacimiento']) ? remove_junk($db->escape($_POST['nacimiento'])) : '';
    $sexo = isset($_POST['sexo']) ? remove_junk($db->escape($_POST['sexo'])) : '';
    $provincia = isset($_POST['provincia']) ? remove_junk($db->escape($_POST['provincia'])) : '';
    $municipio = isset($_POST['municipio']) ? remove_junk($db->escape($_POST['municipio'])) : '';
    $celular = isset($_POST['celular']) ? remove_junk($db->escape($_POST['celular'])) : '';
    $nacimiento = isset($_POST['fechanacimiento']) ? remove_junk($db->escape($_POST['fechanacimiento'])) : '';


    // Variables de éxito y mensaje
    $success = false;
    $message = '';

    // Realiza la operación de guardado en la base de datos
    $query = "INSERT INTO miembros (cedula, nombre,apellido,telefono,correo,ocupacion,sexo,provincia,celular,fecha_nacimiento)
              VALUES ('{$cedula}', '{$nombre}', '{$apellido}', '{$telefono}', '{$correo}', '{$ocupacion}', '{$sexo}', '{$provincia}', '{$celular}', '{$nacimiento}')";
    
    // Ejecuta la consulta y verifica si fue exitosa
    if ($db->query($query)) {
        $success = true;
        $message = 'Operación exitosa';
    } else {
        $message = 'Hubo un error al guardar el servidor';
    }

    // Devuelve la respuesta JSON
    echo json_encode(['success' => $success, 'message' => $message]);

