<?php
//conexion
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

    include_once '../php/conexion1.php';
    $conexionPDO= new PDO("mysql:host=$servidor;dbname=$bd;charset=UTF8",$usuario,$clave);
   
    //Verifica el archivo subido
        
    if($_FILES['Archivo']['size']!=0){
        $nombre = $_FILES['Archivo']['name'];
        $tamaño =$_FILES['Archivo']['size'];
        $nombretmp =$_FILES['Archivo']['tmp_name'];
        $tipo=$_FILES['Archivo']['type'];
        $ext1=explode('.',$nombre);
        $ext=strtolower(end($ext1));
        $extpermitidas= array("jpeg","jpg","png","dwg","pdf");
        
        if(in_array($ext,$extpermitidas)=== false){
           echo "Error: Tipo de archivo no valido";
           die();
        }
        
        if($tamaño > 5000000){
           echo "Error: El tamaño del archivo supera el máximo permitido (5Mb)";
           die();
        }
        $nom="plano.".$ext;
        $directorio="../images/upload/".$nom;
        if (move_uploaded_file($nombretmp,$directorio)){
        
        }else{
            echo "Error: no se pudo subir el archivo";
            die();
        }
    }
$nombre_presupuesto = $_POST['NombrePresupuesto'];
$mail = $_POST['MailPresupuesto'];
$telefono = $_POST['TelefonoPresupuesto'];
$Relacion = $_POST['Relacion'];
$Tipo = $_POST['Tipo'];
$Provincia = $_POST['ProvinciaPresupuesto'];
$Localidad = $_POST['LocalidadPresupuesto'];
$Direccion = $_POST['Direccion'];
$m2 = floatval($_POST['m2']);


//query para buscar el costo
        $sql="SELECT Costo FROM Costo ";
        $ejecucionSQL= $conexionPDO->prepare($sql); 
        $ejecucionSQL ->execute();
    while($filaPDO=$ejecucionSQL->fetch(PDO::FETCH_ASSOC)){
       $precio= floatval($filaPDO['Costo']);
    }

//query para buscar el nombre de la Provincia
        $sql="SELECT NombreProvincia FROM PROVINCIAS WHERE IdProvincia =".$Provincia;
        $ejecucionSQL= $conexionPDO->prepare($sql); 
        $ejecucionSQL ->execute();
    while($filaPDO=$ejecucionSQL->fetch(PDO::FETCH_ASSOC)){
       $nombre_provincia= $filaPDO['NombreProvincia'];
    }


$preciototal = $precio * $m2;  
echo $preciototal;


$conexionPDO = null;
$sql = null;

// envía correo

//Envío de correos

$bad = array("content-type","bcc:","to:","cc:","href");

$email_user = "administracion@fuxon.com.ar";
$email_password = "4dm1n1str4c1on99";
$the_subject = utf8_decode("Nueva Solicitud de Presupuesto Fuxon");
$the_title = utf8_decode("Nueva Solicitud de Presupuesto Fuxon");
$address_to = 'info@fuxon.com.ar';
$from_name = "Presupuesto Fuxon";
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

$phpmailer->AddAttachment($directorio);

$phpmailer->Subject = $the_subject; 
$phpmailer->Body .="<h1 style='color:#ff5500'>".$the_title."</h1>";
$phpmailer->Body .= "<p>Nombre: ".utf8_decode(str_replace($bad,"",$nombre_presupuesto))."</p>";
$phpmailer->Body .= "<p>Mail: ".utf8_decode(str_replace($bad,"",$mail))."</p>";
$phpmailer->Body .= "<p>".utf8_decode("Teléfono: ").utf8_decode(str_replace($bad,"",$telefono))."</p>";
$phpmailer->Body .= "<p>".utf8_decode("Relación con la Obra: ").utf8_decode(str_replace($bad,"",$Relacion))."</p>";
$phpmailer->Body .= "<p>".utf8_decode("Tipo de Construcción: ").utf8_decode(str_replace($bad,"",$Tipo))."</p>";
$phpmailer->Body .= "<p>Provincia: ".utf8_decode(str_replace($bad,"",$nombre_provincia))."</p>";
$phpmailer->Body .= "<p>Localidad: ".utf8_decode(str_replace($bad,"",$Localidad))."</p>";
$phpmailer->Body .= "<p>".utf8_decode("Dirección de la Obra: ").utf8_decode(str_replace($bad,"",$Direccion))."</p>";
$phpmailer->Body .= "<p>m2 a Construir: ".utf8_decode(str_replace($bad,"",$m2))."</p>";
$phpmailer->Body .= "<p>COSTO TOTAL: ".utf8_decode(str_replace($bad,"",$preciototal))."</p>";

$phpmailer->IsHTML(true);

$phpmailer->Send();

die();
?>
