<?php
//header ('Content-type: text/html; charset=utf-8');
// ESPECIFICA EL REGISTRO DE LOS CLIENTES DE LA APLICACION

include_once("Modelo.php");
date_default_timezone_set("America/Bogota");

class Clientes
{
	var $Id_Cliente;
	var $Codigo_Barra;
	var $Nombre;
	var $Numero_Identidad;
	var $Tipo_Identidad;
	var $Correo;
	var $Clave;
	var $Justifica;
	var $Saldo;

	var $LstRegistros;
	var $Error;
	var $nCant;
	var $Alerta;

	function Adicionar()
	{
		$Sql = "INSERT INTO clientes (id_clie, cod_bar_clie, nombre_clie, nro_ident_clie, tip_ident_clie, correo_clie, clave_clie, justgast_clie, saldo_clie) VALUES (".$this->Id_Cliente.", '".$this->Codigo_Barra."', '".$this->Nombre."', '".$this->Numero_Identidad."', '".$this->Tipo_Identidad."','".$this->Correo."', MD5('".$this->Clave."'), ".$this->Justifica.", ".$this->Saldo.")";
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
		$Sql = "SELECT id_clie, cod_bar_clie, nombre_clie, nro_ident_clie, tip_ident_clie, correo_clie, clave_clie, justgast_clie, saldo_clie FROM clientes WHERE id_clie = ".$this->Id_Cliente;
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->Id_Cliente = $oModelo->Registro[0];
				$this->Codigo_Barra = $oModelo->Registro[1];
				$this->Nombre = $oModelo->Registro[2];
				$this->Numero_Identidad = $oModelo->Registro[3];
				$this->Tipo_Identidad = $oModelo->Registro[4];
				$this->Correo = $oModelo->Registro[5];
				$this->Clave = $oModelo->Registro[6];
				$this->Justifica = $oModelo->Registro[7];
				$this->Saldo = $oModelo->Registro[8];
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
		$Sql = "SELECT id_clie, cod_bar_clie, nombre_clie, nro_ident_clie, tip_ident_clie, correo_clie, clave_clie, justgast_clie, saldo_clie FROM clientes WHERE cod_bar_clie = ".$this->Codigo_Barra;
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->Id_Cliente = $oModelo->Registro[0];
				$this->Codigo_Barra = $oModelo->Registro[1];
				$this->Nombre = $oModelo->Registro[2];
				$this->Numero_Identidad = $oModelo->Registro[3];
				$this->Tipo_Identidad = $oModelo->Registro[4];
				$this->Correo = $oModelo->Registro[5];
				$this->Clave = $oModelo->Registro[6];
				$this->Justifica = $oModelo->Registro[7];
				$this->Saldo = $oModelo->Registro[8];
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

	function ConsultarCodBarras()
	{
		$Sql = "SELECT id_clie, cod_bar_clie, nombre_clie, nro_ident_clie, tip_ident_clie, correo_clie, clave_clie, justgast_clie, saldo_clie FROM clientes WHERE cod_bar_clie = '".$this->Codigo_Barra."' AND clave_clie = MD5('".$this->Clave."')";
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$oModelo->Consultar();
		$this->Alerta = $Sql;
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->Id_Cliente = $oModelo->Registro[0];
				$this->Codigo_Barra = $oModelo->Registro[1];
				$this->Nombre = $oModelo->Registro[2];
				$this->Numero_Identidad = $oModelo->Registro[3];
				$this->Tipo_Identidad = $oModelo->Registro[4];
				$this->Correo = $oModelo->Registro[5];
				$this->Clave = $oModelo->Registro[6];
				$this->Justifica = $oModelo->Registro[7];
				$this->Saldo = $oModelo->Registro[8];
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
		$Sql = "SELECT id_clie, cod_bar_clie, nombre_clie, nro_ident_clie, tip_ident_clie, correo_clie, clave_clie, justgast_clie, saldo_clie FROM clientes ";
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
					$this->LstRegistros[$nCont]["Id_Cliente"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["Codigo_Barra"] = $oModelo->ListaRegistros[$nCont][1];
					$this->LstRegistros[$nCont]["Nombre"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["Numero_Identidad"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Tipo_Identidad"] = $oModelo->ListaRegistros[$nCont][4];
					$this->LstRegistros[$nCont]["Correo"] = $oModelo->ListaRegistros[$nCont][5];
					$this->LstRegistros[$nCont]["Clave"] = $oModelo->ListaRegistros[$nCont][6];
					$this->LstRegistros[$nCont]["Justifica"] = $oModelo->ListaRegistros[$nCont][7];
					$this->LstRegistros[$nCont]["Saldo"] = $oModelo->ListaRegistros[$nCont][8];
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
		$Sql = "DELETE FROM clientes ";
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
		$Sql = "SELECT MAX( id_clie ) FROM clientes";
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

	function ActualizarSaldo()
	{
		$Sql = "UPDATE clientes SET saldo_clie = ".$this->Saldo." WHERE id_clie = ".$this->Id_Cliente;
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
