
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300;700&display=swap"
        rel="stylesheet">
    <title>PRESUPUESTO FUXON</title>
    <!-- <link rel="stylesheet" href="style-prueba1.css"> -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="presupuestofinal">
        <!-- <div class="cabecera">
                <h2 class="titulo7">PRESUPUESTO</h2>
                <a class="logo-pres" href="index1.html"><img src="./logo1.png" alt=""></a>
        </div> -->
        <div class="cabecera-pres" style="background: #173349;" id="encabezado">
                <h2 class="titulo7">PRESUPUESTO</h2>
                <div class="item-logo1" style="width: 47%;">
                    <div class="mainlogo1" style="margin-top: 3vh; width: 220px; display: inline-block;"></div>
                </div>
        </div>
        <div class="fondo-presupuesto">
        <div class="item-presupuesto">
            <br>
            <p class="text77" style="width: 70%; margin-left: auto; margin-right: auto; text-align: center;">Presupuesto estándar de materiales y mano de obra por metro cuadrado cubierto, para construcción
                Obra gruesa de Vivienda nueva en Método Steel Framing ubicada en Gran Mendoza.</p>
            <br>
            <h2 class="text99">ESTRUCTURA Y REVESTIMIENTO DE EXTERIORES E INTERIORES</h2>

            <p class="text88" style="margin-left: 15px;">Materiales y mano de obra: </p>
            <ul class="materiales" style="padding-left: 80px;">
                <li class="text77">Ejecución de lista de corte optimizada.</li>
                <li class="text77">Armado de paneles y elementos estructurales según planos.</li>
                <li class="text77">Montaje de estructura de paneles exteriores, interiores y cubiertas de techos.</li>
                <li class="text77">Colocación de anclajes principales y secundarios en platea según planos.</li>
                <li class="text77">Colocación de cruces, rigidizadores, conectores, bloking, straping y fijaciones.</li>
                <li class="text77">Atornillado de OSB y colocación de barrera de agua y viento en muros.</li>
                <li class="text77">Aplicación de EIFS en todos los muros exteriores. </li>
                <li class="text77">Terminación con placa cementicias en mochetas, antepechos, dinteles y parapetos.</li>
                <li class="text77">Colocación de aislación y barrera de vapor en muros y cielorrasos. </li>
                <li class="text77">Colocación de emplacado de yeso en muros interiores con cantoneras. </li>
                <li class="text77">Colocación de estructura y emplacado en cielorrasos con corte de pintura según
                    proyecto.</li>
            </ul>
            <br>
            <div class="final text88"style="border-style: solid;border-color: #ff5500;background-color: #ff5500;color: white;border-radius: 20px" >
                <p class="text88" style="text-align: end;">Costo Total de Materiales y Mano de Obra Gruesa en Steel Framing:     $
            <!-- inserta la variable precio -->
                <?php
                $costom2 = $_POST['costom2'];
                echo $costom2;
                ?>
                   (+IVA) el m2   </p>
            </div>
            <br>
            <p style="color: #ff5500">*Basado en una vivienda unifamiliar de entre 100 y 300 m2 cubiertos, no considerando aleros, semi
                cubiertos o decoraciones exteriores especiales.</p>
            <p>Cotización dólar contemplada en el presente presupuesto según BNA: tipo vendedor. Los precios de los
                materiales cambian constantemente sin previo aviso.</p>
                <p class="no-incluye">No incluye: Proyecto de Arquitectura, Renders, Proyecto Instalación Sanitaria e Instalación Eléctrica.
                    Proyecto y cálculo de Ingeniería en Steel Framing. Planos de taller y montaje. Estudio de suelos, costos
                    por gestiones ante organismos, aforos, boletas de concejo profesional, permisos. Platea de fundación,
                    Nivelación y compactación, fundaciones especiales; veredines perimetrales, contra pisos exteriores,
                    veredas y puentes de acceso vehicular; cierre permetral de obra; Materiales de cubierta de techo,
                    Zinguería, revestimientos plásticos exteriores, revestimientos decorativos de piedra u otros, aberturas,
                    puertas y ventanas exteriores, fletes de materiales a obra y equipos especiales, pérgolas o estructuras
                    anexas, rejas de ventanas y portones, cambios no establecidos en los planos y otros no descriptos en el
                    presente. Emplacados dobles, muros cortafuegos, aislantes sonoros especiales, cajones decorativos,
                    cenefas, gargantas u otro tipo de trabajos interiores, puertas y aberturas interiores, revestimientos
                    cerámicos en muros y pisos, pintura interior, placares, muebles de cocina, fletes de materiales a obra,
                    alquiler de equipos especiales, cambios no establecidos en los planos y otros no descriptos en el
                    presente. fletes de materiales a obra, acarreos de escombros, llenado de contenedores, y otros no
                    descriptos en el presente presupuesto. Instalación Eléctrica, Instalación Sanitaria, Griferías,
                    artefactos de baño, instalaciones especiales, Otras instalaciones no incluidas: Instalaciones de
                    refrigeración y calefacción, instalación de tanques/cisternas/bombas/biodigestores/pozos sépticos;
                    instalaciones para gas; instalación de colectores y energía solar; conexiones a servicios públicos.
                    Instalaciones de alarma, portero eléctrico, cercos perimetrales y cámaras de seguridad. Colocación de
                    artefactos eléctricos, y otras instalaciones no especificadas en el presente.</p>
            </div>
            </div>
    </div>




</body>
</html>