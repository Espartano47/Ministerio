<?php include_once('include/load.php'); 

$req_fields = array('username','password' );
validate_fields($req_fields);
$username = remove_junk($_POST['username']);
$password = remove_junk($_POST['password']);

  if(empty($errors)){

    $user = authenticate_v2($username, $password);
    echo $user;
    $user_id = authenticate_v2($username, $password);
if ($user_id > 0) {
    // Autenticación exitosa, el usuario está identificado por $user_id
    // Continuar con el resto de tu lógica, como crear la sesión, redirigir, etc.
    $session->login($user_id);
    updateLastLogIn($user_id);

    if ($user_info['user_level'] === '1') {
        // Redirigir según el nivel de usuario
        $session->msg("s", "Hola ".$user_info['username'].", Bienvenido.");
        redirect(SITE_URL.'admin.php', false);
    } elseif ($user_info['user_level'] === '2') {
        $session->msg("s", "Hola ".$user_info['username'].", Bienvenido.");
        redirect(SITE_URL.'special.php', false);
    } else {
        $session->msg("s", "Hola ".$user_info['username'].", Bienvenido.");
        redirect(SITE_URL.'home.php', false);
    }
} else {
    // Autenticación fallida
    if ($user_id === -1) {
        $session->msg("d", "Lo siento, Nombre de usuario/Contraseña incorrectos.");
    } elseif ($user_id === -2) {
        $session->msg("d", "Lo siento, el usuario no está activo.");
    } else {
        $session->msg("d", "Error desconocido durante la autenticación.");
    }
    redirect(SITE_URL.'index.php', false);
}

  } else {

     $session->msg("d", $errors);
     redirect(SITE_URL.'login_v2.php',false);
  }
