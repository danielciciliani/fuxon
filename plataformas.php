<?php
session_start();
if( !isset($_SESSION["IDSesion"]) ){
 header("location:Admin.php");
  exit();
 }
?>
<!DOCTYPE html><html>
<head>		
	<link rel="stylesheet" href="./css/style.css?v=0.1">
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico?v=4">
 	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico?v=2">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/v4-shims.css">

</head>
<body>
<div style="background: #173349; text-align: center;" id="encabezado">
	<div class="mainlogo" style="margin-top: 3vh; width: 300px; position: static;display: inline-block;"></div>
	<span class="fa-layers fa-fw Usuario" title="Usuario" onclick="LogOut()" >
   		<i class="fas fa-power-off"></i>
	</span>
</div>

	<p class="ppInput">Precio por m2</p>
	<input type="number" class="inputPlataforma" id="costo" >
	<div class="bot-env" onclick="CambiarCosto()" style="width: 180px; padding: 10px 0px; text-align:center;">
        <p class="bot-env-p">Guardar Precio</p>
    </div>
    <br>
    <div class="separador"></div>
    <p class="ppInput">Próximas reuniones informativas</p>
    <input type="datetime-local" class="inputPlataforma" onchange="GuardarFecha()" id="nueva_fecha" style="width: 250px;cursor: pointer;">
    <div id="ventanaReuniones" class="divImagenes">	
		<div id="zonaReuniones">
			<div id="zonaReuniones1"></div>
		</div>
	</div>
	<div class="separador"></div>
	<p class="ppInput">Imágenes</p>
	<form name='formulario' id='formulario' class="formulario" method='post' action='php/upload.php' target='_self' enctype="multipart/form-data"> 
	<input  type="file" id="fichero" name="Archivo" onchange="Upload()" style="width: 15%; vertical-align: middle; opacity: 0; position: relative;z-index: 10; height: 30px; cursor: pointer;" />
    <i class="fas fa-cloud-upload-alt IconoUpload" ></i>
    <div class="bot-env" onclick="GuardarImagenes()" style="width: 250px; padding: 10px 0px; text-align:center;">
        <p class="bot-env-p">Guardar Texto Imágenes</p>
    </div>
	<br><br>
	<input style="display: none;" type='submit'>
	</form> 
<div id="ventanaImagen" class="divImagenes">	
	<div id="zonaImagenes">
		<div id="zonaImagenes1" ondragover="allowDrop(event)" ondrop="dropImg(event)"></div>
	</div>
</div>
<div class="mensaje" id="toast">
	<p class="ppmensaje" id="mensajeToast"></p>
</div>

</body>
<script type="text/javascript">

var IDSesion='<?php echo $_SESSION['IDSesion']; ?>';
var cimagenes=0;
TraerCosto();
TraerFechasServidor();
TraerImagenesServidor();


function TraerCosto(){
	var xmlhttp1 = new XMLHttpRequest();
	xmlhttp1.onreadystatechange = function() {
	if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
		respuesta1 = xmlhttp1.responseText;
		if(respuesta1=='Debe iniciar Sesion'){LogOut()}
		Costo =respuesta1.replace("\"","");		
		document.getElementById('costo').value = parseInt(Costo);
	}
	}
	var cadenaParametros = '';
	xmlhttp1.open('POST', 'php/buscarCosto.php');
	xmlhttp1.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
	xmlhttp1.send(cadenaParametros); 
}

function CambiarCosto(){
	var xmlhttp1 = new XMLHttpRequest();
	xmlhttp1.onreadystatechange = function() {
	if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
		respuesta1 = xmlhttp1.responseText;
		if(respuesta1=='Debe iniciar Sesion'){LogOut()}
		textomensaje=respuesta1;
			Toast(textomensaje);
	}
	}
	Costo =	document.getElementById('costo').value;
	var cadenaParametros = 'Costo='+encodeURIComponent(Costo);
	xmlhttp1.open('POST', 'php/cambiarCosto.php');
	xmlhttp1.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
	xmlhttp1.send(cadenaParametros); 
}

function GuardarFecha(){
	var xmlhttp1 = new XMLHttpRequest();
	xmlhttp1.onreadystatechange = function() {
	if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
		respuesta1 = xmlhttp1.responseText;
		if(respuesta1=='Debe iniciar Sesion'){LogOut()}
		textomensaje=respuesta1;
			Toast(textomensaje);
			TraerFechasServidor();
	}
	}
	Fecha =	document.getElementById('nueva_fecha').value;
	var cadenaParametros = 'Fecha='+encodeURIComponent(Fecha);
	xmlhttp1.open('POST', 'php/guardarFecha.php');
	xmlhttp1.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
	xmlhttp1.send(cadenaParametros); 
}

function borrarFecha(event){
	var xmlhttp1 = new XMLHttpRequest();
	xmlhttp1.onreadystatechange = function() {
	if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
		respuesta1 = xmlhttp1.responseText;
		if(respuesta1=='Debe iniciar Sesion'){LogOut()}
		textomensaje=respuesta1;
			Toast(textomensaje);
			TraerFechasServidor();
	}
	}
	var idevent=event.target.id.substring(6);
	console.log(idevent);
	IDFecha =document.getElementById("fechaID"+idevent).innerHTML;
	console.log(IDFecha);
	var cadenaParametros = 'IDFecha='+encodeURIComponent(IDFecha);
	xmlhttp1.open('POST', 'php/borrarFecha.php');
	xmlhttp1.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
	xmlhttp1.send(cadenaParametros); 
}

var Fechas;

function TraerFechasServidor(){
	var xmlhttp1 = new XMLHttpRequest();
	xmlhttp1.onreadystatechange = function() {
	if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
		respuesta1 = xmlhttp1.responseText;
		if(respuesta1=='Debe iniciar Sesion'){LogOut()}
		Fechas =JSON.parse(respuesta1);	
		document.getElementById('zonaReuniones1').remove();
			var zona=document.createElement('DIV');
			zona.id ='zonaReuniones1';
			cfechas=0;
		document.getElementById('zonaReuniones').appendChild(zona);	
		armarFechas();
	}
	}
	var cadenaParametros = '';
	xmlhttp1.open('POST', 'php/buscarFechas.php');
	xmlhttp1.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
	xmlhttp1.send(cadenaParametros); 
}

function armarFechas(){
	for(xx=0;xx<Fechas.length/2;xx++){
		AgregarFecha();
		fecha_format=Fechas[xx*2].split('T')[0];
		document.getElementById('fecha'+(xx+1)).innerHTML=fecha_format.split('-')[2]+"/"+fecha_format.split('-')[1]+"/"+fecha_format.split('-')[0]+" "+Fechas[xx*2].split('T')[1] + "hs";
		document.getElementById('fechaID'+(xx+1)).innerHTML=Fechas[xx*2+1];
	}
}
var cfechas=0;
function AgregarFecha(){
	cfechas++;
	var celda=document.createElement('DIV');
	celda.className = 'divImgMini';
	celda.id='divFecha'+cfechas;

	var celda1=document.createElement('P');
	celda1.id = 'fechaID'+cfechas;
	celda1.style.display ='none';
	celda.appendChild(celda1);
	var celda1=document.createElement('P');
	celda1.id = 'fecha'+cfechas;
	celda1.className="ppInput1";
	celda.appendChild(celda1);
	var celda1=document.createElement('I');
	celda1.className='fas fa-trash IconoTrashIMG';
	celda1.id='borraF'+cfechas;
	celda1.setAttribute("onclick","borrarFecha(event)");
	celda.appendChild(celda1);
	document.getElementById('zonaReuniones1').appendChild(celda);
}


function Upload(){
	fd = new FormData(document.getElementById('formulario'));
	Ajax = new XMLHttpRequest();
	Ajax.open("POST", document.getElementById('formulario').action, true);
	Ajax.onreadystatechange = function() {
		if	(Ajax.readyState == 4 && Ajax.status == 200) {
			document.getElementById('fichero').value='';
			var respuesta = Ajax.responseText;
			textomensaje=respuesta;
			Toast(textomensaje);
			
			if(textomensaje=="Archivo subido correctamente"){
				document.getElementById('zonaImagenes1').remove();
				var zona=document.createElement('DIV');
				zona.id ='zonaImagenes1';
				zona.setAttribute('ondragover','allowDrop(event)');
				zona.setAttribute('ondrop','dropImg(event)');
				cimagenes=0;
				document.getElementById('zonaImagenes').appendChild(zona);
   				TraerImagenesServidor();
   				}
		}
	}
	Ajax.send(fd);
}

function GuardarImagenes(){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
  		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
  			textomensaje=xmlhttp.responseText;
  			if(textomensaje=='Debe iniciar Sesion'){LogOut()}
  			Toast(textomensaje);

  		}}
  	var Im=[];
  	for(x=0;x<cimagenes;x++){
		Im[x] = [];
			Im[x][0]=document.getElementById('imgID'+(x+1)).innerHTML;
			Im[x][1]=document.getElementById('imgMiniBorrar'+(x+1)).innerHTML;
			Im[x][2]=document.getElementById('title'+(x+1)).value;
			Im[x][3]=document.getElementById('location'+(x+1)).value;
	}	
	Im = JSON.stringify(Im);
	var cadenaParametros = 'Imagenes='+encodeURIComponent(Im);
	xmlhttp.open('POST', 'php/guardarImagenes.php');
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
	xmlhttp.send(cadenaParametros); 
}

function borrarImagen(){
	var idborrar = event.target.id.substring(6);
	document.getElementById('imgMiniBorrar'+idborrar).innerHTML='borrar';
	document.getElementById('divImgMini'+idborrar).style.display="none";
	document.getElementById('divImgMini'+idborrar).id='divImgMini0';
	document.getElementById('imgMiniBorrar'+idborrar).id='imgMiniBorrar0';
	document.getElementById('imgMini'+idborrar).id= 'imgMini0';
	document.getElementById('title'+idborrar).id= 'title0';
	document.getElementById('location'+idborrar).id= 'location0';
	document.getElementById('imgID'+idborrar).id='imgID0';
	document.getElementById('borraI'+idborrar).id='borraI0';
	for(x=idborrar-1;x>=1;x--){
		document.getElementById('divImgMini'+x).id='divImgMini'+(x+1);
		document.getElementById('imgMini'+x).id= 'imgMini'+(x+1);
		document.getElementById('imgMiniBorrar'+x).id= 'imgMiniBorrar'+(x+1);
		document.getElementById('imgID'+x).id='imgID'+(x+1);
		document.getElementById('title'+x).id='title'+(x+1);
		document.getElementById('location'+x).id='location'+(x+1);
		document.getElementById('borraI'+x).id='borraI'+(x+1);
	}
	document.getElementById('divImgMini0').id='divImgMini1';
	document.getElementById('imgMini0').id= 'imgMini1';
	document.getElementById('imgMiniBorrar0').id= 'imgMiniBorrar1';
	document.getElementById('imgID0').id='imgID1';
	document.getElementById('title0').id='title1';
	document.getElementById('location0').id='location1';
	document.getElementById('borraI0').id='borraI1';
	GuardarImagenes();
}

// Drag and Drop Images
function allowDrop(ev) {
    ev.preventDefault();
}

function dragImg(ev) {
	for(x=1;x<=cimagenes;x++){
  		document.getElementById('divImgMini'+x).style.top=document.getElementById('divImgMini'+x).offsetTop+'px';
  	}
  	document.getElementById('zonaImagenes1').style.height=document.getElementById('zonaImagenes1').offsetHeight+'px';

    ev.dataTransfer.setData("text", ev.target.id);
    Yinicial= ev.clientY;
  var id=event.target.id;
  YinicialElemento= document.getElementById(id).style.top;

  document.getElementById(id).style.position='absolute';
  document.getElementById(id).style.opacity=0.5;
  document.getElementById(id).style.border='dotted 1px black';
}

function dropImg(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var Yfinal=ev.clientY;
    difY=parseInt(YinicialElemento)+(Yfinal-Yinicial);
    var difYpx=difY+'px';

    document.getElementById(data).style.top=difYpx;
    arrayTemporal=[]
    arrayTemporal[0]=[];
    arrayTemporal[1]=[];
    arrayTemporal[2]=[];
    arrayTemporal[3]=[];
    arrayTemporal[4]=[];
    arrayTemporal[5]=[];
    arrayOrdenado=[];
    for(x=1;x<=cimagenes;x++){
    	arrayTemporal[0].push(document.getElementById('imgMini'+x).src);
    	arrayTemporal[3].push(document.getElementById('imgMiniBorrar'+x).innerHTML);
    	arrayTemporal[1].push(document.getElementById('imgID'+x).innerHTML);
    	arrayTemporal[2].push(parseInt(document.getElementById('divImgMini'+x).offsetTop));
    	arrayTemporal[4].push(document.getElementById('title'+x).value);
    	arrayTemporal[5].push(document.getElementById('location'+x).value);
    	arrayOrdenado.push(parseInt(document.getElementById('divImgMini'+x).offsetTop));
    };

    arrayOrdenado.sort(sortNumber);

    for(y=0;y<arrayOrdenado.length;y++){
    	if(arrayOrdenado[y]!=0){
	    for(x=0;x<arrayTemporal[2].length;x++){
    		if(arrayOrdenado[y]==arrayTemporal[2][x]){
     			document.getElementById('imgMini'+(y+1)).src=arrayTemporal[0][x];
    			document.getElementById('imgID'+(y+1)).innerHTML=arrayTemporal[1][x];
    			document.getElementById('imgMiniBorrar'+(y+1)).innerHTML=arrayTemporal[3][x];
    			document.getElementById('title'+(y+1)).value=arrayTemporal[4][x];
    			document.getElementById('location'+(y+1)).value=arrayTemporal[5][x];
    		}
    	}
    	}
    }

    for(x=1;x<=cimagenes;x++){
    document.getElementById('divImgMini'+x).style.position='static';
    document.getElementById('divImgMini'+x).style.opacity=1;
    document.getElementById('divImgMini'+x).style.border='none';
    }
    GuardarImagenes();
  }

  function TraerImagenesServidor(){
	var xmlhttp1 = new XMLHttpRequest();
	xmlhttp1.onreadystatechange = function() {
	if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
		respuesta1 = xmlhttp1.responseText;
		if(respuesta1=='Debe iniciar Sesion'){LogOut()}
		Imagenes =JSON.parse(respuesta1);		
		armarImagenes();
	}
	}
	var cadenaParametros = '';
	xmlhttp1.open('POST', 'php/buscarImagenes.php');
	xmlhttp1.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
	xmlhttp1.send(cadenaParametros); 
}

function armarImagenes(){
	for(x=0;x<Imagenes.length/4;x++){
		AgregarImagen();
		document.getElementById('imgMini'+(x+1)).src="images/"+Imagenes[x*4];
		document.getElementById('imgID'+(x+1)).innerHTML=Imagenes[x*4+1];
		document.getElementById('title'+(x+1)).value=Imagenes[x*4+2];
		document.getElementById('location'+(x+1)).value=Imagenes[x*4+3];
	}
}

function AgregarImagen(){
	cimagenes++;
	var celda=document.createElement('DIV');
	celda.className = 'divImgMini';
	celda.id='divImgMini'+cimagenes;
	celda.draggable=true;
	celda.style.cursor='move';
	celda.setAttribute('ondragstart','dragImg(event)');

	var celda1=document.createElement('IMG');
	celda1.id = 'imgMini'+cimagenes;
	celda1.className = 'imgMini';
	celda1.draggable=false;
	celda.appendChild(celda1);
	var celda1=document.createElement('P');
	celda1.id = 'imgMiniBorrar'+cimagenes;
	celda1.style.display ='none';
	celda.appendChild(celda1);
	var celda1=document.createElement('P');
	celda1.id = 'imgID'+cimagenes;
	celda1.style.display ='none';
	celda.appendChild(celda1);
	var celda1=document.createElement('INPUT');
	celda1.id = 'title'+cimagenes;
	celda1.type="text";
	celda1.className="inputPlataforma1";
	celda1.placeholder="Agregue título del proyecto";
	celda.appendChild(celda1);
	var celda1=document.createElement('INPUT');
	celda1.id = 'location'+cimagenes;
	celda1.type="text";
	celda1.className="inputPlataforma1";
	celda1.placeholder="Agregue ubicación del proyecto";
	celda.appendChild(celda1);
	var celda1=document.createElement('I');
	celda1.className='fas fa-trash IconoTrashIMG';
	celda1.id='borraI'+cimagenes;
	celda1.setAttribute("onclick","borrarImagen(event)");
	celda.appendChild(celda1);
	document.getElementById('zonaImagenes1').appendChild(celda);
}

function sortNumber(a, b) {
  return a - b;
}

function Toast(textoToast){
	document.getElementById('toast').style.display = 'block';
	document.getElementById('toast').classList.remove('toast');
	document.getElementById('toast').classList.add('toastReverse');
	setTimeout(function(){
		document.getElementById('toast').classList.add('toast');
		document.getElementById('toast').classList.remove('toastReverse');
	},2000); 
	setTimeout(function(){
		document.getElementById('toast').style.display = 'none';
	},2500); 
	document.getElementById('mensajeToast').innerHTML = textoToast;
}

function LogOut(){
	window.location='php/logout.php';
}

</script>
</html>