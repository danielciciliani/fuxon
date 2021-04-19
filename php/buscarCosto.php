<?php
    //conexion
    include_once '../php/conexion1.php';
    $conexionPDO= new PDO("mysql:host=$servidor;dbname=$bd;charset=UTF8",$usuario,$clave);
    session_start();
    
    if (empty($_SESSION['IDSesion'])) {
        echo "Debe iniciar Sesion";
        die();
    }
$costo = 0;
    //query
        $sql="SELECT * FROM Costo";
        

    $ejecucionSQL= $conexionPDO->prepare($sql); 
    $ejecucionSQL ->execute();

    while($filaPDO=$ejecucionSQL->fetch(PDO::FETCH_ASSOC)){
        $costo = $filaPDO['Costo'];
    }
    echo json_encode($costo);

$conexionPDO = null;
$sql = null;

die();
?>