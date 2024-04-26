<?php
// Establecer los encabezados CORS si es necesario
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si se recibió la imagen en el formulario
    if(isset($_POST['imagen'])) {
        // Obtener los datos de la imagen en formato base64
        $imagenBase64 = $_POST['imagen'];
        
        
        // Decodificar la imagen base64 y obtener los datos binarios
        $imagenBinaria = base64_decode($imagenBase64);

        // Definir la ruta donde se guardará la imagen
        $rutaGuardar = "../uploads/fir_form";

        // Generar un nombre único para la imagen
        $nombreImagen = $_POST['codigo']. ".png"; // Se le agrega una extensión, en este caso .png

        //guardar en un archivo txt dato en base64
        $file = fopen("firma.txt", "w");
        fwrite($file, $imagenBinaria);
        fclose($file);
        $path = "../uploads/fir_form/$nombreImagen";
        //si la imagen ya existe sobreescribirla
        if (file_exists($path)) {
            unlink($path);
        }
        file_put_contents($path, $imagenBinaria);
        $data_uri = $imagenBase64;
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        file_put_contents($path, $decoded_image);

        // Guardar la imagen en el servidor
      
} else {
    // Si la solicitud no es de tipo POST
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(["message" => "Solo se permiten solicitudes POST"]);
}
}
