<?php

// MENU PRINCIPAL DE LA APLICACION


session_start();
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
    <div id="divTitulo">Bienvenidos a ARKOS COFFEE <?php echo $NomUsua; ?></div>
    <div id="divAlerta"></div>
    <div id="divLogin">
    <form id="frmAcceso">
    <?php if($Perfil == 0){ ?>
    <div id="divBtnCrearUs"><input type="button" id="btnCrearUs" name="btnCrearUs" value="Crear Usuario" /></div>
    <?php } ?>
    <?php if($Perfil == 0 || $Perfil == 1){ ?>
    <div id="divBtnCrearProv"><input type="button" id="btnCrearProv" name="btnCrearProv" value="Crear Proveedores" /></div>
    <div id="divBtnCrearProd"><input type="button" id="btnCrearProd" name="btnCrearProd" value="Crear Productos" /></div>
    <div id="divBtnCrearClie"><input type="button" id="btnCrearClie" name="btnCrearClie" value="Crear Clientes" /></div>
    <div id="divBtnEntrada"><input type="button" id="btnEntrada" name="btnEntrada" value="Entradas de Mercancia" /></div>
    <div id="divBtnLstUsua"><input type="button" id="btnLstUsua" name="btnLstUsua" value="Listado Usuarios" /></div>
    <div id="divBtnLstProv"><input type="button" id="btnLstProv" name="btnLstProv" value="Listado Proveedores" /></div>
    <div id="divBtnLstProd"><input type="button" id="btnLstProd" name="btnLstProd" value="Listado Productos" /></div>
    <div id="divBtnLstClie"><input type="button" id="btnLstClie" name="btnLstClie" value="Listado Clientes" /></div>
    <div id="divBtnLstTar"><input type="button" id="btnLstTar" name="btnLstTar" value="Listado Cargar Tarjeta" /></div>
    <div id="divBtnLstVent"><input type="button" id="btnLstVent" name="btnLstVent" value="Listado Ventas de Mercancia" /></div>
    <div id="divBtnLstEntr"><input type="button" id="btnLstEntr" name="btnLstEntr" value="Listado Entradas de Mercancia" /></div>
    <div id="divBtnInfVent"><input type="button" id="btnInfVent" name="btnInfVent" value="Informe de Ventas" /></div>
    <div id="divBtnInfEntr"><input type="button" id="btnInfEntr" name="btnInfEntr" value="Informe de Compras" /></div>
    <div id="divBtnLstProdCli"><input type="button" id="btnLstProdCli" name="btnLstProdCli" value="Art&iacute;culos por Cliente" /></div>
    <?php } ?>
    <?php if($Perfil == 0 || $Perfil == 2){ ?>
    <div id="divBtnCargarT"><input type="button" id="btnCargarT" name="btnCargarT" value="Cargar Tarjeta" /></div>
    <?php } ?>
    <?php if($Perfil == 0 || $Perfil == 3){ ?>
    <div id="divBtnVentas"><input type="button" id="btnVentas" name="btnVentas" value="Ventas de Mercancia" /></div>
    <?php } ?>
    <div id="divBtnSalir"><input type="button" id="btnSalirMenu" name="btnSalirMenu" value="Salir" /></div>
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
