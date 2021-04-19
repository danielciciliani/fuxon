<?php
session_start();
session_unset(); 
session_destroy(); 
header("Location: http://www.fuxon.com.ar/Admin.php");
?>

