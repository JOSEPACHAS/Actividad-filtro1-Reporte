<?php

require '../tools/helpers.php';
require '../models/Superhero.php';

$superhero = new Superhero();

if(isset($_GET['operacion'])){

  if($_GET['operacion'] == 'listByPublisherAndAlignment'){

    renderJSON($superhero->listByPublisherAndAlignment(
      [
        'publisher_id' => $_GET['publisher_id'],
        'alignment_id' => $_GET['alignment_id']
      ]));
    
  }

}



?>