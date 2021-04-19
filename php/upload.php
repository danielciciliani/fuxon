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
        $sql="SELECT max(IDImagen) as max FROM IMAGENES";
        $ejecucionSQL= $conexionPDO->prepare($sql); 
        $ejecucionSQL ->execute();
    while($filaPDO=$ejecucionSQL->fetch(PDO::FETCH_ASSOC)){
       $lastID= $filaPDO['max']+1;
    }
    //directorio donde se guarda el archivo
    $directorio= "../images/1/";
    
    
    $nom="IMG".$lastID;
        
    if(isset($_FILES['Archivo'])){

        $nombre = $_FILES['Archivo']['name'];
        $tamaño =$_FILES['Archivo']['size'];
        $nombretmp =$_FILES['Archivo']['tmp_name'];
        $tipo=$_FILES['Archivo']['type'];
        $ext1=explode('.',$nombre);
        $ext=strtolower(end($ext1));
        $extpermitidas= array("jpeg","jpg","png");
        
        if(in_array($ext,$extpermitidas)=== false){
           echo "Tipo de archivo no valido";
           die();
        }
        
        if($tamaño > 1000000){
           echo "El tamaño del archivo supera el máximo permitido (1Mb)";
           die();
        }
        $nom=$nom.".".$ext;
        $directorio=$directorio.$nom;
        
    
        if (move_uploaded_file($nombretmp,$directorio)){
            $imagen="1/".$nom;
             $sql= "INSERT INTO IMAGENES (Imagen,OrdenImagen) VALUES('$imagen' , '0' )";
            $ejecucionSQL= $conexionPDO->prepare($sql); 
            if ($ejecucionSQL ->execute()){
                echo "Archivo subido correctamente";
            die();
            }else{
                echo "Error, no se pudo cargar a la base de datos";
            }
            
        }else{
            echo "Error, no se pudo subir el archivo";
        }
     }

$conexionPDO = null;
$sql = null;

die();
       

    

?>
