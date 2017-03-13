<?php
//header ('Content-type: text/html; charset=utf-8');
// ESPECIFICA LOS PROVEEDORES
include_once("Modelo.php");
date_default_timezone_set("America/Bogota");

class Proveedores
{
	var $Id_Proveedores;
	var $Nit_Proveedores;
	var $Nom_Proveedores;
	var $Direccion_Proveedores;
	var $Telefono_Proveedores;
	var $Correo_Proveedores;

	var $LstRegistros;
	var $Error;
	var $nCant;
	var $Alerta;

	function Adicionar()
	{
		$Sql = "INSERT INTO proveedores (id_prov, nit_prov, nombre_prov, direccion_prov, telefono_prov, correo_prov) VALUES (".$this->Id_Proveedores.", '".$this->Nit_Proveedores."', '".$this->Nom_Proveedores."', '".$this->Direccion_Proveedores."', '".$this->Telefono_Proveedores."','".$this->Correo_Proveedores."')";
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
		$Sql = "SELECT id_prov, nit_prov, nombre_prov, direccion_prov, telefono_prov, correo_prov FROM proveedores WHERE id_prov = ".$this->Id_Proveedores;
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$this->Alerta = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->Id_Proveedores = $oModelo->Registro[0];
				$this->Nit_Proveedores = $oModelo->Registro[1];
				$this->Nom_Proveedores = $oModelo->Registro[2];
				$this->Direccion_Proveedores = $oModelo->Registro[3];
				$this->Telefono_Proveedores = $oModelo->Registro[4];
				$this->Correo_Proveedores = $oModelo->Registro[5];
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

	function ConsultarNit()
	{
		$Sql = "SELECT id_prov, nit_prov, nombre_prov, direccion_prov, telefono_prov, correo_prov FROM proveedores WHERE nit_prov = ".$this->Nit_Proveedores;
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$this->Alerta = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->Id_Proveedores = $oModelo->Registro[0];
				$this->Nit_Proveedores = $oModelo->Registro[1];
				$this->Nom_Proveedores = $oModelo->Registro[2];
				$this->Direccion_Proveedores = $oModelo->Registro[3];
				$this->Telefono_Proveedores = $oModelo->Registro[4];
				$this->Correo_Proveedores = $oModelo->Registro[5];
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
		$Sql = "SELECT id_prov, nit_prov, nombre_prov, direccion_prov, telefono_prov, correo_prov FROM proveedores ";
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
					$this->LstRegistros[$nCont]["Id_Proveedores"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["Nit_Proveedores"] = $oModelo->ListaRegistros[$nCont][1];
					$this->LstRegistros[$nCont]["Nom_Proveedores"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["Direccion_Proveedores"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Telefono_Proveedores"] = $oModelo->ListaRegistros[$nCont][4];
					$this->LstRegistros[$nCont]["Correo_Proveedores"] = $oModelo->ListaRegistros[$nCont][5];
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
		$Sql = "DELETE FROM proveedores ";
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

	function SigId()
	{
		$Sql = "SELECT MAX( id_prov ) FROM proveedores";
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->nCant = $oModelo->Registro[0] + 1;
				$this->Error = false;
			}
			else
			{
				$this->nCant = 1;
				$this->Error = false;
			}
		}
		else
		{
			$this->Error = true;
			$this->Alerta = "Se present&oacute; un error al ejecutar la sentencia de eliminaci&oacute;n. Sentencia: ".$Sql;
		}
	}

}
?>
