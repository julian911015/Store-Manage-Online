<?php

// MODULO GESTION DE CLIENTES

session_start();
include_once("class/Clientes.php");

$oCliente = new Clientes();
$oCliente->SigId();
$NroId = $oCliente->nCant;

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
    <div id="divTitulo">CREAR CLIENTES</div>
    <div id="divAlerta"></div>
    <div id="divLogin">
    <form id="frmAcceso">
    <div id="divLblId">Id: <div id="divTxtId"><?php echo $NroId; ?></div></div>
    <div id="divLblCodBar"><label for="txtCodBar">Codigo Barras: </label></div>
    <div id="divTxtCodBar"><input type="text" id="txtCodBar" name="txtCodBar" /></div>
    <div id="divLblNombre"><label for="txtNombre">Nombre: </label></div>
    <div id="divTxtNombre"><input type="text" id="txtNombre" name="txtNombre" /></div>
    <div id="divLblNroId"><label for="txtNroId">Nro Identidad: </label></div>
    <div id="divTxtNroId"><input type="txt" id="txtNroId" name="txtNroId" /></div>
    <div id="divLblTipoId"><label for="cboTipoId">Tipo de Identidad: </label></div>
    <select id="cboTipoId" name="cboTipoId">
    <option value="TI">Tarjeta Identidad</option>
    <option value="CC">Cedula de Ciudadania</option>
    </select>
    </div>
    <div id="divLblCorreo"><label for="txtCorreo">Correo: </label></div>
    <div id="divTxtCorreo"><input type="text" id="txtCorreo" name="txtCorreo" /></div>
    <div id="divLblClave"><label for="txtClave">Clave: </label></div>
    <div id="divTxtClave"><input type="password" id="txtClave" name="txtClave" /></div>
    <div id="divLblSaldo"><label for="txtSaldo">Saldo: </label></div>
    <div id="divTxtSaldo"><input type="txt" id="txtSaldo" name="txtSaldo" /></div>
    <div id="divChkJustif">Justifica Gasto<input type="checkbox" id="chkJustif" name="chkJustif" />
    <div id="divBtnCrear"><input type="button" id="btnCrearCl" name="btnCrearCl" value="Crear" /></div>
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
