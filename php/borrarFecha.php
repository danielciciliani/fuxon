<?php
include_once '../php/conexion1.php';
$conexionPDO= new PDO("mysql:host=$servidor;dbname=$bd;charset=UTF8",$usuario,$clave);

session_start();
    if (empty($_SESSION['IDSesion'])) {
        echo "Debe iniciar Sesion";
        die();
    }

$idfecha= $_POST['IDFecha'];

$sql1= "DELETE FROM Fechas WHERE IDFecha='$idfecha'";

  $ejecucionSQL1= $conexionPDO->prepare($sql1); 
  if ($ejecucionSQL1 ->execute()){

  } else{
    echo "Error al guardar datos";
    die();
  }
        
echo "Datos guardados correctamente";

$conexionPDO = null;
$sql = null;
$sql1 = null;

die();
?>