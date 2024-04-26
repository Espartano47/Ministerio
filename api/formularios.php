<?php
  require_once('../include/load.php');
  $all_formulario = find_all_by_table('cabecera_participacion');
  echo json_encode($all_formulario);
