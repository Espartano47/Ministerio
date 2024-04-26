<?php
  require_once('../include/load.php');
  // Checkin What level user has permission to view this page

  $delete_id = delete_by_id('participantes_form',(int)$participante['id']);
  if($delete_id){
      $session->msg("s","Categoría eliminada");

  } else {
      $session->msg("d","Eliminación falló");

  }