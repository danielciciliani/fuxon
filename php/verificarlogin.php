<?php
session_start();
//incluye el archivo de configuracion con los datos para la conexion
include_once '../php/conexion1.php';
//crea el objeto y guarda la conexion en la variable conexionPDO
$conexionPDO= new PDO("mysql:host=$servidor;dbname=$bd;charset=UTF8",$usuario,$clave);


$Pass = sha1($_POST['Clave']);
$Correo= $_POST['Correo'];
$resultado="1";

$sql1 = "select * from DATOSUSUARIOS where CorreoDatoUsuario = '$Correo' and ClaveDatoUsuario = '$Pass' ";
$ejecucionSQL1= $conexionPDO->prepare($sql1); 
$ejecucionSQL1 ->execute();
    while($filaPDO1=$ejecucionSQL1->fetch(PDO::FETCH_ASSOC)){
    	$_SESSION['IDSesion'] = $filaPDO1['ID'];
		$resultado="0";
 }

echo $resultado;    
$conexionPDO = null;
$sql = null;
?>
