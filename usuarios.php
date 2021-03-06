<?php

// MODULO GESTION DE USUARIOS QUE ACCEDEN Y GESTIONAN LA APLICACION

session_start();
include_once("class/Usuarios.php");

$oUsuario = new Usuarios();
$oUsuario->SigId();
$NroId = $oUsuario->nCant;
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head>
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
    <div id="divTitulo">CREAR USUARIOS</div>
    <div id="divAlerta"></div>
    <div id="divLogin">
    <form id="frmAcceso">
    <div id="divLblId">Id: <div id="divTxtId"><?php echo $NroId; ?></div></div>
    <div id="divLblNumeror"><label for="txtNumero">Numero: </label></div>
    <div id="divTxtNumero"><input type="text" id="txtNumero" name="txtNumero" /></div>
    <div id="divLblNombre"><label for="txtNombre">Nombre: </label></div>
    <div id="divTxtNombre"><input type="text" id="txtNombre" name="txtNombre" /></div>
    <div id="divLblClave"><label for="txtClave">Clave: </label></div>
    <div id="divTxtClave"><input type="password" id="txtClave" name="txtClave" /></div>
     <div id="divLblPerfil"><label for="cboPerfil">Perfil: </label></div>
    <div id="divTxtPerfil">
    <select id="cboPerfil" name="cboPerfil">
    <option value="0">Super Admin</option>
    <option value="1">Admin</option>
    <option value="2">Cajero</option>
    <option value="3">Vendedor</option>
    </select>
    </div>
    <div id="divBtnCrearUsu"><input type="button" id="btnCrearUsu" name="btnCrearUsu" value="Crear" /></div>
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
