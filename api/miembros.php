<?php
$time = microtime(true);

  require_once('../include/load.php');
  
  // Función para manejar las consultas y devolver resultados
  function handle_request($query) {
    //limpiar $result
    $result = null;
    switch ($query) {
      case 'miembros':
        $result = find_all($_GET['descripcion']);
        break;
      case 'miembrosv2':
        $result = find_all_miembros();
        break;
      case 'miembrosbycedula':
        $result = find_by_cedula('miembros',$_GET['id']);
        break;
      case 'miembrosbyid':
        $result = find_by_id('miembros',$_GET['id']);
        break;
      case 'municipios':
        $result = find_all_municipios($_GET['descripcion']);
        break;
    }
    return $result;
  }
  
  // Obtener el parámetro 'consulta' de la URL
  $query_param = isset($_GET['consulta']) ? $_GET['consulta'] : null;
  

  // Manejar la solicitud y obtener el resultado
  $response = handle_request($query_param);

  // Salida del resultado en formato JSON
  header('Content-Type: application/json');

  echo json_encode( $response, JSON_PRETTY_PRINT);
//  echo json_encode($response);

