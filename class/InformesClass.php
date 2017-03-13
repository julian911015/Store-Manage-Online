<?php
//header ('Content-type: text/html; charset=utf-8');
include_once("Modelo.php");
date_default_timezone_set("America/Bogota"); 

class Informes
{
	var $Campo_01;
	var $Campo_02;
	var $Campo_03;
	var $Campo_04;
	var $Campo_05;
	var $Campo_06;
	var $Campo_07;
	var $Campo_08;
	
	var $Param01;
	var $Param02;
	
	var $LstRegistros;
	var $Error;
	var $nCant;
	var $Alerta;

	function InformeVentas()
	{
		$Sql = "SELECT TB1.nro_vent, TB1.fecha_vent, TB3.nombre_clie, TB2.cod_prod_venl, TB4.descrip_prod, TB2.valor_unit_venl, TB2.cant_venl, (TB2.valor_unit_venl * TB2.cant_venl), TB1.justif_vent FROM ventas AS TB1 INNER JOIN ventaslineas AS TB2 ON TB2.nro_venl = TB1.nro_vent INNER JOIN clientes AS TB3 ON TB3.id_clie = TB1.cliente_vent INNER JOIN productos AS TB4 ON TB4.codigo_prod = TB2.cod_prod_venl WHERE TB1.fecha_vent BETWEEN '".$this->Param01."' AND '".$this->Param02."'";
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$oModelo->VariosRegs = true;
		$nCont = 0;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				while($nCont < $oModelo->CantReg)
				{
					$this->LstRegistros[$nCont]["Nro"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["Fecha"] = $oModelo->ListaRegistros[$nCont][1];
					$this->LstRegistros[$nCont]["Cliente"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["CodProducto"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Descripcion"] = $oModelo->ListaRegistros[$nCont][4];
					$this->LstRegistros[$nCont]["VlrUnit"] = $oModelo->ListaRegistros[$nCont][5];
					$this->LstRegistros[$nCont]["Cantidad"] = $oModelo->ListaRegistros[$nCont][6];
					$this->LstRegistros[$nCont]["Total"] = $oModelo->ListaRegistros[$nCont][7];
					$this->LstRegistros[$nCont]["Justificacion"] = $oModelo->ListaRegistros[$nCont][8];

					$nCont++;
				}
				$this->Error = false;
				$this->nCant = $nCont;
			}
			else
			{
				$this->Error = false;
				$this->nCant = 0;
			}
		}
		else
		{
			$this->Error = true;
			$this->nCant = 0;
			$this->Alerta = "Se present&oacute; un error al consultar la informaci&oacute;n. Sentencia: ".$Sql;
		}
	}


	function InformeCompras()
	{
		$Sql = "SELECT TB1.nro_entr, TB1.fecha_entr, TB3.nombre_prov, TB2.cod_prod_entl, TB4.descrip_prod, TB2.costo_unit_entl, TB2.cant_entl, (TB2.costo_unit_entl * TB2.cant_entl) FROM entradas AS TB1 INNER JOIN entradas_lineas AS TB2 ON TB2.nro_entl = TB1.nro_entr INNER JOIN proveedores AS TB3 ON TB3.id_prov = TB1.cod_prov_entr INNER JOIN productos AS TB4 ON TB4.codigo_prod = TB2.cod_prod_entl WHERE TB1.fecha_entr BETWEEN '".$this->Param01."' AND '".$this->Param02."'";
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$oModelo->VariosRegs = true;
		$nCont = 0;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				while($nCont < $oModelo->CantReg)
				{
					$this->LstRegistros[$nCont]["Nro"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["Fecha"] = $oModelo->ListaRegistros[$nCont][1];
					$this->LstRegistros[$nCont]["Cliente"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["CodProducto"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Descripcion"] = $oModelo->ListaRegistros[$nCont][4];
					$this->LstRegistros[$nCont]["VlrUnit"] = $oModelo->ListaRegistros[$nCont][5];
					$this->LstRegistros[$nCont]["Cantidad"] = $oModelo->ListaRegistros[$nCont][6];
					$this->LstRegistros[$nCont]["Total"] = $oModelo->ListaRegistros[$nCont][7];

					$nCont++;
				}
				$this->Error = false;
				$this->nCant = $nCont;
			}
			else
			{
				$this->Error = false;
				$this->nCant = 0;
			}
		}
		else
		{
			$this->Error = true;
			$this->nCant = 0;
			$this->Alerta = "Se present&oacute; un error al consultar la informaci&oacute;n. Sentencia: ".$Sql;
		}
	}

	function ListarArtXCliente()
	{
		$Sql = "SELECT T1.nombre_clie, T2.cod_prod_venl, T3.descrip_prod, SUM( T2.cant_venl ) AS Cant, SUM( T2.total_venl ) AS Total FROM ventas AS T0 INNER JOIN clientes AS T1 ON T1.id_clie = T0.cliente_vent INNER JOIN ventaslineas AS T2 ON T2.nro_venl = T0.nro_vent INNER JOIN productos AS T3 ON T3.codigo_prod = T2.cod_prod_venl WHERE T0.fecha_vent BETWEEN '".$this->Param01."' AND '".$this->Param02."' GROUP BY T1.nombre_clie, T2.cod_prod_venl, T3.descrip_prod ORDER BY 4 DESC";
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$this->Alerta = $Sql;
		$oModelo->VariosRegs = true;
		$oModelo->Consultar();
		$nCont = 0;
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				while($nCont < $oModelo->CantReg)
				{
					$this->LstRegistros[$nCont]["Cliente"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["CodProducto"] = $oModelo->ListaRegistros[$nCont][1];
					$this->LstRegistros[$nCont]["Descripcion"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["Cantidad"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Total"] = $oModelo->ListaRegistros[$nCont][4];
					$nCont++;
				}
				$this->Error = false;
				$this->nCant = $nCont;
			}
			else
			{
				$this->Error = false;
				$this->nCant = 0;
			}
		}
		else
		{
			$this->Error = true;
			$this->nCant = 0;
			$this->Alerta = "Se present&oacute; un error al consultar la informaci&oacute;n. Sentencia: ".$Sql;
		}
	}
}
?>