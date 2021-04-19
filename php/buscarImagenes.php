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
        $sql="SELECT * FROM IMAGENES order by OrdenImagen ASC , IDImagen DESC";
        

    $ejecucionSQL= $conexionPDO->prepare($sql); 
    $ejecucionSQL ->execute();

    $imagenes= array();
    while($filaPDO=$ejecucionSQL->fetch(PDO::FETCH_ASSOC)){
        array_push($imagenes, $filaPDO['Imagen'] );
        array_push($imagenes, $filaPDO['IDImagen'] );
        array_push($imagenes, $filaPDO['Titulo'] );
        array_push($imagenes, $filaPDO['Ubicacion'] );
    }
    echo json_encode($imagenes);

$conexionPDO = null;
$sql = null;

die();
?>