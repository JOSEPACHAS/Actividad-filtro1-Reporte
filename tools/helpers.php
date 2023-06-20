<?php

//Función renderiza en el VIEW un JSON si el origen NO esta vacio

function renderJSON($data){
  if($data){
    echo json_encode($data);
  }
}

?>
