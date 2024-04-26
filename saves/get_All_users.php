<?php
// Incluir el archivo que contiene las funciones para interactuar con la base de datos
require_once('include/load.php');

// Consultar la base de datos para obtener todos los usuarios
$all_users = find_all_user();

// Crear un array para almacenar los datos de los usuarios
$users_array = array();

// Iterar sobre cada usuario y agregar sus datos al array
foreach ($all_users as $user) {
    $user_data = array(
        'id' => $user['id'],
        'nombre' => $user['name'],
        'usuario' => $user['username'],
        'rol' => ucwords($user['group_name']), // Convertir el nombre del rol a mayúsculas
        'estatus' => ($user['status'] == '1') ? 'Activo' : 'Inactivo', // Convertir el estatus a texto
        'ultimo_login' => read_date($user['last_login']) // Formatear la fecha del último inicio de sesión
    );

    // Agregar los datos del usuario al array de usuarios
    $users_array[] = $user_data;
}

// Devolver los datos de todos los usuarios en formato JSON
echo json_encode($users_array);
