<?php
//header ('Content-type: text/html; charset=utf-8');
// ESPECIFICA EN DETALLE LAS ENTRADAS DE MERCANCIA
include_once("Modelo.php");
date_default_timezone_set("America/Bogota");

class EntradasLineas
{
	var $Nro_EntradaLineas;
	var $Linea_EntradaLineas;
	var $Cod_Prod_EntradaLineas;
	var $Nombre_Prod_EntradaLineas;
	var $Costo_unit_EntradaLineas;
	var $Cant_EntradaLineas;
	var $Vlr_Vta_EntradaLineas;
	var $Total_EntradaLineas;

	var $LstRegistros;
	var $Error;
	var $nCant;
	var $Alerta;

	function Adicionar()
	{
		$Sql = "INSERT INTO entradas_lineas (nro_entl, linea_entl, cod_prod_entl, nombre_entl, costo_unit_entl, cant_entl, vlr_vta_entl, total_entl) VALUES (".$this->Nro_EntradaLineas.", ".$this->Linea_EntradaLineas.", '".$this->Cod_Prod_EntradaLineas."', '".$this->Nombre_Prod_EntradaLineas."',".$this->Costo_unit_EntradaLineas.", ".$this->Cant_EntradaLineas.", ".$this->Vlr_Vta_EntradaLineas.", ".$this->Total_EntradaLineas.")";
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
		$Sql = "SELECT nro_entl, linea_entl, cod_prod_entl, nombre_entl, costo_unit_entl, cant_entl, vlr_vta_entl, total_entl FROM entradas_lineas WHERE nro_entl = ".$this->Nro_Entrada;
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$this->Alerta = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->Nro_EntradaLineas = $oModelo->Registro[0];
				$this->Linea_EntradaLineas = $oModelo->Registro[1];
				$this->Cod_Prod_EntradaLineas = $oModelo->Registro[2];
				$this->Nombre_Prod_EntradaLineas = $oModelo->Registro[3];
				$this->Costo_unit_EntradaLineas = $oModelo->Registro[4];
				$this->Cantidad_EntradaLineas = $oModelo->Registro[5];
				$this->Vlr_Vta_EntradaLineas = $oModelo->Registro[6];
				$this->Total_EntradaLineas = $oModelo->Registro[7];
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
		$Sql = "SELECT nro_entl, linea_entl, cod_prod_entl, nombre_entl, costo_unit_entl, cant_entl, vlr_vta_entl, total_entl FROM entradas_lineas WHERE nro_entl = ".$this->Nro_EntradaLineas;
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
					$this->LstRegistros[$nCont]["Nro_EntradaLineas"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["Linea_EntradaLineas"] = $oModelo->ListaRegistros[$nCont][1];
					$this->LstRegistros[$nCont]["Cod_Prod_EntradaLineas"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["Nombre_Prod_EntradaLineas"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Costo_unit_EntradaLineas"] = $oModelo->ListaRegistros[$nCont][4];
					$this->LstRegistros[$nCont]["Cantidad_EntradaLineas"] = $oModelo->ListaRegistros[$nCont][5];
					$this->LstRegistros[$nCont]["Vlr_Vta_EntradaLineas"] = $oModelo->ListaRegistros[$nCont][6];
					$this->LstRegistros[$nCont]["Valor_EntradaLineas"] = $oModelo->ListaRegistros[$nCont][7];
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
		$Sql = "DELETE FROM entradas_lineas ";
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
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
		$Sql = "SELECT IFNULL(MAX(linea_entl), 0) FROM entradas_lineas WHERE nro_entl = ".$this->Nro_EntradaLineas;
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
		$Sql = "SELECT IFNULL(SUM(total_entl), 0) FROM entradas_lineas WHERE nro_entl = ".$this->Nro_EntradaLineas;
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
