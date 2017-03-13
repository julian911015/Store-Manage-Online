<?php
//header ('Content-type: text/html; charset=utf-8');
// ESPECIFICA LOS PRODUCTOS QUE SE VENDEN
include_once("Modelo.php");
date_default_timezone_set("America/Bogota");

class Productos
{
	var $Id_Producto;
	var $Codigo_Producto;
	var $Descripcion_Producto;
	var $Costo_Producto;
	var $Saldo_Producto;
	var $Valor_Producto;

	var $LstRegistros;
	var $Error;
	var $nCant;
	var $Alerta;

	function Adicionar()
	{
		$Sql = "INSERT INTO productos (id_prod, codigo_prod, descrip_prod, costo_prod, saldo_prod, valor_prod) VALUES (".$this->Id_Producto.", '".$this->Codigo_Producto."', '".$this->Descripcion_Producto."', ".$this->Costo_Producto." ,".$this->Saldo_Producto.", ".$this->Valor_Producto.")";
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
		$Sql = "SELECT id_prod, codigo_prod, descrip_prod, costo_prod saldo_prod, valor_prod FROM productos WHERE id_prod = ".$this->Id_Producto;
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->Id_Producto = $oModelo->Registro[0];
				$this->Codigo_Producto = $oModelo->Registro[1];
				$this->Descripcion_Producto = $oModelo->Registro[2];
				$this->Costo_Producto = $oModelo->Registro[3];
				$this->Saldo_Producto = $oModelo->Registro[4];
				$this->Valor_Producto  = $oModelo->Registro[5];
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

	function ConsultarCodigo()
	{
		$Sql = "SELECT id_prod, codigo_prod, descrip_prod, costo_prod, saldo_prod, valor_prod FROM productos WHERE codigo_prod = '".$this->Codigo_Producto."'";
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$oModelo->Consultar();
		$this->Alerta = $Sql;
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->Id_Producto = $oModelo->Registro[0];
				$this->Codigo_Producto = $oModelo->Registro[1];
				$this->Descripcion_Producto = $oModelo->Registro[2];
				$this->Costo_Producto = $oModelo->Registro[3];
				$this->Saldo_Producto = $oModelo->Registro[4];
				$this->Valor_Producto  = $oModelo->Registro[5];
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
		$Sql = "SELECT id_prod, codigo_prod, descrip_prod, costo_prod, saldo_prod, valor_prod FROM productos ";
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
					$this->LstRegistros[$nCont]["Id_Producto"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["Codigo_Producto"] = $oModelo->ListaRegistros[$nCont][1];
					$this->LstRegistros[$nCont]["Descripcion_Producto"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["Costo_Producto"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Saldo_Producto"] = $oModelo->ListaRegistros[$nCont][4];
					$this->LstRegistros[$nCont]["Valor_Producto"] = $oModelo->ListaRegistros[$nCont][5];

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
		$Sql = "DELETE FROM productos ";
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

	function ActualizarDisponible()
	{
		$Sql = "UPDATE productos SET saldo_prod = ".$this->Saldo_Producto." WHERE id_prod = ".$this->Id_Producto;
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

	function SigId()
	{
		$Sql = "SELECT MAX( id_prod ) FROM productos";
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

	function ActualizarPrecio()
	{
		$Sql = "UPDATE productos SET costo_prod = ".$this->Costo_Producto.", valor_prod = ".$this->Valor_Producto." WHERE id_prod = ".$this->Id_Producto;
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
