<?php

// MODULO DE RECARGA DE SALDOS DE USUARIO

session_start();
include_once("class/Recargas.php");

if(isset($_SESSION["Acceso"])){
	if($_SESSION["Acceso"] == "SI"){
		$Usuario = $_SESSION["Usua"];
		$Perfil = $_SESSION["Perf"];
		$NomUsua = $_SESSION["Nom"];
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

$oRecarga = new Recargas();
$oRecarga->SigNro();
$RecNro = $oRecarga->nCant;

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
    <div id="divTitulo">CARGAR TARJETA. <br />Nro: <div id="divNroRec"><?php echo $RecNro; ?></div></div>
    <div id="divAlerta"></div>
    <div id="divLogin">
    <form id="frmAcceso">
    <div id="divLblCliente"><label for="txtCliente">Cliente: </label></div>
    <div id="divTxtCliente"><input type="text" id="txtCliente" name="txtCliente" /></div>
    <div id="divBtnConsultar"><input type="button" id="btnConsultar" name="btnConsultar" value="Consultar" /></div>
    <div id="divLblNombre"><label for="txtNombre">Nombre: </label></div>
    <div id="divTxtNombre"></div>
    <div id="divLblSaldoA"><label for="txtSaldoA">Saldo Actual: </label></div>
    <div id="divTxtSaldoA"></div>
    <div id="divLblVlrCarg"><label for="txtVlrCarg">Valor a Cargar: </label></div>
    <div id="divTxtVlrCarg"><input type="number" id="txtVlrCarg" name="txtVlrCarg" /></div>
    <div id="divLblNroFact"><label for="txtNroFact">Recibo Caja: </label></div>
    <div id="divTxtNroFact"><input type="text" id="txtNroFact" name="txtNroFact" /></div>
    <div id="divLblObserv"><label for="txtObserv">Observaciones: </label></div>
    <div id="divTxtObserv"><input type="text" id="txtObserv" name="txtObserv" /></div>

    <div id="divBtnCargar"><input type="button" id="btnCargar" name="btnCargar" value="Cargar"

    onclick='alert("LA RECARGA SE REALIZÓ SATISFACTORIAMENTE.")'

    /></div>
    <div id="divBtnMenu"><input type="button" id="btnMenu" name="btnMenu" value="Menu" /></div>
    </div>
    </form>
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
