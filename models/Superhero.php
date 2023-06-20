<?php

require 'Conexion.php';

class Superhero extends Conexion{

  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function listByPublisherAndAlignment($data=[]){
    try{

      $consulta = $this->conexion->prepare("CALL spu_superhero_list_publisher_alignment(?,?)");
      $consulta->execute(
        array(
          $data['publisher_id'],
          $data['alignment_id']
        )
      );

      return $consulta->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e){
      die($e->getMessage());
    }
  }


}

?>