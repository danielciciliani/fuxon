<?php 

include_once '../php/conexion1.php';
    $conexionPDO= new PDO("mysql:host=$servidor;dbname=$bd;charset=UTF8",$usuario,$clave);

$Provincia = $_POST['Provincia'];
$IdProvincia = 0;
 //query
    $sql="SELECT * FROM LOCALIDADES WHERE IdProvinciaLocalidad='$Provincia'";
        

    $ejecucionSQL= $conexionPDO->prepare($sql); 
    $ejecucionSQL ->execute();

    $Datos= array();
    while($filaPDO=$ejecucionSQL->fetch(PDO::FETCH_ASSOC)){
        array_push($Datos,ucwords(strtolower($filaPDO['NombreLocalidad'])));
    }
    echo json_encode($Datos);

$conexionPDO = null;
$sql = null;

die();

?>