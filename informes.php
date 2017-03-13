<?php

// MODULO DE INFORMES

session_start();
if(isset($_SESSION["Acceso"])){
	if($_SESSION["Acceso"] == "SI"){
		$Usuario = $_SESSION["Usua"];
	}
	else{
		header("Location: index.php");
		exit;
	}
}
else{
	header("Location: index.php");
	exit;
}
$TitInf = "Nuevo Informe";
$TipInf = "0";
$Encabezado = "";
$DisplayFiltro = "style='display:none'";
if(isset($_GET["TipInf"])){
	switch($_GET["TipInf"]){
		case "01":
			$TitInf = "Listado de Usuarios";
			$TipInf = "Usua";
			$Encabezado = "<tr><th>#</th><th>Nro Identificaci&oacute;n</th><th>Nombre</th><th>Clave</th><th>Perfil</th></tr>";
		break;
		case "02":
			$TitInf = "Listado de Proveedores";
			$TipInf = "Prov";
			$Encabezado = "<tr><th>#</th><th>Nit</th><th>Nombre</th><th>Direcci&oacute;n</th><th>Tel&eacute;fono</th><th>Correo</th></tr>";
		break;
		case "03":
			$TitInf = "Listado de Productos";
			$TipInf = "Prod";
			$Encabezado = "<tr><th>#</th><th>Codigo</th><th>Descripci&oacute;n</th><th>Costo</th><th>Saldo</th><th>Valor</th></tr>";
		break;
		case "04":
			$TitInf = "Listado de Clientes";
			$TipInf = "Clie";
			$Encabezado = "<tr><th>#</th><th>Nro Identificaci&oacute;n</th><th>Nombre</th><th>Correo</th><th>Saldo</th></tr>";
		break;
		case "05":
			$TitInf = "Listado de Cargar Tarjeta";
			$TipInf = "CarTar";
			$Encabezado = "<tr><th>#</th><th>Nro</th><th>Fecha</th><th>Cliente</th><th>Recibo Caja</th><th>Valor</th><th>Observaciones</th></tr>";
			$DisplayFiltro = "style='display:block'";
		break;
		case "06":
			$TitInf = "Listado de Ventas de Mercancia";
			$TipInf = "Vtas";
			$Encabezado = "<tr><th>#</th><th>Nro</th><th>Fecha</th><th>Cliente</th><th>Total</th><th>Justificaci&oacute;n</th></tr>";
			$DisplayFiltro = "style='display:block'";
		break;
		case "07":
			$TitInf = "Listado de Entradas de Mercancia";
			$TipInf = "Entr";
			$Encabezado = "<tr><th>#</th><th>Nro</th><th>Fecha</th><th>Proveedor</th><th>Fra Compra</th><th>Total</th></tr>";
			$DisplayFiltro = "style='display:block'";
		break;
		case "08":
			$TitInf = "Informe de Ventas";
			$TipInf = "InfDiaVtas";
			$Encabezado = "<tr><th>#</th><th>Nro</th><th>Fecha</th><th>Cliente</th><th>Cod Producto</th><th>Descripci&oacute;n</th><th>Vlr Unitario</th><th>Cantidad</th><th>Total</th></tr>";
			$DisplayFiltro = "style='display:block'";
		break;
		case "09":
			$TitInf = "Art&iacute;culos por Cliente";
			$TipInf = "InfArtClie";
			$Encabezado = "<tr><th>#</th><th>Cliente</th><th>Cod Producto</th><th>Descripci&oacute;n</th><th>Cantidad</th><th>Total</th></tr>";
			$DisplayFiltro = "style='display:block'";
		break;
		case "10":
			$TitInf = "Informe de Compras";
			$TipInf = "InfDiaCompras";
			$Encabezado = "<tr><th>#</th><th>Nro</th><th>Fecha</th><th>Proveedor</th><th>Cod Producto</th><th>Descripci&oacute;n</th><th>Vlr Unitario</th><th>Cantidad</th><th>Total</th></tr>";
			$DisplayFiltro = "style='display:block'";
		break;
	}
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
    <meta charset="utf-8">
    <title>Coffee</title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">

    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="css/style.css" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="style.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="css/style.responsive.css" media="all">


    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/script.responsive.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/coffee.js"></script>


<style>
.art-content .art-postcontent-0 .layout-item-0 { padding: 15px;  }
.ie7 .post .layout-cell {border:none !important; padding:0 !important; }
.ie6 .post .layout-cell {border:none !important; padding:0 !important; }

.negrita {
	font-weight: bold;
}
</style>
</head>
<body>
<div id="art-main">
<header class="art-header clearfix">


    <div class="art-shapes">
<h1 class="art-headline" data-left="77.5%">
    <!--<a href="#">Coffee</a>-->
</h1>

<div class="art-object1671582443" data-left="0%"></div>
<div class="art-object1102269715" data-left="21.91%"></div>

            </div>

<nav class="art-nav clearfix">
    <ul class="art-hmenu"></ul>
    </nav>


</header>
<div class="art-sheet clearfix">
            <div class="art-layout-wrapper clearfix">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content clearfix"><article class="art-post art-article">


                <div class="art-postcontent art-postcontent-0 clearfix"><div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 100%" >
        <p style="text-align: center;">

    <div id="divContAcceso">
    <div id="divTitulo"><?php echo $TitInf; ?></div>
    <div id="divTipoInf"></div>
    <div id="divAlerta"></div>
    <div id="divFiltro" <?php echo $DisplayFiltro; ?>>
    	<div id="divFechIni"><label for="txtFechIni">Fecha Inicial:</label><input type="date" id="txtFechIni" /></div>
        <div id="divFechFin"><label for="txtFechFin">Fecha Final:</label><input type="date" id="txtFechFin" /></div>
    </div>
    <div id="divBotones"><input type="hidden" id="txtTipoInf" value="<?php echo $TipInf; ?>"/><input type="button" id="btnConsultarInf" value="Consultar"/><br /><input type="button" id="btnMenu" value="Menu"/></div>
    <div id="divLogin">
        <div id="divLstInf_Enc" style="width:100%">
        <table style="width:100%">
        	<thead>
				<?php echo $Encabezado; ?>
            </thead>
            <tbody id="tbodyInf">
            </tbody>
        </table>
        </div>
        <div id="divLstInf">
        <table style="width:100%"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table>
        </div>

    </div>
    </div>
</p>
    </div>
    </div>
</div>
</div>

</article></div>
                    </div>
                </div>
            </div><footer class="art-footer clearfix">

</footer>

    </div>
    <p class="art-page-footer">&nbsp;</p>
</div>


</body></html>
