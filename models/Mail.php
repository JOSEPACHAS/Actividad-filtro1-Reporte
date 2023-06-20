<?php
//Load Composer's autoloader
require '../vendor/autoload.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//Create an instance; passing `true` enables exceptions

function enviarCorreo($destino, $asunto, $mensaje){
  $mail = new PHPMailer(true);
  
  try {
      //Server settings
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'jesusraulps@gmail.com';                     //SMTP username
      $mail->Password   = 'ffrpmpixkmbrmjwx';   
      $mail->CharSet    = 'utf-8';                            //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
      //Recipients
      $mail->setFrom('jesusraulps@gmail.com', 'Area de sistemas');
      $mail->addAddress($destino);               //Name is optional
  
  
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $asunto;
      $mail->Body    = $mensaje;
      $mail->AltBody = 'El mensaje requiere soporte html';
  
      $mail->send();
      // echo json_encode(["status" => true]);
  } catch (Exception $e) {
    // echo json_encode(["status" => false]);
  }

}
