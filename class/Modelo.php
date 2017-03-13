<?php
// ESPECIFICA LAS VARIABLES QUE INTERVIENEN 
require_once("Globales.php");

class Modelo
{
	private $NombreServidor;
	private $NombreBaseDatos;
	private $Usuario;
	private $Clave;
	private $Conexion;
	var $CantReg;
	var $Registro;
	var $ListaRegistros;
	var $Error;
	var $Sql;
	var $VariosRegs;
	var $Mensage;

	function Modelo()
	{
		$this->VariosRegs = false;
		$this->NombreServidor = _NOM_SERVIDOR;
		$this->Usuario = _USUARIO;
		$this->Clave = _CLAVE;
		$this->NombreBaseDatos = _NOM_BASEDATOS;
	}

	private function Conectar()
	{
		if ($this->Conexion = mysql_connect($this->NombreServidor,$this->Usuario, $this->Clave))
		{
			if (!mysql_select_db($this->NombreBaseDatos,$this->Conexion))
			{
				$this->Mensage = "Base de Datos Incorrecta";
				$this->Error = true;
			}
			else
			{
				mysql_query("SET NAMES utf8");
				$this->Error = false;
			}
		}
		else
			$this->Error = true;
	}

	private function CerrarSesion()
	{
		mysql_close($this->Conexion);
	}

	function Consultar()
	{
		$this->Conectar();
		if ($this->Error == false)
		{
			if ($Registros = mysql_query($this->Sql, $this->Conexion))
			{
				if ($this->VariosRegs == false)
				{
					if ($this->Registro = mysql_fetch_array($Registros))
					{
						$this->CantReg = 1;
						$this->Error = false;
						$this->CerrarSesion();
					}
					else
					{
						$this->CantReg = 0;
						$this->Error = false;
						$this->CerrarSesion();
					}
				}
				else
				{
					$Filas = 0;
					while ($Registro = mysql_fetch_array($Registros))
					{
						$Campos = mysql_num_fields($Registros);
						for ($i = 0; $i < $Campos; $i++)
						{
							$this->ListaRegistros[$Filas][$i] = $Registro[$i];
						}
						$Filas++;;
					}
					$this->CantReg = $Filas;
					$this->Error = false;
					$this->CerrarSesion();
				}
			}
			else
			{
				$this->Mensage = "Se presento un error en la Consulta. Sentencia: ".$this->Sql;
				$this->Error = true;
				$this->CerrarSesion();
			}
		}
		else
		{
			$this->Error = true;
			$this->Mensage = "Se presento un error de Conexi&oacute;n";
		}
	}

	function Ejecutar()
	{
		$this->Conectar();
		if ($this->Error == false)
		{
			if ($Registros = mysql_query($this->Sql, $this->Conexion))
			{
				$this->CantReg = mysql_affected_rows();
				$this->Error = false;
				$this->CerrarSesion();
			}
			else
			{
				$this->Mensage = "Se present&oacute; un error al Ejecutar la Sentencia ".$this->Sql;
				$this->Error = true;
				$this->CerrarSesion();
			}
		}
		else
		{
			$this->Error = true;
		}
	}
}
?>
