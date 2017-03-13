<?php
session_start();

include_once("class/Usuarios.php");
include_once("class/Productos.php");
include_once("class/Proveedores.php");
include_once("class/Clientes.php");
include_once("class/Recargas.php");
include_once("class/Entradas.php");
include_once("class/EntradasLineas.php");
include_once("class/Ventas.php");
include_once("class/VentasLineas.php");
include_once("class/InformesClass.php");

$opcion = $_POST["opc"];

if($opcion != "ValidarUsuario"){
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
}

switch($opcion){
	case "ValidarUsuario":
		$arrResult = array();
		$oUsuar = new Usuarios();
		$oUsuar->Numero_Identidad = $_POST["us"];
		$oUsuar->Clave = $_POST["clav"];
		$oUsuar->ConsultarClave();
		if($oUsuar->nCant > 0){
			$_SESSION["Acceso"] = "SI";
			$_SESSION["Usua"] = $oUsuar->Id_Usuario;
			$_SESSION["Nom"] = $oUsuar->Nombre;
			$_SESSION["Ident"] = $oUsuar->Numero_Identidad;
			$_SESSION["Perf"] = $oUsuar->Perfil;
			$arrResult[0] = "OK";
		}
		else{
			$_SESSION["Acceso"] = "NO";
			$arrResult[0] = "Error al ingresar";
		}
        echo json_encode($arrResult);
	break;
	case "Salir":
		$_SESSION = array();
		session_destroy();
		echo "<script>location.href='index.php';</script>";
	break;
	case "ConsultarCliente":
		$arrResult = array();
		$oCliente = new Clientes();
		$oCliente->Codigo_Barra = $_POST["clie"];
		$oCliente->Clave = $_POST["clav"];
		$oCliente->ConsultarCodBarras();
		if($oCliente->nCant > 0){
			$arrResult[0] = $oCliente->Nombre;
			$arrResult[1] = $oCliente->Saldo;
			$arrResult[2] = $oCliente->Justifica;
		}
		else{
			$arrResult[0] = "El Cliente NO existe o su clave esta Errada. ";
			$arrResult[1] = 0;
			$arrResult[2] = 0;
		}
        echo json_encode($arrResult);
	break;
	case "ConsultarCliente2":
		$arrResult = array();
		$oCliente = new Clientes();
		$oCliente->Codigo_Barra = $_POST["clie"];
		$oCliente->ConsultarCodigo();
		if($oCliente->nCant > 0){
			$arrResult[0] = $oCliente->Nombre;
			$arrResult[1] = $oCliente->Saldo;
			$arrResult[2] = $oCliente->Justifica;
		}
		else{
			$arrResult[0] = "El Cliente NO existe. ";
			$arrResult[1] = 0;
			$arrResult[2] = 0;
		}
        echo json_encode($arrResult);
	break;
	case "ConsultarProducto":
		$arrResult = array();
		$oProd = new Productos();
		$oProd->Codigo_Producto = $_POST["prod"];
		$oProd->ConsultarCodigo();
		if($oProd->nCant > 0){
			$arrResult[0] = $oProd->Descripcion_Producto;
			$arrResult[1] = $oProd->Valor_Producto;
			$arrResult[2] = $oProd->Saldo_Producto;
			$arrResult[3] = "OK";
		}
		else{
			$arrResult[0] = "El Producto NO existe. ";
			$arrResult[1] = 0;
			$arrResult[2] = 0;
			$arrResult[3] = "Error";
		}
		//$arrResult[0] = "No existe. ".$oProd->Alerta;
        echo json_encode($arrResult);
	break;
	case "AgregarProductoVta":
		$arrResult = array();

		date_default_timezone_set("America/Bogota");
		$hoy = getdate();
		$fecha = $hoy['year']."-";
		if ($hoy['mon'] < 10)
			$fecha .= "0";
		$fecha .= $hoy['mon']."-";
		if ($hoy['mday'] < 10)
			$fecha .= "0";
		$fecha .= $hoy['mday'];

		$Msg = "";
		$cadenaSalida = "";

		$oProd = new Productos();
		$oCliente = new Clientes();
		$oVenta = new Ventas();
		$oVentaLineas = new VentasLineas();

		$oProd->Codigo_Producto = $_POST["prod"];
		$oProd->ConsultarCodigo();
//		$Msg .= " 1: ".$oProd->Alerta;

		$oVenta->Nro_Ventas = $_POST["nrof"];
		$oVenta->Consultar();
//		$Msg .= " 2: ".$oVenta->Alerta." - Cant: ".$oVenta->nCant;

		$oCliente->Codigo_Barra = $_POST["cli"];
		$oCliente->Clave = $_POST["clav"];
		$oCliente->ConsultarCodBarras();
//		$Msg .= " 3: ".$oCliente->Alerta." - Cant: ".$oCliente->nCant;

		if($oVenta->Error == false){
			if($oVenta->nCant == 0){
				$oVenta->Nro_Ventas = $_POST["nrof"];
				$oVenta->Fecha_Ventas = $fecha;
				$oVenta->Clientes_Ventas = $oCliente->Id_Cliente;
				$oVenta->Total_Ventas = 0;
				$oVenta->Estado_Ventas = 0;
				$oVenta->Adicionar();
//				$Msg .= " 4: ".$oVenta->Alerta." Id: ".$oCliente->Id_Cliente;
				$oVentaLineas->Nro_VentasLineas = $_POST["nrof"];
				$oVentaLineas->Nro_Lin_VentasLineas = 1;
				$oVentaLineas->Cod_Prod_VentasLineas = $_POST["prod"];
				$oVentaLineas->Nom_Prod_VentasLineas = $oProd->Descripcion_Producto;
				$oVentaLineas->Val_Unit_VentasLineas = $oProd->Valor_Producto;
				$oVentaLineas->Cant_VentasLineas = $_POST["cant"];
				$oVentaLineas->Total_VentasLineas = ($oProd->Valor_Producto * $_POST["cant"]);
				$oVentaLineas->Adicionar();
//				$Msg .= " 5: ".$oVentaLineas->Alerta;
			}
			else{
				$oVentaLineas->Nro_VentasLineas = $_POST["nrof"];
				$oVentaLineas->SigLinea();
//				$Msg .= " 6: ".$oVentaLineas->Alerta;
				$oSigLin = $oVentaLineas->nCant;
				$oVentaLineas->Nro_Lin_VentasLineas = $oSigLin;
				$oVentaLineas->Cod_Prod_VentasLineas = $_POST["prod"];
				$oVentaLineas->Nom_Prod_VentasLineas = $oProd->Descripcion_Producto;
				$oVentaLineas->Val_Unit_VentasLineas = $oProd->Valor_Producto;
				$oVentaLineas->Cant_VentasLineas = $_POST["cant"];
				$oVentaLineas->Total_VentasLineas = ($oProd->Valor_Producto * $_POST["cant"]);
				$oVentaLineas->Adicionar();
//				$Msg .= " 7: ".$oVentaLineas->Alerta;
			}
//			$Msg .= " 8: ".$oVentaLineas->Alerta;

			$oVentaLineas->Nro_VentasLineas = $_POST["nrof"];
			$oVentaLineas->Listar();
//			$Msg .= " 9: ".$oVentaLineas->Alerta." - Cant: ".$oVentaLineas->nCant;
			if($oVentaLineas->Error == false){
				if($oVentaLineas->nCant > 0){
					$cadenaSalida .= "<table style='width:100%'>";
					for($i = 0; $i < $oVentaLineas->nCant; $i++)
					{
						$cadenaSalida .= "<tr>";
						$cadenaSalida .= "<td>".$oVentaLineas->LstRegistros[$i]["Nro_Lin_VentasLineas"]."</td>";
						$cadenaSalida .= "<td>".$oVentaLineas->LstRegistros[$i]["Cod_Prod_VentasLineas"]."</td>";
						$cadenaSalida .= "<td>".$oVentaLineas->LstRegistros[$i]["Nom_Prod_VentasLineas"]."</td>";
						$cadenaSalida .= "<td>".$oVentaLineas->LstRegistros[$i]["Val_Unit_VentasLineas"]."</td>";
						$cadenaSalida .= "<td>".$oVentaLineas->LstRegistros[$i]["Cant_VentasLineas"]."</td>";
						$cadenaSalida .= "<td>".$oVentaLineas->LstRegistros[$i]["Total_VentasLineas"]."</td>";
						$cadenaSalida .= "</tr>";
					}
					$cadenaSalida .= "</table>";
				}
			}
			$oVentaLineas->Nro_VentasLineas = $_POST["nrof"];
			$oVentaLineas->TotalLineas();
			$arrResult[0] = $oVentaLineas->nCant;
			$arrResult[1] = ($oCliente->Saldo - $oVentaLineas->nCant);
			$arrResult[2] = $cadenaSalida;
			$arrResult[3] = $Msg;
		}
		else{
			$arrResult[0] = "0";
			$arrResult[1] = "0";
			$arrResult[2] = $cadenaSalida;
			$arrResult[3] = "Error Ventas. ".$oVenta->Alerta;
		}
		//$arrResult[0] = "No existe. ".$oProd->Alerta;		$arrResult[2] = $Msg;
        echo json_encode($arrResult);
	break;
	case "CrearVta":
		$arrResult = array();
		$Msg = "";

		$oProd = new Productos();
		$oCliente = new Clientes();
		$oVenta = new Ventas();
		$oVentaLineas = new VentasLineas();

		$oVenta->Nro_Ventas = $_POST["nrof"];
		$oVenta->Consultar();
		//$Msg .= " 1: ".$oVenta->Alerta." - Cant: ".$oVenta->nCant." - Cliente: ".$oVenta->Clientes_Ventas;

		$oCliente->Id_Cliente = $oVenta->Clientes_Ventas;
		$oCliente->Consultar();
		//$Msg .= " 2: ".$oCliente->Alerta." - Saldo: ".$oCliente->Saldo;
		$SaldoAct = $oCliente->Saldo;
		$oCliente->Saldo = $SaldoAct - $_POST["vlrtot"];
		$oCliente->ActualizarSaldo();
		//$Msg .= " 3: ".$oCliente->Alerta." - Saldo: ".$oCliente->Saldo;

		$oVentaLineas->Nro_VentasLineas = $_POST["nrof"];
		$oVentaLineas->Listar();
		if($oVentaLineas->Error == false){
			if($oVentaLineas->nCant > 0){
				for($i = 0; $i < $oVentaLineas->nCant; $i++)
				{
					$oProd->Codigo_Producto = $oVentaLineas->LstRegistros[$i]["Cod_Prod_VentasLineas"];
					$oProd->ConsultarCodigo();
					$SaldoDisp = $oProd->Saldo_Producto;
					$oProd->Saldo_Producto = $SaldoDisp - $oVentaLineas->LstRegistros[$i]["Cant_VentasLineas"];
					$oProd->ActualizarDisponible();
				}
			}
		}
		$oVenta->Nro_Ventas = $_POST["nrof"];
		$oVenta->Total_Ventas = $_POST["vlrtot"];
		$oVenta->Justificacion_Ventas = $_POST["just"];
		$oVenta->Estado_Ventas = 1;
		$oVenta->GuardarVenta();

		$oVenta->SigNro();
		$arrResult[0] = $oVenta->nCant;
		$arrResult[1] = $Msg;
        echo json_encode($arrResult);
	break;
	case "CargarCliente":
		$arrResult = array();
		date_default_timezone_set("America/Bogota");
		$hoy = getdate();
		$fecha = $hoy['year']."-";
		if ($hoy['mon'] < 10)
			$fecha .= "0";
		$fecha .= $hoy['mon']."-";
		if ($hoy['mday'] < 10)
			$fecha .= "0";
		$fecha .= $hoy['mday'];
		$Msg = "";
		$NroRec = $_POST["nro"];
		$oCliente = new Clientes();
		$oRecarga = new Recargas();
		$oCliente->Codigo_Barra = $_POST["clie"];
		$oCliente->ConsultarCodigo();

		$oRecarga->Nro = $_POST["nro"];
		$oRecarga->Fecha = $fecha;
		$oRecarga->Cliente = $oCliente->Id_Cliente;
		$oRecarga->Factura= $_POST["fra"];
		$oRecarga->Valor = $_POST["vlr"];
		$oRecarga->Observaciones = $_POST["obs"];
		$oRecarga->Estado = "0";
		$oRecarga->Adicionar();
		if($oRecarga->Error == false){
			$Msg .= "Creó Historial";
			$SaldoAct = $oCliente->Saldo;
			$oCliente->Saldo = $SaldoAct + $_POST["vlr"];
			$oCliente->ActualizarSaldo();

			$oRecarga->SigNro();
			$NroRec = $oRecarga->nCant;
		}
		else{
			$Msg .= "Error: ".$oRecarga->Alerta;
		}


		$arrResult[0] = $NroRec;
		$arrResult[1] = $oCliente->Saldo;
		$arrResult[2] = $Msg;
        echo json_encode($arrResult);
	break;
	case "CorreoVenta":
		$arrResult = array();
		$oCliente = new Clientes();
		$oCliente->Codigo_Barra = $_POST["cli"];
		$oCliente->ConsultarCodigo();
		$txtEmail = $oCliente->Correo;
		$Nombre = $oCliente->Nombre;
		$Saldo = $oCliente->Saldo;
		$PrecioTotal = 0;
		$oVenta = new Ventas();
		$oVenta->Nro_Ventas = $_POST["nrof"];
		$oVenta->Consultar();
		$Destinatario = $txtEmail;
		$Asunto = "Venta Coffee";
		$Cuerpo = "<html>
			<head>
			   <title>Venta Coffee</title>
			</head>
			<body>
			<h1>Coffee le Saluda!</h1>
			<p>
			<b>Su Venta Nro ".$oVenta->Nro_Ventas." a nombre de ".$Nombre." ha sido creada exitosamente y esta compuesta por los siguientes art&iacute;culos. <br /><br />";
			$oVentaLineas = new VentasLineas();
			$oVentaLineas->Nro_VentasLineas = $_POST["nrof"];
			$oVentaLineas->Listar();
			if($oVentaLineas->nCant > 0)
			{
				for($i = 0; $i < $oVentaLineas->nCant; $i++)
				{
					$Cuerpo .= "Art&iacute;culo ".($i+1).": ".$oVentaLineas->LstRegistros[$i]["Nom_Prod_VentasLineas"]."<br />";
					$Cuerpo .= "Cantidad: ".$oVentaLineas->LstRegistros[$i]["Cant_VentasLineas"]."<br />";
					$Cuerpo .= "Precio: ".$oVentaLineas->LstRegistros[$i]["Val_Unit_VentasLineas"]."<br />";
					$Cuerpo .= "<br />";
					$PrecioTotal += ($oVentaLineas->LstRegistros[$i]["Val_Unit_VentasLineas"]*$oVentaLineas->LstRegistros[$i]["Cant_VentasLineas"]);
				}
			}
			$Cuerpo .= "<br />Valor Total Venta: ".$PrecioTotal;
			$Cuerpo .= "<br />Su Nuevo saldo es: ".$Saldo;
			if($_POST["just"] != ""){
				$Cuerpo .= "<br />Su Justificación es: ".$_POST["just"];
			}
			$Cuerpo .= "<br /><br />Att: Sistemas
			</p>
			</body>
			</html> ";
		//para el envío en formato HTML
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

		//dirección del remitente
		$headers .= "From: Coffee Web <SU CORREO>\r\n";

		//direcciones que recibián copia
		$headers .= "Cc: SU CORREO\r\n";
		//echo $Cuerpo;
		mail($Destinatario,$Asunto,$Cuerpo,$headers);
		$arrResult[0] = "OK";
        echo json_encode($arrResult);
	break;
	case "CrearProveedor":
		$arrResult = array();
		$Msg = "";
		$oProv = new Proveedores();
		$oProv->SigId();
		$nIdProv = $oProv->nCant;
		$oProv->Id_Proveedores = $nIdProv;
		$oProv->Nit_Proveedores = $_POST["nit"];
		$oProv->Nom_Proveedores = $_POST["nomb"];
		$oProv->Direccion_Proveedores = $_POST["dir"];
		$oProv->Telefono_Proveedores = $_POST["telef"];
		$oProv->Correo_Proveedores = $_POST["corr"];
		$oProv->Adicionar();
		if($oProv->Error == false){
			$oProv->SigId();
			$nIdProv = $oProv->nCant;
			$arrResult[0] = "OK";
			$arrResult[1] = $nIdProv;
		}
		else{
			$arrResult[0] = $oProv->Alerta;
			$arrResult[1] = $nIdProv;
		}
        echo json_encode($arrResult);
	break;
	case "ConsultarProveedor":
		$arrResult = array();
		$oProv = new Proveedores();
		$oProv->Nit_Proveedores = $_POST["prov"];
		$oProv->ConsultarNit();
		if($oProv->nCant > 0){
			$arrResult[0] = "OK";
			$arrResult[1] = $oProv->Nom_Proveedores;
		}
		else{
			$arrResult[0] = "El Proveedor NO existe. ";
			$arrResult[1] = 0;
		}
        echo json_encode($arrResult);
	break;
	case "AgregarProductoComp":
		$arrResult = array();

		date_default_timezone_set("America/Bogota");
		$hoy = getdate();
		$fecha = $hoy['year']."-";
		if ($hoy['mon'] < 10)
			$fecha .= "0";
		$fecha .= $hoy['mon']."-";
		if ($hoy['mday'] < 10)
			$fecha .= "0";
		$fecha .= $hoy['mday'];

		$Msg = "";
		$cadenaSalida = "";

		$oProd = new Productos();
		$oProv = new Proveedores();
		$oCompra = new Entradas();
		$oCompraLineas = new EntradasLineas();

		$oProd->Codigo_Producto = $_POST["prod"];
		$oProd->ConsultarCodigo();
		//$Msg .= " 1: ".$oProd->Alerta;

		$oCompra->Nro_Entrada = $_POST["nroComp"];
		$oCompra->Consultar();
		//$Msg .= " 2: ".$oCompra->Alerta." - Cant: ".$oCompra->nCant." - Entrada: ".$_POST["nroComp"];

		$oProv->Nit_Proveedores = $_POST["prov"];
		$oProv->ConsultarNit();
		//$Msg .= " 3: ".$oProv->Alerta." - Cant: ".$oProv->nCant;

		if($oCompra->Error == false){
			if($oCompra->nCant == 0){
				$oCompra->Nro_Entrada = $_POST["nroComp"];
				$oCompra->Fecha_Entrada = $fecha;
				$oCompra->Cod_Prov_Entrada = $oProv->Id_Proveedores;
				$oCompra->Nro_fact_Entrada = $_POST["fra"];
				$oCompra->Total_Entrada = 0;
				$oCompra->Estado_Entrada = 0;
				$oCompra->Adicionar();
				//$Msg .= " 4: ".$oCompra->Alerta." Id: ".$oProv->Id_Proveedores;
				$oCompraLineas->Nro_EntradaLineas = $_POST["nroComp"];
				$oCompraLineas->Linea_EntradaLineas = 1;
				$oCompraLineas->Cod_Prod_EntradaLineas = $_POST["prod"];
				$oCompraLineas->Nombre_Prod_EntradaLineas = $oProd->Descripcion_Producto;
				$oCompraLineas->Costo_unit_EntradaLineas = $_POST["cost"];
				$oCompraLineas->Cant_EntradaLineas = $_POST["cant"];
				$oCompraLineas->Vlr_Vta_EntradaLineas = $_POST["vlr"];
				$oCompraLineas->Total_EntradaLineas = ($_POST["cost"] * $_POST["cant"]);
				$oCompraLineas->Adicionar();
				//$Msg .= " 5: ".$oCompraLineas->Alerta;
			}
			else{
				$oCompraLineas->Nro_EntradaLineas = $_POST["nroComp"];
				$oCompraLineas->SigLinea();
				//$Msg .= " 6: ".$oCompraLineas->Alerta;
				$oSigLin = $oCompraLineas->nCant;
				$oCompraLineas->Nro_EntradaLineas = $_POST["nroComp"];
				$oCompraLineas->Linea_EntradaLineas = $oSigLin;
				$oCompraLineas->Cod_Prod_EntradaLineas = $_POST["prod"];
				$oCompraLineas->Nombre_Prod_EntradaLineas = $oProd->Descripcion_Producto;
				$oCompraLineas->Costo_unit_EntradaLineas = $_POST["cost"];
				$oCompraLineas->Cant_EntradaLineas = $_POST["cant"];
				$oCompraLineas->Vlr_Vta_EntradaLineas = $_POST["vlr"];
				$oCompraLineas->Total_EntradaLineas = ($_POST["cost"] * $_POST["cant"]);
				$oCompraLineas->Adicionar();
				//$Msg .= " 7: ".$oCompraLineas->Alerta;
			}
//			$Msg .= " 8: ".$oVentaLineas->Alerta;

			$oCompraLineas->Nro_EntradaLineas = $_POST["nroComp"];
			$oCompraLineas->Listar();
//			$Msg .= " 9: ".$oVentaLineas->Alerta." - Cant: ".$oVentaLineas->nCant;
			if($oCompraLineas->Error == false){
				if($oCompraLineas->nCant > 0){
					$cadenaSalida .= "<table style='width:100%'>";
					for($i = 0; $i < $oCompraLineas->nCant; $i++)
					{
						$cadenaSalida .= "<tr>";
						$cadenaSalida .= "<td>".$oCompraLineas->LstRegistros[$i]["Linea_EntradaLineas"]."</td>";
						$cadenaSalida .= "<td>".$oCompraLineas->LstRegistros[$i]["Cod_Prod_EntradaLineas"]."</td>";
						$cadenaSalida .= "<td>".$oCompraLineas->LstRegistros[$i]["Nombre_Prod_EntradaLineas"]."</td>";
						$cadenaSalida .= "<td>".$oCompraLineas->LstRegistros[$i]["Costo_unit_EntradaLineas"]."</td>";
						$cadenaSalida .= "<td>".$oCompraLineas->LstRegistros[$i]["Cantidad_EntradaLineas"]."</td>";
						$cadenaSalida .= "<td>".$oCompraLineas->LstRegistros[$i]["Vlr_Vta_EntradaLineas"]."</td>";
						$cadenaSalida .= "<td>".$oCompraLineas->LstRegistros[$i]["Valor_EntradaLineas"]."</td>";
						$cadenaSalida .= "</tr>";
					}
					$cadenaSalida .= "</table>";
				}
			}
			$oCompraLineas->Nro_EntradaLineas = $_POST["nroComp"];
			$oCompraLineas->TotalLineas();
			$arrResult[0] = "OK";
			$arrResult[1] = $oCompraLineas->nCant;
			$arrResult[2] = $cadenaSalida;
			$arrResult[3] = $Msg;
		}
		else{
			$arrResult[0] = "0";
			$arrResult[1] = "0";
			$arrResult[2] = $cadenaSalida;
			$arrResult[3] = "Error Entradas. ".$oCompra->Alerta;
		}
		//$arrResult[0] = "No existe. ".$oProd->Alerta;
		//$arrResult[1] = $Msg;
        echo json_encode($arrResult);
	break;
	case "CrearCompra":
		$arrResult = array();
		$Msg = "";

		$oProd = new Productos();
		$oProv = new Proveedores();
		$oCompra = new Entradas();
		$oCompraLineas = new EntradasLineas;

		$oCompra->Nro_Entrada = $_POST["nroC"];
		$oCompra->Consultar();
		//$Msg .= " 1: ".$oCompra->Alerta." - Cant: ".$oCompra->nCant;

		$oCompraLineas->Nro_EntradaLineas = $_POST["nroC"];
		$oCompraLineas->Listar();
		if($oCompraLineas->Error == false){
			if($oCompraLineas->nCant > 0){
				for($i = 0; $i < $oCompraLineas->nCant; $i++)
				{
					$oProd->Codigo_Producto = $oCompraLineas->LstRegistros[$i]["Cod_Prod_EntradaLineas"];
					$oProd->ConsultarCodigo();
					$SaldoDisp = $oProd->Saldo_Producto;
					$oProd->Saldo_Producto = $SaldoDisp + $oCompraLineas->LstRegistros[$i]["Cantidad_EntradaLineas"];
					$oProd->ActualizarDisponible();
					$oProd->Costo_Producto = $oCompraLineas->LstRegistros[$i]["Costo_unit_EntradaLineas"];
					$oProd->Valor_Producto = $oCompraLineas->LstRegistros[$i]["Vlr_Vta_EntradaLineas"];
					$oProd->ActualizarPrecio();
				}
			}
		}
		$oCompra->Total_Entrada = $_POST["vlrtot"];
		$oCompra->Nro_fact_Entrada = $_POST["frac"];
		$oCompra->Estado_Entrada = 1;
		$oCompra->GuardarEntrada();

		$oCompra->SigNro();
		$arrResult[0] = $oCompra->nCant;
		$arrResult[1] = $Msg;
//		$arrResult[0] = "Error";
//		$arrResult[1] = $Msg;
        echo json_encode($arrResult);
	break;
	case "CorreoCompra":
		$arrResult = array();
		$oProv = new Proveedores;
		$oProv->Nit_Proveedores = $_POST["prov"];
		$oProv->ConsultarNit();
		$Nombre = $oProv->Nom_Proveedores;
		$PrecioTotal = 0;
		$oCompra = new Entradas;
		$oCompra->Nro_Entrada = $_POST["nroC"];
		$oCompra->Consultar();
		$Destinatario = "SU CORREO";
		$Asunto = "Compra Productos";
		$Cuerpo = "Ingreso";
		$Cuerpo = "<html>
			<head>
			   <title>Compra Productos Coffee</title>
			</head>
			<body>
			<h1>Coffee le Saluda!</h1>
			<p>
			<b>Se realiz&oacute; una compra de productos con el Nro ".$oCompra->Nro_Entrada." al proveedor ".$Nombre." exitosamente y esta compuesta por los siguientes art&iacute;culos. <br /><br />";
			$oCompraLineas = new EntradasLineas();
			$oCompraLineas->Nro_EntradaLineas = $_POST["nroC"];
			//$oCompraLineas->Error = false;
			$oCompraLineas->Listar();
			if($oCompraLineas->Error == false){
				if($oCompraLineas->nCant > 0){
					for($i = 0; $i < $oCompraLineas->nCant; $i++)
					{
						$Cuerpo .= "Art&iacute;culo ".($i+1).": ".$oCompraLineas->LstRegistros[$i]["Nombre_Prod_EntradaLineas"]."<br />";
						$Cuerpo .= "Cantidad: ".$oCompraLineas->LstRegistros[$i]["Cantidad_EntradaLineas"]."<br />";
						$Cuerpo .= "Costo: ".$oCompraLineas->LstRegistros[$i]["Costo_unit_EntradaLineas"]."<br />";
						$Cuerpo .= "Precio Venta: ".$oCompraLineas->LstRegistros[$i]["Vlr_Vta_EntradaLineas"]."<br />";
						$Cuerpo .= "<br />";
						$PrecioTotal += ($oCompraLineas->LstRegistros[$i]["Costo_unit_EntradaLineas"]*$oCompraLineas->LstRegistros[$i]["Cantidad_EntradaLineas"]);
					}
				}
				$Cuerpo .= "<br />Cant Artículos: ".$oCompraLineas->nCant;
			}
			else{
				$Cuerpo .= "<br />Error al cargar lista";
			}
			$Cuerpo .= "<br />Valor Total Compra: ".$PrecioTotal;
			$Cuerpo .= "<br /><br />Att: Sistemas
			</p>
			</body>
			</html> ";
		//para el envío en formato HTML
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

		//dirección del remitente
		$headers .= "From: Coffee Web <SU CORREO>\r\n";

		//direcciones que recibián copia
		//$headers .= "Cc: SU CORREO\r\n";
		//echo $Cuerpo;
		mail($Destinatario,$Asunto,$Cuerpo,$headers);
		$arrResult[0] = "OK";
		//8$arrResult[1] = $Cuerpo;
        echo json_encode($arrResult);
	break;
	case "CrearProductos":
		$arrResult = array();
		$Msg = "";
		$oProd = new Productos();
		$oProd->SigId();
		$nIdProd = $oProd->nCant;
		$oProd->Id_Producto = $nIdProd;
		$oProd->Codigo_Producto = $_POST["codp"];
		$oProd->Descripcion_Producto = $_POST["desc"];
		$oProd->Costo_Producto = $_POST["cost"];
		$oProd->Saldo_Producto = $_POST["sal"];
		$oProd->Valor_Producto = $_POST["val"];
		$oProd->Adicionar();
		if($oProd->Error == false){
			$oProd->SigId();
			$nIdProd = $oProd->nCant;
			$arrResult[0] = "OK";
			$arrResult[1] = $nIdProd;
		}
		else{
			$arrResult[0] = $oProd->Alerta;
			$arrResult[1] = $nIdProd;
		}
        echo json_encode($arrResult);
	break;
	case "CrearClientes":
		$arrResult = array();
		$Msg = "";
		$oCliente = new Clientes();
		$oCliente->SigId();
		$nIdClie = $oCliente->nCant;
		$oCliente->Id_Cliente = $nIdClie;
		$oCliente->Codigo_Barra = $_POST["codb"];
		$oCliente->Nombre = $_POST["nom"];
		$oCliente->Numero_Identidad = $_POST["nro"];
		$oCliente->Tipo_Identidad = $_POST["tipid"];
		$oCliente->Correo = $_POST["cor"];
		$oCliente->Clave = $_POST["clav"];
		$oCliente->Justifica = $_POST["just"];
		$oCliente->Saldo = $_POST["sal"];
		$oCliente->Adicionar();
		if($oCliente->Error == false){
			$oCliente->SigId();
			$nIdClie = $oCliente->nCant;
			$arrResult[0] = "OK";
			$arrResult[1] = $nIdClie;
		}
		else{
			$arrResult[0] = $oCliente->Alerta;
			$arrResult[1] = $nIdClie;
		}
        echo json_encode($arrResult);
	break;
	case "CrearUsuarios":
		$arrResult = array();
		$Msg = "";
		$oUsuar = new Usuarios();
		$oUsuar->SigId();
		$nIdUsua = $oUsuar->nCant;
		$oUsuar->Id_Usuario = $nIdUsua;
		$oUsuar->Numero_Identidad = $_POST["nro"];
		$oUsuar->Nombre = $_POST["nom"];
		$oUsuar->Clave = $_POST["clav"];
		$oUsuar->Perfil = $_POST["perf"];
		$oUsuar->Adicionar();
		if($oUsuar->Error == false){
			$oUsuar->SigId();
			$nIdUsua = $oUsuar->nCant;
			$arrResult[0] = "OK";
			$arrResult[1] = $nIdUsua;
		}
		else{
			$arrResult[0] = $oUsuar->Alerta;
			$arrResult[1] = $nIdUsua;
		}
		//$arrResult[0] = "Error2 ".$nIdUsua;
		//$arrResult[1] = "10";
        echo json_encode($arrResult);
	break;
	case "Informes":
		$arrResult = array();
		$Msg = "";
		$Listado = "";
		$TipoInf = $_POST["tipInf"];
		$Total = 0;
		switch($TipoInf){
			case "Usua":
				$oListado = new Usuarios();
				$oListado->Listar();
				$SinExistencias = "<td colspan='5'>No hay Usuarios";
			break;
			case "Prov":
				$oListado = new Proveedores();
				$oListado->Listar();
				$SinExistencias = "<td colspan='6'>No hay Proveedores";
			break;
			case "Prod":
				$oListado = new Productos();
				$oListado->Listar();
				$SinExistencias = "<td colspan='6'>No hay Productos";
			break;
			case "Clie":
				$oListado = new Clientes();
				$oListado->Listar();
				$SinExistencias = "<td colspan='5'>No hay Clientes";
			break;
			case "CarTar":
				$oListado = new Recargas();
				$oListado->Param01 = $_POST["fechI"];
				$oListado->Param02 = $_POST["fechF"];
				$oListado->ListarIntervalo();
				$SinExistencias = "<td colspan='8'>No hay Registro de Cargue de Tarjetas";
			break;
			case "Vtas":
				$oListado = new Ventas();
				$oListado->Param01 = $_POST["fechI"];
				$oListado->Param02 = $_POST["fechF"];
				$oListado->ListarIntervalo();
				$SinExistencias = "<td colspan='6'>No hay Ventas";
			break;
			case "Entr":
				$oListado = new Entradas();
				$oListado->Param01 = $_POST["fechI"];
				$oListado->Param02 = $_POST["fechF"];
				$oListado->ListarIntervalo();
				$SinExistencias = "<td colspan='6'>No hay Entradas";
			break;
			case "InfDiaVtas":
				$oListado = new Informes();
				$oListado->Param01 = $_POST["fechI"];
				$oListado->Param02 = $_POST["fechF"];
				$oListado->InformeVentas();
				$SinExistencias = "<td colspan='8'>No hay Registros";
			break;
			case "InfArtClie":
				$oListado = new Informes();
				$oListado->Param01 = $_POST["fechI"];
				$oListado->Param02 = $_POST["fechF"];
				$oListado->ListarArtXCliente();
				$SinExistencias = "<td colspan='6'>No hay Registros. ";
			break;
			case "InfDiaCompras":
				$oListado = new Informes();
				$oListado->Param01 = $_POST["fechI"];
				$oListado->Param02 = $_POST["fechF"];
				$oListado->InformeCompras();
				$SinExistencias = "<td colspan='8'>No hay Registros";
			break;
		}
		if($oListado->nCant > 0){
			for($i = 0; $i < $oListado->nCant; $i++){
				switch($TipoInf){
					case "Usua":
						$Listado .= "<tr>";
						$Listado .= "<td>".($i+1)."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Numero_Identidad"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Nombre"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Clave"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Perfil"]."</td>";
						$Listado .= "</tr>";
					break;
					case "Prov":
						$Listado .= "<tr>";
						$Listado .= "<td>".($i+1)."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Nit_Proveedores"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Nom_Proveedores"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Direccion_Proveedores"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Telefono_Proveedores"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Correo_Proveedores"]."</td>";
						$Listado .= "</tr>";
					break;
					case "Prod":
						$Listado .= "<tr>";
						$Listado .= "<td>".($i+1)."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Codigo_Producto"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Descripcion_Producto"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Costo_Producto"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Saldo_Producto"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Valor_Producto"]."</td>";
						$Listado .= "</tr>";
					break;
					case "Clie":
						$Listado .= "<tr>";
						$Listado .= "<td>".($i+1)."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Numero_Identidad"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Nombre"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Correo"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Saldo"]."</td>";
						$Listado .= "</tr>";
						$Total += $oListado->LstRegistros[$i]["Saldo"];
					break;
					case "CarTar":
						$Listado .= "<tr>";
						$Listado .= "<td>".($i+1)."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Nro"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Fecha"]."</td>";
						$oCli = new Clientes();
						$oCli->Id_Cliente = $oListado->LstRegistros[$i]["Cliente"];
						$oCli->Consultar();
						$Listado .= "<td>".$oCli->Nombre."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Factura"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Valor"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Observaciones"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Estado"]."</td>";
						$Listado .= "</tr>";
						$Total += $oListado->LstRegistros[$i]["Valor"];
					break;
					case "Vtas":
						$Listado .= "<tr>";
						$Listado .= "<td>".($i+1)."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Nro_Ventas"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Fecha_Ventas"]."</td>";
						$oCli = new Clientes();
						$oCli->Id_Cliente = $oListado->LstRegistros[$i]["Clientes_Ventas"];
						$oCli->Consultar();
						$Listado .= "<td>".$oCli->Nombre."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Total_Ventas"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Justificacion_Ventas"]."</td>";
						$Listado .= "</tr>";
						$Total += $oListado->LstRegistros[$i]["Total_Ventas"];
					break;
					case "Entr":
						$Listado .= "<tr>";
						$Listado .= "<td>".($i+1)."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Nro_Entrada"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Fecha_Entrada"]."</td>";
						$oProv = new Proveedores();
						$oProv->Id_Proveedores = $oListado->LstRegistros[$i]["Cod_Prov_Entrada"];
						$oProv->Consultar();
						$Listado .= "<td>".$oProv->Nom_Proveedores."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Nro_fact_Entrada"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Total_Entrada"]."</td>";
						$Listado .= "</tr>";
						$Total += $oListado->LstRegistros[$i]["Total_Entrada"];
					break;
					case "InfDiaVtas":
						$Listado .= "<tr>";
						$Listado .= "<td>".($i+1)."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Nro"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Fecha"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Cliente"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["CodProducto"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Descripcion"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["VlrUnit"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Cantidad"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Total"]."</td>";
						$Listado .= "</tr>";
						$Total += $oListado->LstRegistros[$i]["Total"];
					break;
					case "InfArtClie":
						$Listado .= "<tr>";
						$Listado .= "<td>".($i+1)."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Cliente"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["CodProducto"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Descripcion"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Cantidad"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Total"]."</td>";
						$Listado .= "</tr>";
						$Total += $oListado->LstRegistros[$i]["Total"];
					break;
					case "InfDiaCompras":
						$Listado .= "<tr>";
						$Listado .= "<td>".($i+1)."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Nro"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Fecha"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Cliente"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["CodProducto"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Descripcion"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["VlrUnit"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Cantidad"]."</td>";
						$Listado .= "<td>".$oListado->LstRegistros[$i]["Total"]."</td>";
						$Listado .= "</tr>";
						$Total += $oListado->LstRegistros[$i]["Total"];
					break;
				}
			}
			switch($TipoInf){
				case "Clie":
					$Listado .= "<tr><td colspan='4'><b>Total</b></td><td><b>".$Total."</b></td></tr>";
				break;
				case "Vtas":
				case "InfArtClie":
					$Listado .= "<tr><td colspan='5'><b>Total</b></td><td><b>".$Total."</b></td></tr>";
				break;
				case "Entr":
					$Listado .= "<tr><td colspan='6'><b>Total</b></td><td><b>".$Total."</b></td></tr>";
				break;
				case "CarTar":
				case "InfDiaVtas":
				case "InfDiaCompras":
					$Listado .= "<tr><td colspan='7'><b>Total</b></td><td><b>".$Total."</b></td></tr>";
				break;
			}
		}
		else{
			$Listado .= "<tr>".$SinExistencias."</td></tr>";
		}
		//$Listado .= "</table>";
		$arrResult[0] = "OK";
		$arrResult[1] = $Listado;
        echo json_encode($arrResult);
	break;
	case "a":
		$arrResult = array();
		$Msg = "";
		$arrResult[0] = "0";
		$arrResult[1] = $Msg;
        echo json_encode($arrResult);
	break;
}
