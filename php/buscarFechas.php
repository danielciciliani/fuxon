<?php
    //conexion
    include_once '../php/conexion1.php';
    $conexionPDO= new PDO("mysql:host=$servidor;dbname=$bd;charset=UTF8",$usuario,$clave);
    session_start();
    
    $origen = $_POST['Origen'];
    if($origen!=0){
    if (empty($_SESSION['IDSesion'])) {
        echo "Debe iniciar Sesion";
        die();
    }
    }

    //query
        $sql="SELECT * FROM Fechas";
        

    $ejecucionSQL= $conexionPDO->prepare($sql); 
    $ejecucionSQL ->execute();

    $fechas= array();
    while($filaPDO=$ejecucionSQL->fetch(PDO::FETCH_ASSOC)){
        $now = date('Y').'-'.date('m').'-'.date('d');
        $reunion_fecha = explode("T",$filaPDO['Fecha'])[0];
        if($now<=$reunion_fecha ){
            array_push($fechas, $filaPDO['Fecha'] );
            array_push($fechas, $filaPDO['IDFecha'] );
        }
    }
    echo json_encode($fechas);

$conexionPDO = null;
$sql = null;

die();
?>