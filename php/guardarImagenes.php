<?php
include_once '../php/conexion1.php';
$conexionPDO= new PDO("mysql:host=$servidor;dbname=$bd;charset=UTF8",$usuario,$clave);

session_start();
    if (empty($_SESSION['IDSesion'])) {
        echo "Debe iniciar Sesion";
        die();
    }

$img= $_POST['Imagenes'];
    $ImagenesA = json_decode($img,true);
    
 for($x=0;$x<count($ImagenesA);$x++){
    $Imagenes = $ImagenesA[$x];
    if($Imagenes[0]!="borrar"){
        if($Imagenes[1]!="borrar"){
            $sql1="UPDATE IMAGENES SET OrdenImagen='$x' , Titulo='$Imagenes[2]', Ubicacion='$Imagenes[3]' WHERE IDImagen='$Imagenes[0]' ";
            $ejecucionSQL1= $conexionPDO->prepare($sql1); 
            if ($ejecucionSQL1 ->execute()){}
                else{echo "Error al guardar datos";
                die();
                }
            } else{

                $sql2="SELECT Imagen FROM IMAGENES WHERE IDImagen='$Imagenes[0]' ";
                $ejecucionSQL2= $conexionPDO->prepare($sql2); 
                $ejecucionSQL2 ->execute();
              while($filaPDO2=$ejecucionSQL2->fetch(PDO::FETCH_ASSOC)){
                 unlink('../images/'.$filaPDO2['Imagen']);
              }
                $sql1="DELETE FROM IMAGENES WHERE IDImagen='$Imagenes[0]' ";
                $ejecucionSQL1= $conexionPDO->prepare($sql1); 
                if ($ejecucionSQL1 ->execute()){}
                  else{echo "Error al guardar datos";
                  die();
                  }
                 
            }
       } else{

       }
   }
echo "Datos guardados correctamente";

$conexionPDO = null;
$sql = null;
$sql1 = null;

die();
?>