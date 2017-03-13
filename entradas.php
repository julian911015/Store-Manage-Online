<?php

// MODULO ENTRADA DE MERCANCIA


session_start();
include_once("class/Entradas.php");

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
$oEntr = new Entradas();
$oEntr->SigNro();
$EntrNro = $oEntr->nCant;

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


    <div id="divTitulo">Bienvenidos a COFFEE <?php echo $NomUsua; ?></div>
    <div id="divFactura">Entrada Nro <div id="divNroEntr"><?php echo $EntrNro; ?></div></div>
    <div id="divAlerta"></div>
        <form>


<div><span class="negrita"><strong>Proveedor</strong></span><strong>: </strong>
<input type="text" id="txtProveed" />
</div>
<div>
<input type="button" value="Consultar" id="btnConsProv" />
</div>
<div>
  <p><strong>Nombre Proveedor: </strong>  </p>
  <div id="divNomProv" ></div>
</div>
<div><span class="negrita"><strong>Factura Compra</strong></span><strong>: </strong>
<input type="text" id="txtFraComp" />
</div>
<div>
  <p>Producto:<input type="text" id="txtProductoComp" />
  </p>
</div>
<div>
  <p>Descripci&oacute;n: </p>
  <div id="divProductoComp" ></div>
<div><span class="negrita"><strong>Costo Unitario</strong></span><strong>: </strong>
<input type="text" id="txtCostoUnitComp" />
</div>
<div>
  <p>Cantidad:
    <input id="txtCantidadComp" type="number" min="0" />
  </p>
</div>
<div><span class="negrita"><strong>Valor Venta</strong></span><strong>: </strong>
<input type="text" id="txtVlrVtaComp" />
</div>
<div>
<input type="button" value="Agregar" id="btnAgregarProdComp" />
</div>
<div id="divLstProds_Enc" style="width:100%">
<table style="width:100%"><tr><td>#</td><td>Cod Prod</td><td>Descripci&oacute;n</td><td>Costo Unit</td><td>Cant</td><td>Vlr Venta</td><td>SubTotal</td></tr></table>
</div>
<div id="divLstProds">
<table style="width:100%"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table>
</div>
<div>
  <p>Valor Total: </p>
  <div id="divVlrTot" ></div>
</div>

<div>
<input name="Botón" type="button" id="btnComprarComp" value="Comprar"

onclick='alert("REGISTRO SE COMPLETO SATISFACTORIAMENTE.")'

/>



</div>
    <div id="divBtnMenu"><input type="button" id="btnMenu" name="btnMenu" value="Menu" /></div>
</form></p>
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
