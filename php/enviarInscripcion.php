<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$nombre = $_POST['NombreContacto'];
$telefono = $_POST['TelefonoContacto'];
$email = $_POST['MailContacto'];
$fecha = $_POST['FechaReunion'];

//Envío de correos

$bad = array("content-type","bcc:","to:","cc:","href");


//Correo a Empresa
$email_user = "administracion@fuxon.com.ar";
$email_password = "4dm1n1str4c1on99";
$the_subject = utf8_decode("Nueva Inscripción a reunión informativa");
$the_title = utf8_decode("Nueva Inscripción a reunión informativa");
$address_to = 'info@fuxon.com.ar';
$from_name = "Inscripciones Fuxon";
$cc_to1 = str_replace($bad,"","danielciciliani@gmail.com");
$cc_to2 = str_replace($bad,"","lucia.fernandez@fuxon.com.ar");


$phpmailer = new PHPMailer();

// ---------- datos de la cuenta de Gmail -------------------------------
$phpmailer->Username = $email_user;
$phpmailer->Password = $email_password; 
//-----------------------------------------------------------------------
// $phpmailer->SMTPDebug = 1;
//$phpmailer->SMTPSecure = 'ssl';
$phpmailer->Host = 'localhost';
$phpmailer->SMTPAuth = false;
$phpmailer->SMTPAutoTLS = false; 
$phpmailer->Port = 25; 


//$phpmailer->IsSMTP(); // use SMTP


$phpmailer->setFrom($phpmailer->Username,$from_name);
$phpmailer->AddAddress($address_to); // recipients email
$phpmailer->addCC($cc_to1);
$phpmailer->addCC($cc_to2);



$phpmailer->Subject = $the_subject; 
$phpmailer->Body .="<h1 style='color:#ff5500'>".$the_title."</h1>";
$phpmailer->Body .= "<p>Nombre: ".utf8_decode(str_replace($bad,"",$nombre))."</p>";
$phpmailer->Body .= "<p>Mail: ".utf8_decode(str_replace($bad,"",$email))."</p>";
$phpmailer->Body .= "<p>".utf8_decode("Teléfono: ").utf8_decode(str_replace($bad,"",$telefono))."</p>";
$phpmailer->Body .= "<p>".utf8_decode("Fecha reunión: ").utf8_decode(str_replace($bad,"",$fecha))."</p>";
$phpmailer->IsHTML(true);

if($phpmailer->Send()){
	 echo "Gracias por inscribirse a la siguiente reunión";
} else{
	 echo "No pudo enviarse la inscripción";
}
?>