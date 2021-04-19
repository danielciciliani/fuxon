<?php 
include_once '../php/conexion1.php';
    $conexionPDO= new PDO("mysql:host=$servidor;dbname=$bd;charset=UTF8",$usuario,$clave);

 //query
    $sql="SELECT * FROM PROVINCIAS order by NombreProvincia";
        

    $ejecucionSQL= $conexionPDO->prepare($sql); 
    $ejecucionSQL ->execute();

    $Datos= array();
    while($filaPDO=$ejecucionSQL->fetch(PDO::FETCH_ASSOC)){
        array_push($Datos,$filaPDO['NombreProvincia']);
		array_push($Datos,$filaPDO['IdProvincia']);
    }
    echo json_encode($Datos);

$conexionPDO = null;
$sql = null;

die();
?>