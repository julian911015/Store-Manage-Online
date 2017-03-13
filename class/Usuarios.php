<?php
//header ('Content-type: text/html; charset=utf-8');
// ESPECIFICA LOS USUARIOS QUE TIENEN ACCESO A LA PLATAFORMA
include_once("Modelo.php");
date_default_timezone_set("America/Bogota");

class Usuarios
{
	var $Id_Usuario;
	var $Numero_Identidad;
	var $Nombre;
	var $Clave;
	var $Perfil;

	var $LstRegistros;
	var $Error;
	var $nCant;
	var $Alerta;

	function Adicionar()
	{
		$Sql = "INSERT INTO usuarios (id_usua, nro_id_usua, nombre_usua, clave_usua, perfil_usua) VALUES (".$this->Id_Usuario.",'".$this->Numero_Identidad."', '".$this->Nombre."', MD5('".$this->Clave."'), ".$this->Perfil.")";
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
		$Sql = "SELECT id_usua, nro_id_usua, nombre_usua, clave_usua, perfil_usua FROM usuarios WHERE id_usua = ".$this->Id_Usuario;
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$this->Alerta = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			if ($oModelo->CantReg > 0)
			{
				$this->Id_Usuario = $oModelo->Registro[0];
				$this->Numero_Identidad = $oModelo->Registro[1];
				$this->Nombre = $oModelo->Registro[2];
				$this->Clave = $oModelo->Registro[3];
				$this->Perfil = $oModelo->Registro[4];
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


	function ConsultarClave()
	{
		$Sql = "SELECT id_usua, nro_id_usua, nombre_usua, clave_usua, perfil_usua FROM usuarios WHERE nro_id_usua = '".$this->Numero_Identidad."' AND clave_usua = MD5('".$this->Clave."')";
		$oModelo = new Modelo();
		$oModelo->Sql = $Sql;
		$this->Alerta = $Sql;
		$oModelo->Consultar();
		if ($oModelo->Error == false)
		{
			$this->Alerta = $Sql;
			if ($oModelo->CantReg > 0)
			{
				$this->Id_Usuario = $oModelo->Registro[0];
	            $this->Numero_Identidad = $oModelo->Registro[1];
				$this->Nombre = $oModelo->Registro[2];
				$this->Clave = $oModelo->Registro[3];
				$this->Perfil = $oModelo->Registro[4];
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
		$Sql = "SELECT id_usua, nro_id_usua, nombre_usua, clave_usua, perfil_usua FROM usuarios ";
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
					$this->LstRegistros[$nCont]["Id_Usuario"] = $oModelo->ListaRegistros[$nCont][0];
					$this->LstRegistros[$nCont]["Numero_Identidad"] = $oModelo->ListaRegistros[$nCont][1];
					$this->LstRegistros[$nCont]["Nombre"] = $oModelo->ListaRegistros[$nCont][2];
					$this->LstRegistros[$nCont]["Clave"] = $oModelo->ListaRegistros[$nCont][3];
					$this->LstRegistros[$nCont]["Perfil"] = $oModelo->ListaRegistros[$nCont][4];
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
		$Sql = "DELETE FROM usuarios ";
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
		$Sql = "SELECT MAX( id_usua ) FROM usuarios";
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
