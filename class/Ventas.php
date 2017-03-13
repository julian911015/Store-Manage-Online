<?php
//header ('Content-type: text/html; charset=utf-8');
// ESPECIFICA LOS ID DE LAS VENTAS
include_once("Modelo.php");
date_default_timezone_set("America/Bogota");

class Ventas
{
	var $Nro_Ventas;
	var $Fecha_Ventas;
	var $Clientes_Ventas;
	var $Total_Ventas;
	var $Justificacion_Ventas;
	var $Estado_Ventas;

    var $LstRegistros;
	var $Param01;
	var $Param02;
	var $Error;
	var $nCant;
	var $Alerta;

	function Adicionar()
	{
		$Sql = "INSERT INTO ventas(nro_vent, fecha_vent, cliente_vent, total_vent, justif_vent, estado_vent) VALUES (".$this->Nro_Ventas.", '".$this->Fecha_Ventas."', ".$this->Clientes_Ventas.", ".$this->Total_Ventas.", '".$this->Justificacion_Ventas."', ".$this->Estado_Ventas.")";
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
		$Sql = "SELECT nro_vent, fecha_vent, cliente_vent, total_vent, justif_vent, estado_vent FROM ventas WHERE nro_vent = ".$this->Nro_Ventas;
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$this->Alerta = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->Nro_Ventas = $oModelo->Registro[0];
				$this->Fecha_Ventas = $oModelo->Registro[1];
				$this->Clientes_Ventas = $oModelo->Registro[2];
				$this->Total_Ventas = $oModelo->Registro[3];
				$this->Justificacion_Ventas = $oModelo->Registro[4];
				$this->Estado_Ventas = $oModelo->Registro[5];
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
		$Sql = "SELECT nro_vent, fecha_vent, cliente_vent, total_vent, justif_vent, estado_vent FROM ventas  ";
		if($this->Param01 != ""){

		}
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
					$this->LstRegistros[$nCont]["Nro_Ventas"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["Fecha_Ventas"] = $oModelo->ListaRegistros[$nCont][1];;
					$this->LstRegistros[$nCont]["Clientes_Ventas"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["Total_Ventas"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Justificacion_Ventas"] = $oModelo->ListaRegistros[$nCont][4];
					$this->LstRegistros[$nCont]["Estado_Ventas"] = $oModelo->ListaRegistros[$nCont][5];
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
		$Sql = "SELECT nro_vent, fecha_vent, cliente_vent, total_vent, justif_vent, estado_vent FROM ventas  ";
		if($this->Param01 != "" && $this->Param02 != ""){
			$Sql .= "WHERE fecha_vent BETWEEN '".$this->Param01."' AND '".$this->Param02."'";
		}
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
					$this->LstRegistros[$nCont]["Nro_Ventas"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["Fecha_Ventas"] = $oModelo->ListaRegistros[$nCont][1];;
					$this->LstRegistros[$nCont]["Clientes_Ventas"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["Total_Ventas"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Justificacion_Ventas"] = $oModelo->ListaRegistros[$nCont][4];
					$this->LstRegistros[$nCont]["Estado_Ventas"] = $oModelo->ListaRegistros[$nCont][5];
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
		$Sql = "DELETE FROM ventas ";
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

	function SigNro()
	{
		$Sql = "SELECT IFNULL(MAX(nro_vent), 0) FROM ventas";
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

	function GuardarVenta()
	{
		$Sql = "UPDATE ventas SET total_vent = ".$this->Total_Ventas.", justif_vent = '".$this->Justificacion_Ventas."', estado_vent = 1 WHERE nro_vent = ".$this->Nro_Ventas;
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

	function AnularVenta()
	{
		$Sql = "UPDATE ventas SET estado_vent = 2 WHERE nro_vent = ".$this->Nro_Ventas;
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
