<?php
include_once('../include/load.php'); 

// Establecer los encabezados CORS si es necesario
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Verificar si se ha subido un archivo
if (isset($_FILES['imagen'])) {
    $id_usuario = $_POST['id'];
    $nombre = $_POST['name'];
    // Detalles del archivo subido
    $file_name = $_FILES['imagen']['name'];
    $file_size = $_FILES['imagen']['size'];
    $file_tmp = $_FILES['imagen']['tmp_name'];
    $file_type = $_FILES['imagen']['type'];

    
    // Extensión del archivo
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $new_file_name = $nombre . '_' . $id_usuario . '.' . $file_ext;
    
    // Extensiones permitidas
    $allowed_exts = array("gif", "jpeg", "jpg", "png");

    // Ruta donde se guardará el archivo
    $upload_dir = "../uploads/";
    $upload_path = $upload_dir . $new_file_name;

    // Verificar si la extensión es válida
    if (in_array($file_ext, $allowed_exts)) {
        // Verificar si el archivo se subió correctamente
        if ($file_size > 0 && move_uploaded_file($file_tmp, $upload_path)) {
            $query = "UPDATE miembros 
                  SET imagen = '{$new_file_name}'
                  WHERE id = {$id_usuario}";
            if ($db->query($query)) {
                $success = true;
                $message = 'Operación exitosa: Servidor editado con éxito.'.$file_name;
            } else {
                $message = 'Hubo un error al editar el servidor.';
            }
            // Devolver una respuesta JSON indicando la ruta donde se guardó la imagen
            echo json_encode(["message" => "La imagen se guardó correctamente", "ruta" => $upload_dir . $file_name]);
        } else {
            echo json_encode(["error" => "Error al subir el archivo"]);
        }
    } else {
        echo json_encode(["error" => "Tipo de archivo no permitido"]);
    }
} else {
    echo json_encode(["error" => "No se recibió ningún archivo"]);
}
