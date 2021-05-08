<?php
session_start();
?>
<!DOCTYPE html><html>
<head>		
	<link rel="stylesheet" href="./css/style.css">
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<link rel="shortcut icon" type="image/x-icon" href="imagenes/favicon1.ico?v=4">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
 	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body style="text-align: center;">
<div class="mainimage" style="height: 100vh">
    <div class="mainlogo" style="margin-top: 30vh"></div>

    <div class="logIn">
		<p class="ppIngresar">Ingresar a Administración</p>
		<input type="text" class="entradaLogin" placeholder="Correo" id="correologin">
		<input type="password" class="entradaLogin" placeholder="Clave" id="clavelogin" onkeypress="if (event.keyCode == 13) VerificarLogIn()">
		<div class="bot-env" onclick="VerificarLogIn()">
            <p class="bot-env-p">Entrar</p>
         </div>
		<br>
	</div>

</div>


</div>
<div class="mensaje" id="mensaje">
	<p  class="ppmensaje" id="mensajeError"></p>
	<input type="button" class="okmensaje" value="OK" onclick="OkMensajeLogIn()">
</div>

</body>
<script type="text/javascript">

function VerificarLogIn(){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
  	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    	respuesta = xmlhttp.responseText;
    		if (respuesta == 1){
    			MensajeLogIn(1);
    		} 
    		if (respuesta == 0){
    			window.location='http://www.fuxon.com.ar/plataformas.php'; 
    		} 

		}
	}
	correo = document.getElementById('correologin').value;
	clave = document.getElementById('clavelogin').value;
	var cadenaParametros = 'Correo='+encodeURIComponent(correo)+'&Clave='+encodeURIComponent(clave);
	xmlhttp.open('POST', 'php/verificarlogin.php'); 
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
	xmlhttp.send(cadenaParametros); 
}
	
	function MensajeLogIn(numeroerror){
		document.getElementById('mensaje').style.display = 'block';
		if (numeroerror==1){
			document.getElementById('mensajeError').innerHTML = 'Por favor compruebe su Correo y su Clave.'
		}
	}

	function OkMensajeLogIn(){
		document.getElementById('mensaje').style.display = 'none';
	}

</script>
</html>