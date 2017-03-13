<?php
//header ('Content-type: text/html; charset=utf-8');
// ESPECIFICA EN DETALLE LAS VENTAS
include_once("Modelo.php");
date_default_timezone_set("America/Bogota");

class VentasLineas
{
	var $Nro_VentasLineas;
	var $Nro_Lin_VentasLineas;
	var $Cod_Prod_VentasLineas;
    var $Nom_Prod_VentasLineas;
    var $Val_Unit_VentasLineas;
	var $Cant_VentasLineas;
	var $Total_VentasLineas;

    var $LstRegistros;
	var $Error;
	var $nCant;
	var $Alerta;

	function Adicionar()
	{
		$Sql = "INSERT INTO ventaslineas (nro_venl, nro_lin_venl, cod_prod_venl, nom_prod_venl, valor_unit_venl, cant_venl, total_venl) VALUES (".$this->Nro_VentasLineas.", ".$this->Nro_Lin_VentasLineas.", '".$this->Cod_Prod_VentasLineas."', '".$this->Nom_Prod_VentasLineas."', ".$this->Val_Unit_VentasLineas.", ".$this->Cant_VentasLineas.", ".$this->Total_VentasLineas.")";
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$this->Alerta = $Sql;
		$oModelo->Ejecutar();
		if ($oModelo->Error == false)
		{
			$this->Error = false;
		}
		else
		{
			$this->Error = true;
			$this->Alerta = "Se present&oacute; un error al almacenar el Registro. Sentencia: ".$Sql;
		}
	}

	function Consultar()
	{
		$Sql = "SELECT nro_venl, nro_lin_venl, cod_prod_venl, nom_prod_venl, valor_unit_venl, cant_venl, total_venl, FROM ventaslineas WHERE nro_venl = ".$this->Nro_Ventas." AND nro_lin_venl = ".$this->Nro_Lin_VentasLineas;
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$this->Alerta = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->Nro_VentasLineas = $oModelo->Registro[0];
				$this->Nro_Lin_VentasLineas = $oModelo->Registro[1];
				$this->Cod_Prod_VentasLineas = $oModelo->Registro[2];
				$this->Nom_Prod_VentasLineas = $oModelo->Registro[3];
				$this->Val_Unit_VentasLineas = $oModelo->Registro[4];
				$this->Cant_VentasLineas= $oModelo->Registro[5];
				$this->Total_VentasLineas= $oModelo->Registro[6];
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
		$Sql = "SELECT nro_venl, nro_lin_venl, cod_prod_venl, nom_prod_venl, valor_unit_venl, cant_venl, total_venl FROM ventaslineas WHERE nro_venl = ".$this->Nro_VentasLineas;
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$oModelo->VariosRegs = true;
		$this->Alerta = $Sql;
		$oModelo->Consultar();
		$nCont = 0;
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				while($nCont < $oModelo->CantReg)
				{
					$this->LstRegistros[$nCont]["Nro_VentasLineas"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["Nro_Lin_VentasLineas"] = $oModelo->ListaRegistros[$nCont][1];
					$this->LstRegistros[$nCont]["Cod_Prod_VentasLineas"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["Nom_Prod_VentasLineas"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Val_Unit_VentasLineas"] = $oModelo->ListaRegistros[$nCont][4];
					$this->LstRegistros[$nCont]["Cant_VentasLineas"] = $oModelo->ListaRegistros[$nCont][5];
					$this->LstRegistros[$nCont]["Total_VentasLineas"] = $oModelo->ListaRegistros[$nCont][6];
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

	function Borrar()
	{
		$Sql = "DELETE FROM ventaslineas ";
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$this->Alerta = $Sql;
		$oModelo->Ejecutar();
		if ($oModelo->Error == false)
		{
			$this->Error = false;
		}
		else
		{
			$this->Error = true;
			$this->Alerta = "Se present&oacute; un error al ejecutar la sentencia de eliminaci&oacute;n. Sentencia: ".$Sql;
		}
	}

	function SigLinea()
	{
		$Sql = "SELECT IFNULL(MAX(nro_lin_venl), 0) FROM ventaslineas WHERE nro_venl = ".$this->Nro_VentasLineas;
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$this->Alerta = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->nCant = ($oModelo->Registro[0] + 1);
			}
		}
	}

	function TotalLineas()
	{
		$Sql = "SELECT IFNULL(SUM(total_venl), 0) FROM ventaslineas WHERE nro_venl = ".$this->Nro_VentasLineas;
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$this->Alerta = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->nCant = ($oModelo->Registro[0]);
			}
		}
	}
}
?>
