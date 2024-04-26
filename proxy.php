<?php

$cedula = str_replace("-", "", $_GET['cedula']);
// Construye el token concatenando "espartano" con la cédula
$token = 'espartano' . $cedula;

// Calcula el hash SHA1 del token
$hashedToken = sha1($token);
// URL del API
$url = 'https://agentesdelcambio.com.do/api/get-data-by-cedula/' . $_GET['cedula'] . '/' . $hashedToken;

// Realizar la solicitud al API
$response = file_get_contents($url);

// Devolver la respuesta
header('Content-Type: application/json');
echo $response;
