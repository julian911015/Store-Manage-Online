<?php
include_once("class/Clientes.php");
include_once("class/Productos.php");

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
    <a href="#">Coffee</a>
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


        <form>


<div><span class="negrita"><strong>Usuario</strong></span><strong>: </strong>
<input type="text" id="txtUsuario" />
</div>
<div>
  <p><strong>Nombre Usuario: </strong>  </p>
  <div id="divUsuario" ></div>
  <p>Saldo:</p>
</div>
<br/>
<div>
  <p>Producto:<input type="text" id="txtProducto" />
  </p>
</div>
<div>
  <p>Descripci&oacute;n: </p>
  <div id="divProducto" ></div>
  <p>Valor Unitario: </p>
  <div id="divVlr" ></div>
  <p>Cantidad Disponible: </p>
  <div id="divCant" ></div></div>

<br/>
<div>
  <p>Cantidad:
    <input id="txtCantidad" type="number" />
  </p>
  <p>&nbsp; </p>
</div>
<div>
<input type="button" value="Comprar" id="btnComprar" />
</div>
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
