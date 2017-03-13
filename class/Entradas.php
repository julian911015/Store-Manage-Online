<?php
//header ('Content-type: text/html; charset=utf-8');
// ESPECIFICA EL ID DE LAS ENTRADAS DE MERCANCIA


include_once("Modelo.php");
date_default_timezone_set("America/Bogota");

class Entradas
{
	var $Nro_Entrada;
	var $Fecha_Entrada;
	var $Cod_Prov_Entrada;
	var $Nro_fact_Entrada;
	var $Total_Entrada;
	var $Estado_Entrada;

	var $LstRegistros;
	var $Param01;
	var $Param02;
	var $Error;
	var $nCant;
	var $Alerta;

	function Adicionar()
	{
		$Sql = "INSERT INTO entradas (nro_entr, fecha_entr, cod_prov_entr, nro_fact_entr, total_entr, estado_entr) VALUES (".$this->Nro_Entrada.", '".$this->Fecha_Entrada."', ".$this->Cod_Prov_Entrada.", '".$this->Nro_fact_Entrada."', ".$this->Total_Entrada.", ".$this->Estado_Entrada.")";
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
		$Sql = "SELECT nro_entr, fecha_entr, cod_prov_entr, nro_fact_entr, total_entr, estado_entr FROM entradas WHERE nro_entr = ".$this->Nro_Entrada;
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$this->Alerta = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->Nro_Entrada = $oModelo->Registro[0];
				$this->Fecha_Entrada = $oModelo->Registro[1];
				$this->Cod_Prov_Entrada = $oModelo->Registro[2];
				$this->Nro_fact_Entrada = $oModelo->Registro[3];
				$this->Total_Entrada = $oModelo->Registro[4];
				$this->Estado_Entrada = $oModelo->Registro[5];
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
		$Sql = "SELECT nro_entr, fecha_entr, cod_prov_entr, nro_fact_entr, total_entr, estado_entr FROM entradas ";
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
					$this->LstRegistros[$nCont]["Nro_Entrada"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["Fecha_Entrada"] = $oModelo->ListaRegistros[$nCont][1];
					$this->LstRegistros[$nCont]["Cod_Prov_Entrada"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["Nro_fact_Entrada"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Total_Entrada"] = $oModelo->ListaRegistros[$nCont][4];
					$this->LstRegistros[$nCont]["Estado_Entrada"] = $oModelo->ListaRegistros[$nCont][5];
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

	function ListarIntervalo()
	{
		$Sql = "SELECT nro_entr, fecha_entr, cod_prov_entr, nro_fact_entr, total_entr, estado_entr FROM entradas ";
		if($this->Param01 != "" && $this->Param02 != ""){
			$Sql .= "WHERE fecha_entr BETWEEN '".$this->Param01."' AND '".$this->Param02."'";
		}
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
					$this->LstRegistros[$nCont]["Nro_Entrada"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["Fecha_Entrada"] = $oModelo->ListaRegistros[$nCont][1];
					$this->LstRegistros[$nCont]["Cod_Prov_Entrada"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["Nro_fact_Entrada"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Total_Entrada"] = $oModelo->ListaRegistros[$nCont][4];
					$this->LstRegistros[$nCont]["Estado_Entrada"] = $oModelo->ListaRegistros[$nCont][5];
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
		$Sql = "DELETE FROM entradas ";
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

	function SigNro()
	{
		$Sql = "SELECT IFNULL(MAX(nro_entr), 0) FROM entradas";
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

	function GuardarEntrada()
	{
		$Sql = "UPDATE entradas SET estado_entr = '1', nro_fact_entr = '".$this->Nro_fact_Entrada."', total_entr = ".$this->Total_Entrada." WHERE nro_entr = ".$this->Nro_Entrada;
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

	function AnularEntrada()
	{
		$Sql = "UPDATE entradas SET estado_entr = '1' WHERE nro_entr = ".$this->Nro_Entrada;
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
}
?>
