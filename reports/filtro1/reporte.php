<?php

require '../../vendor/autoload.php';
require '../../models/Superhero.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try{

  $superhero = new Superhero();

  $datos = $superhero->listByPublisherAndAlignment(
    [
      "publisher_id" => $_GET["publisher_id"],
      "alignment_id" => $_GET["alignment_id"]
    ]);
  $titulo = $_GET['titulo'];
  $content = "";
  ob_start();
  include('../estilos.html');
  include('./datos.php');

  $content .= ob_get_clean();
  
  $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', array(15,5,15,5));
  $html2pdf->writeHTML($content);
  $html2pdf->output('reporte.pdf');

} catch (Html2PdfException $error){
  $formatter = new ExceptionFormatter($error);
  echo $formatter->getHtmlMessage();
}
?>