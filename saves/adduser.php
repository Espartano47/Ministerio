<?php
require_once('../include/load.php');
  if (isset($_POST['add_user'])) {

    $req_fields = array('nombre','level','departamento','codigo');
    validate_fields($req_fields);

    if (empty($errors)) {
     
      $name       = $_POST['nombre'];
      $codigo       = $_POST['codigo'];
      $departamento       = remove_junk($db->escape($_POST['departamento']));

      // Dividir el nombre en palabras
        $palabras = explode(" ", $name);

        // Obtener las dos primeras letras del primer nombre
        $primerNombre = $palabras[0];
        $dosPrimerasLetras = substr($primerNombre, 0, 2);

        // Obtener la última palabra del nombre
      $ultimaPalabra = end($palabras);

        // Concatenar las dos primeras letras del primer nombre con la última palabra
      $username = $dosPrimerasLetras . $ultimaPalabra;

      $password   = "Monday1";
      $user_level = (int)$db->escape($_POST['level']);
      $password = hash("sha512", $password);
      $query = "INSERT INTO users (";
      $query .="name,username,password,user_level,status,codigo,sfid,departamento";
      $query .=") VALUES (";
      $query .=" '{$name}', '{$username}', '{$password}', '{$user_level}','1','{$codigo}', '{$codigo}', '{$departamento}'";
      $query .=")";
      if ($db->query($query)) {
        //sucess
        $session->msg('s'," Cuenta de usuario ha sido creada");
        redirect(SITE_URL.'../Config.php', false);
      } else {
        //failed
        $session->msg('d',' No se pudo crear la cuenta.');
      }
    } else {
      $session->msg("d", $errors);
      redirect(SITE_URL.'../Config.php',false);
    }
  }