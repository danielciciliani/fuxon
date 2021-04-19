<?php
    //conexion
    include_once '../php/conexion1.php';
    $conexionPDO= new PDO("mysql:host=$servidor;dbname=$bd;charset=UTF8",$usuario,$clave);
    session_start();
    
    if (empty($_SESSION['IDSesion'])) {
        echo "Debe iniciar Sesion";
        die();
    }

    //query
        $sql="SELECT * FROM Fechas";
        

    $ejecucionSQL= $conexionPDO->prepare($sql); 
    $ejecucionSQL ->execute();

    $fechas= array();
    while($filaPDO=$ejecucionSQL->fetch(PDO::FETCH_ASSOC)){
        array_push($fechas, $filaPDO['Fecha'] );
        array_push($fechas, $filaPDO['IDFecha'] );
    }
    echo json_encode($fechas);

$conexionPDO = null;
$sql = null;

die();
?>