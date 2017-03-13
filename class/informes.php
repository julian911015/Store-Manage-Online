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
	
	var $param_01;
	var $param_02;
	var $param_03;
	
	var $LstRegistros;
	var $Error;
	var $nCant;
	var $Alerta;
	

	function Consultar()
	{
		$Sql = "SELECT id_clie, cod_bar_clie, nombre_clie, nro_ident_clie, tip_ident_clie, correo_clie, clave_clie, saldo_clie FROM clientes WHERE id_clie = ".$this->Id_Cliente;
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->Campo_01 = $oModelo->Registro[0];
				$this->Campo_02 = $oModelo->Registro[1];
				$this->Campo_03 = $oModelo->Registro[2];
				$this->Campo_04 = $oModelo->Registro[3];
				$this->Campo_05 = $oModelo->Registro[4];
				$this->Campo_06 = $oModelo->Registro[5];
				$this->Campo_07 = $oModelo->Registro[6];
				$this->Campo_08 = $oModelo->Registro[7];
			    $this->Error = false;
				$this->nCant = 1;
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

	function InformeDiarioVentas()
	{
		$Sql = "SELECT TB1.nro_vent, TB1.fecha_vent, TB3.nombre_clie, TB2.cod_prod_venl, TB4.descrip_prod, TB2.valor_unit_venl, TB2.cant_venl, (TB2.valor_unit_venl * TB2.cant_venl) FROM ventas AS TB1 INNER JOIN ventaslineas AS TB2 ON TB2.nro_venl = TB1.nro_vent INNER JOIN clientes AS TB3 ON TB3.id_clie = TB1.cliente_vent INNER JOIN productos AS TB4 ON TB4.codigo_prod = TB2.cod_prod_venl WHERE TB1.fecha_vent BETWEEN '".$this->param_01."' AND '".$this->param_02."'";
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->Campo_01 = $oModelo->Registro[0];
				$this->Campo_02 = $oModelo->Registro[1];
				$this->Campo_03 = $oModelo->Registro[2];
				$this->Campo_04 = $oModelo->Registro[3];
				$this->Campo_05 = $oModelo->Registro[4];
				$this->Campo_06 = $oModelo->Registro[5];
				$this->Campo_07 = $oModelo->Registro[6];
				$this->Campo_08 = $oModelo->Registro[7];
			    $this->Error = false;
				$this->nCant = 1;
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


	function Listar()
	{
		$Sql = "SELECT id_clie, cod_bar_clie, nombre_clie, nro_ident_clie, tip_ident_clie, correo_clie, clave_clie, saldo_clie FROM clientes ";
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$oModelo->VariosRegs = true;
		$oModelo->Consultar();
		$nCont = 0;
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				while($nCont < $oModelo->CantReg)
				{
					$this->LstRegistros[$nCont]["Campo_01"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["Campo_02"] = $oModelo->ListaRegistros[$nCont][1];
					$this->LstRegistros[$nCont]["Campo_03"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["Campo_04"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Campo_05"] = $oModelo->ListaRegistros[$nCont][4];
					$this->LstRegistros[$nCont]["Campo_06"] = $oModelo->ListaRegistros[$nCont][5];
					$this->LstRegistros[$nCont]["Campo_07"] = $oModelo->ListaRegistros[$nCont][6];
					$this->LstRegistros[$nCont]["Campo_08"] = $oModelo->ListaRegistros[$nCont][7];
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