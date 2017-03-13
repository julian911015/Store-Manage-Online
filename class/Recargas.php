<?php
//header ('Content-type: text/html; charset=utf-8');
// GENERA LAS RECARGAS QUE SE REALIZAN A UN USUARIO ESPECIFICO

include_once("Modelo.php");
date_default_timezone_set("America/Bogota");

class Recargas
{
	var $Nro;
	var $Fecha;
	var $Cliente;
	var $Factura;
	var $Valor;
	var $Observaciones;
	var $Estado;

	var $LstRegistros;
	var $Param01;
	var $Param02;
	var $Error;
	var $nCant;
	var $Alerta;

	function Adicionar()
	{
		$Sql = "INSERT INTO recargas (nro_reca, fecha_reca, id_clie_reca, nrofra_reca, valor_reca, observ_reca, estado_reca) VALUES (".$this->Nro.", '".$this->Fecha."', ".$this->Cliente.", '".$this->Factura."', ".$this->Valor.", '".$this->Observaciones."', ".$this->Estado.")";
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
			$this->Alerta = "Se present&oacute; un error al almacenar el Registro. Sentencia: ".$Sql;
		}
	}

	function Consultar()
	{
		$Sql = "SELECT nro_reca, fecha_reca, id_clie_reca, nrofra_reca, valor_reca, observ_reca, estado_reca FROM recargas WHERE nro_reca = ".$this->Nro;
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->Nro = $oModelo->Registro[0];
				$this->Fecha = $oModelo->Registro[1];
				$this->Cliente = $oModelo->Registro[2];
				$this->Factura = $oModelo->Registro[3];
				$this->Valor = $oModelo->Registro[4];
				$this->Estado = $oModelo->Registro[5];
				$this->Observaciones = $oModelo->Registro[6];
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
		$Sql = "SELECT nro_reca, fecha_reca, id_clie_reca, nrofra_reca, valor_reca, observ_reca, estado_reca FROM recargas ";
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
					$this->LstRegistros[$nCont]["Nro"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["Fecha"] = $oModelo->ListaRegistros[$nCont][1];
					$this->LstRegistros[$nCont]["Cliente"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["Factura"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Valor"] = $oModelo->ListaRegistros[$nCont][4];
					$this->LstRegistros[$nCont]["Observaciones"] = $oModelo->ListaRegistros[$nCont][5];
					$this->LstRegistros[$nCont]["Estado"] = $oModelo->ListaRegistros[$nCont][6];
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
		$Sql = "SELECT nro_reca, fecha_reca, id_clie_reca, nrofra_reca, valor_reca, observ_reca, estado_reca FROM recargas ";
		if($this->Param01 != "" && $this->Param02 != ""){
			$Sql .= "WHERE fecha_reca BETWEEN '".$this->Param01."' AND '".$this->Param02."'";
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
					$this->LstRegistros[$nCont]["Nro"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["Fecha"] = $oModelo->ListaRegistros[$nCont][1];
					$this->LstRegistros[$nCont]["Cliente"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["Factura"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Valor"] = $oModelo->ListaRegistros[$nCont][4];
					$this->LstRegistros[$nCont]["Observaciones"] = $oModelo->ListaRegistros[$nCont][5];
					$this->LstRegistros[$nCont]["Estado"] = $oModelo->ListaRegistros[$nCont][6];
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
		$Sql = "DELETE FROM recargas ";
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
		$Sql = "SELECT IFNULL(MAX(nro_reca), 0) FROM recargas";
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
}
?>
