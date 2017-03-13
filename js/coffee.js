$(document).ready(function(){
/******* Index.php ***********/
	$("#btnAcceso").click(function(){
		var vContinuar = true;
		if($("#txtUsuario").val() == ""){
			$("#divAlerta").html("Debe ingresar un usuario");
			$("#txtUsuario").focus();
			vContinuar = false;
		}
		if(vContinuar){
			if($("#txtClave").val() == ""){
				$("#divAlerta").html("Debe ingresar la Clave");
				$("#txtClave").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			$.post("funciones.php",{
				opc:'ValidarUsuario',
				us:$("#txtUsuario").val(),
				clav:$("#txtClave").val()
			}, function(data){
				if(data[0] == "OK"){
					$("#divAlerta").html("Ingresando");
					window.location.href = "menu.php";
				}
				else{
					$("#divAlerta").html(data[0]);
				}
			},'json');
		}
	});

/******* Index.php ***********/

/******* Menu.php ***********/
	$("#btnSalirMenu").click(function(){
		$.post("funciones.php",{
			opc:'Salir'
		}, function(data){
			window.location.href = "index.php";
		});
	});

	$("#btnCrearUs").click(function(){
		window.location.href = "usuarios.php";
	});

	$("#btnCrearProv").click(function(){
		window.location.href = "proveedores.php";
	});

	$("#btnCrearProd").click(function(){
		window.location.href = "productos.php";
	});

	$("#btnCrearClie").click(function(){
		window.location.href = "clientes.php";
	});

	$("#btnEntrada").click(function(){
		window.location.href = "entradas.php";
	});

	$("#btnCargarT").click(function(){
		window.location.href = "cargarTarjeta.php";
	});

	$("#btnVentas").click(function(){
		window.location.href = "ventas.php";
	});

	$("#btnLstUsua").click(function(){
		window.location.href = "informes.php?TipInf=01";
	});

	$("#btnLstProv").click(function(){
		window.location.href = "informes.php?TipInf=02";
	});

	$("#btnLstProd").click(function(){
		window.location.href = "informes.php?TipInf=03";
	});

	$("#btnLstClie").click(function(){
		window.location.href = "informes.php?TipInf=04";
	});

	$("#btnLstTar").click(function(){
		window.location.href = "informes.php?TipInf=05";
	});

	$("#btnLstVent").click(function(){
		window.location.href = "informes.php?TipInf=06";
	});
 	
	$("#btnLstEntr").click(function(){
		window.location.href = "informes.php?TipInf=07";
	});

	$("#btnInfVent").click(function(){
		window.location.href = "informes.php?TipInf=08";
	});
 	
	$("#btnLstProdCli").click(function(){
		window.location.href = "informes.php?TipInf=09";
	});

	$("#btnInfEntr").click(function(){
		window.location.href = "informes.php?TipInf=10";
	});
 	
	$("#btnMenu").click(function(){
		//alert("Menu");
		window.location.href = "menu.php";
	});
/******* Menu.php ***********/

/******* Usuarios.php ***********/
	$("#btnCrearUsu").click(function(){
		var vContinuar = true;
		if($("#txtNumero").val() == ""){
			alert("Debe ingresar un Numero");
			$("#txtNumero").focus();
			vContinuar = false;
		}
		if(vContinuar){
			if($("#txtNombre").val() == ""){
				alert("Debe ingresar un Nombre");
				$("#txtNombre").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtClave").val() == ""){
				alert("Debe ingresar la clave");
				$("#txtClave").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			$.post("funciones.php",{
				opc: 'CrearUsuarios',
				nro: $("#txtNumero").val(),
				nom: $("#txtNombre").val(),
				clav: $("#txtClave").val(),
				perf: $("#cboPerfil").val()
			}, function(data){
				if(data[0] == "OK"){
					alert("Se creo el cliente exitosamente");
					$("#divTxtId").html(data[1]);
					$("#txtNumero").val("");
					$("#txtNombre").val("");
					$("#txtClave").val("");
					$("#divAlerta").html("");
				}
				else{
					$("#divAlerta").html(data[0]);
				}
			},'json');
		}
	});

/******* Usuarios.php ***********/

/******* Proveedores.php ***********/
	$("#btnCrearPrv").click(function(){
		var vContinuar = true;
		if($("#txtNit").val() == ""){
			alert("Debe ingresar un Nit");
			$("#txtNit").focus();
			vContinuar = false;
		}
		if(vContinuar){
			if($("#txtNombre").val() == ""){
				alert("Debe ingresar un Nombre");
				$("#txtNombre").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtDireccion").val() == ""){
				alert("Debe ingresar una Direccion");
				$("#txtDireccion").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtTelefono").val() == ""){
				alert("Debe ingresar un Telefono");
				$("#txtTelefono").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtCorreo").val() == ""){
				alert("Debe ingresar el Correo");
				$("#txtCorreo").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			$.post("funciones.php",{
				opc: 'CrearProveedor',
				nit: $("#txtNit").val(),
				nomb: $("#txtNombre").val(),
				dir: $("#txtDireccion").val(),
				telef: $("#txtTelefono").val(),
				corr: $("#txtCorreo").val()
			}, function(data){
				if(data[0] == "OK"){
					alert("Se creo el Proveedor exitosamente");
					$("#divTxtId").html(data[1]);
					$("#txtNit").val("");
					$("#txtNombre").val("");
					$("#txtDireccion").val("");
					$("#txtTelefono").val("");
					$("#txtCorreo").val("");
					$("#divAlerta").html("");
				}
				else{
					$("#divAlerta").html(data[0]);
				}
			},'json');
		}		
	});	
/******* Proveedores.php ***********/

/******* Productos.php ***********/
	$("#btnCrearPrd").click(function(){
		var vContinuar = true;
		if($("#txtCodigo_Pro").val() == ""){
			alert("Debe ingresar un Codigo de producto");
			$("#txtCodigo_Pro").focus();
			vContinuar = false;
		}
		if(vContinuar){
			if($("#txtDescripcion").val() == ""){
				alert("Debe ingresar una Descripcion");
				$("#txtDescripcion").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtCosto").val() == ""){
				alert("Debe ingresar un Costo");
				$("#txtCosto").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtSaldo").val() == ""){
				alert("Debe ingresar el Saldo");
				$("#txtSaldo").focus();
				vContinuar = false;
			}
	
		}
		if(vContinuar){
			if($("#txtValor").val() == ""){
				alert("Debe ingresar el Valor");
				$("#txtValor").focus();
				vContinuar = false;
			}
	
		}
		if(vContinuar){
			$.post("funciones.php",{
				opc: 'CrearProductos',
				codp: $("#txtCodigo_Pro").val(),
				desc: $("#txtDescripcion").val(),
				cost: $("#txtCosto").val(),
				sal: $("#txtSaldo").val(),
				val: $("#txtValor").val()
			}, function(data){
				if(data[0] == "OK"){
					alert("Se creo el Producto exitosamente");
					$("#divTxtId").html(data[1]);
					$("#txtCodigo_Pro").val("");
					$("#txtDescripcion").val("");
					$("#txtDireccion").val("");
					$("#txtCosto").val("");
					$("#txtSaldo").val("");
		            $("#txtValor").val("");
					$("#divAlerta").html("");
				}
				else{
					$("#divAlerta").html(data[0]);
				}
			},'json');
		} 
	});
/******* Productos.php ***********/

/******* Clientes.php ***********/
	$("#btnCrearCl").click(function(){
		var vContinuar = true;
		var vChkJust = false;
		if($("#txtCodBar").val() == ""){
			alert("Debe ingresar un Codigo de Barras");
			$("#txtCodBar").focus();
			vContinuar = false;
		}

		if(vContinuar){
			if($("#txtNombre").val() == ""){
				alert("Debe ingresar un Nombre");
				$("#txtNombre").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtNroId").val() == ""){
				alert("Debe ingresar un Numero de Identidad");
				$("#txtNroId").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtTipoId").val() == ""){
				alert("Debe ingresar un Tipo de Identidad");
				$("#txtTipoId").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtCorreo").val() == ""){
				alert("Debe ingresar el Correo");
				$("#txtCorreo").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtClave").val() == ""){
				alert("Debe ingresar la clave");
				$("#txtClave").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#chkJustif").is(':checked')){
				vChkJust = 1;
			}
			else{
				vChkJust = 0;
			}
		}
		if(vContinuar){
			$.post("funciones.php",{
				opc: 'CrearClientes',
				codb: $("#txtCodBar").val(),
				nom: $("#txtNombre").val(),
				nro: $("#txtNroId").val(),
				tipid: $("#cboTipoId").val(),
			    cor: $("#txtCorreo").val(),
				clav: $("#txtClave").val(),
				sal: $("#txtSaldo").val(),
				just: vChkJust
			}, function(data){
				if(data[0] == "OK"){
					alert("Se creo el cliente exitosamente");
					$("#divTxtId").html(data[1]);
					$("#txtCodBar").val("");
					$("#txtNombre").val("");
					$("#txtNroId").val("");
					//$("#cboTipoId").val("");
					$("#txtCorreo").val("");
		            $("#txtClave").val("");
					$("#txtSaldo").val("");
					$("#chkJustif").prop('checked', false);
					$("#divAlerta").html("");
				}
				else{
					$("#divAlerta").html(data[0]);
				}
			},'json');
		}
	});
/******* Clientes.php ***********/

/******* Entradas.php ***********/
	$("#btnConsProv").click(function(){
		var vContinuar = true;
		if($("#txtProveed").val() == ""){
			alert("Debe ingresar el Nit del Proveedor");
			//$("#divAlerta").html("Debe ingresar el C&oacute;digo del Cliente");
			$("#txtProveed").focus();
			vContinuar = false;
		}
		if(vContinuar){
			$.post("funciones.php",{
				opc:'ConsultarProveedor',
				prov:$("#txtProveed").val()
			}, function(data){
				if(data[0] == "OK"){
					$("#divNomProv").html(data[1]);
				}
				else{
					alert(data[0]);
				}
			},'json');
		}
	});

	$("#txtProductoComp").blur(function(){
		//alert("Algo pasa");
		if($("#txtProductoComp").val() != ""){
			$.post("funciones.php",{
				opc:'ConsultarProducto',
				prod:$("#txtProductoComp").val()
			}, function(data){
				if(data[3] == "OK"){
					$("#divProductoComp").html(data[0] + " Precio Actual: " + data[1] + " Existencias Actuales: " + data[2]);
					$("#divAlerta").html("");
				}
				else{
					$("#divAlerta").html(data[0]);
				}
			},'json');
		}
	});
	
	$("#btnAgregarProdComp").click(function(){
		var vContinuar = true;
		if($("#txtProveed").val() == ""){
			alert("Debe ingresar el Nit del Proveedor");
			$("#txtProveed").focus();
			vContinuar = false;
		}
		if(vContinuar){
			if($("#txtProductoComp").val() == ""){
				alert("Debe ingresar el Producto");
				$("#txtProductoComp").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtCostoUnitComp").val() == ""){
				alert("Debe ingresar el Costo Unitario");
				$("#txtVlrUnitComp").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtCantidadComp").val() == ""){
				alert("Debe ingresar la Cantidad");
				$("#txtCantidadComp").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtVlrVtaComp").val() == ""){
				alert("Debe ingresar el Valor de Venta");
				$("#txtVlrVtaComp").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			//alert("Continuar");
			$.post("funciones.php",{
				opc:'AgregarProductoComp',
				nroComp:$("#divNroEntr").html(),
				prov:$("#txtProveed").val(),
				fra:$("#txtFraComp").val(),
				prod:$("#txtProductoComp").val(),
				cost:$("#txtCostoUnitComp").val(),
				cant: $("#txtCantidadComp").val(),
				vlr: $("#txtVlrVtaComp").val()
			}, function(data){
				if(data[0] == "OK"){
					$("#divVlrTot").html(data[1]);
					$("#divLstProds").html(data[2]);
					$("#divAlerta").html(data[3]);
					$("#txtProductoComp").val("");
					$("#divProductoComp").html("");
					$("#txtCostoUnitComp").val("");
					$("#txtCantidadComp").val("");
					$("#txtVlrVtaComp").val("");
					$("#txtProductoComp").focus();
				}
				else{
					$("#divAlerta").html(data[0]);
				}
			},'json');
//			alert("Saldo: " + vSaldoUs + " Cant Disp: " + vCantPro + " Cant Compra: " + vCantUs);
		}
	});

	$("#btnComprarComp").click(function(){
		var vContinuar = true;
		if($("#txtProveed").val() == ""){
			alert("Debe ingresar el Nit del Proveedor");
			$("#txtProveed").focus();
			vContinuar = false;
		}
		if(vContinuar){
			if($("#txtFraComp").val() == ""){
				alert("Debe agregar el Nro de Fractura de Compra");
				$("#txtFraComp").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			var vVlrTot = parseFloat($("#divVlrTot").html());
			$.post("funciones.php",{
				opc:'CrearCompra',
				nroC:$("#divNroEntr").html(),
				prov:$("#txtProveed").val(),
				frac:$("#txtFraComp").val(),
				vlrtot:vVlrTot
			}, function(data){
				$.post("funciones.php",{
					opc:'CorreoCompra',
					nroC:$("#divNroEntr").html(),
					prov:$("#txtProveed").val()
				}, function(data2){
					if(data2[0] == "OK"){
						$("#divNroEntr").html(data[0]);
						$("#divAlerta").html(data[1]);
						$("#txtProveed").val("");
						$("#txtFraComp").val("");
						$("#txtProductoComp").val("");
						$("#divProductoComp").html("");
						$("#txtVlrUnitComp").val("");
						$("#txtCantidadComp").val("");
						$("#divLstProds").html("");
						$("#divVlrTot").html("");
						$("#txtProveed").focus();
					}
				},'json');
			},'json');
		}
	});
/******* Entradas.php ***********/

/******* CargarTarjeta.php ***********/
	$("#btnConsultar").click(function(){
		var vContinuar = true;
		if($("#txtCliente").val() == ""){
			alert("Debe ingresar un cliente");
			$("#txtCliente").focus();
			vContinuar = false;
		}
		if(vContinuar){
			$.post("funciones.php",{
				opc:'ConsultarCliente2',
				clie:$("#txtCliente").val()
			}, function(data){
				$("#divTxtNombre").html(data[0]);
				$("#divTxtSaldoA").html(data[1]);
			},'json');
		}
	});

	$("#btnCargar").click(function(){
		var vContinuar = true;
		if($("#txtCliente").val() == ""){
			alert("Debe ingresar un cliente");
			$("#txtCliente").focus();
			vContinuar = false;
		}
		if(vContinuar){
			if($("#txtNroFact").val() == ""){
				alert("Debe ingresar el Nro del Recibo de Caja");
				$("#txtNroFact").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtVlrCarg").val() == ""){
				alert("Debe ingresar el valor a cargar");
				$("#txtVlrCarg").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			vVlr = parseFloat($("#txtVlrCarg").val());
			$.post("funciones.php",{
				opc: 'CargarCliente',
				nro: $("#divNroRec").html(),
				clie: $("#txtCliente").val(),
				vlr: vVlr,
				fra: $("#txtNroFact").val(),
				obs: $("#txtObserv").val()
			}, function(data){
				alert("Su nuevo saldo es: " + data[1]);
				$("#divTxtNombre").html(data[0]);
				$("#txtCliente").val("");
				$("#txtVlrCarg").val("");
				$("#txtNroFact").val("");
				$("#txtObserv").val("");
				$("#divTxtNombre").html("");
				$("#divTxtSaldoA").html("");
				$("#divAlerta").html(data[2]);
			},'json');
		}
	});
/******* CargarTarjeta.php ***********/

/******* Ventas.php ***********/
	$("#btnConsCl").click(function(){
		var vContinuar = true;
		if($("#txtClienteV").val() == ""){
			alert("Debe ingresar el C&oacute;digo del Cliente");
			//$("#divAlerta").html("Debe ingresar el C&oacute;digo del Cliente");
			$("#txtClienteV").focus();
			vContinuar = false;
		}
		if(vContinuar){
			if($("#txtClaveClV").val() == ""){
				alert("Debe ingresar la Clave");
				$("#txtClaveClV").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			$.post("funciones.php",{
				opc:'ConsultarCliente',
				clie:$("#txtClienteV").val(),
				clav:$("#txtClaveClV").val()
			}, function(data){
				$("#divNomCl").html(data[0]);
				$("#divSaldoCl").html(data[1]);
				if(data[2] == "0"){
					$("#divLblJustif").hide();
					$("#divTxtJustif").hide();
					$("#txtBlJust").val("0");
				}
				else{
					$("#divLblJustif").show();
					$("#divTxtJustif").show();
					$("#txtBlJust").val("1");
				}
			},'json');
		}
	});

	$("#txtProducto").blur(function(){
		//alert("Algo pasa");
		if($("#txtProducto").val() != ""){
			$.post("funciones.php",{
				opc:'ConsultarProducto',
				prod:$("#txtProducto").val()
			}, function(data){
				$("#divProducto").html(data[0]);
				$("#divVlr").html(data[1]);
				$("#divCant").html(data[2]);
			},'json');
		}
	});
	
	$("#btnAgregar").click(function(){
		var vContinuar = true;
		$("#btnAgregar").attr("disabled","disabled");
		if($("#txtClienteV").val() == ""){
			alert("Debe ingresar el C&oacute;digo del Cliente");
			$("#txtClienteV").focus();
			vContinuar = false;
		}
		if(vContinuar){
			if($("#txtClaveClV").val() == ""){
				alert("Debe ingresar la Clave");
				$("#txtClaveClV").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtProducto").val() == ""){
				alert("Debe ingresar el Producto");
				$("#txtProducto").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtCantidad").val() == ""){
				alert("Debe ingresar la Cantidad");
				$("#txtCantidad").focus();
				vContinuar = false;
			}
		}
		var vSaldoUs = parseFloat($("#divSaldoCl").html());
		var vCantPro = parseInt($("#divCant").html());
		var vVlrPro = parseFloat($("#divVlr").html());
		var vCantUs = parseInt($("#txtCantidad").val());
		var vVlrTot = $("#divVlrTot").html();
		if(vContinuar){
			if($("#txtCantidad").val() > 0){
				if(vCantUs > vCantPro){
					alert("La Cantidad debe ser menor a la disponible");
					$("#txtCantidad").focus();
					vContinuar = false;
				}
			}
		}
		if(vContinuar){
			if(vVlrTot == ""){
				vVlrTot = 0;
			}
			else{
				vVlrTot = parseFloat(vVlrTot);
			}
			//alert("saldo cl: " + vSaldoUs + " Vlr Tot: " + vVlrTot + " Cant Us: " + vCantUs + " Vlr Prod" + vVlrPro);
			if(vSaldoUs < (vVlrTot + (vCantUs * vVlrPro))){
				alert("El saldo disponible no le alcanza para la cantidad de este producto");
				$("#txtCantidad").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			//alert("Continuar");
			$.post("funciones.php",{
				opc:'AgregarProductoVta',
				nrof:$("#divNroFra").html(),
				cli:$("#txtClienteV").val(),
				clav:$("#txtClaveClV").val(),
				prod:$("#txtProducto").val(),
				cant: vCantUs
			}, function(data){
				$("#divVlrTot").html(data[0]);
				$("#divSaldoParc").html(data[1]);
				$("#divLstProds").html(data[2]);
				$("#divAlerta").html(data[3]);
				$("#txtProducto").val("");
				$("#divProducto").html("");
				$("#divVlr").html("");
				$("#divCant").html("");
				$("#txtCantidad").val("");
			},'json');
//			alert("Saldo: " + vSaldoUs + " Cant Disp: " + vCantPro + " Cant Compra: " + vCantUs);
		}
		$("#btnAgregar").removeAttr("disabled");
	});

	$("#btnComprar").click(function(){
		var vContinuar = true;
		$("#btnComprar").attr("disabled", "disabled");
		if($("#txtClienteV").val() == ""){
			alert("Debe ingresar el C&oacute;digo del Cliente");
			$("#txtClienteV").focus();
			vContinuar = false;
		}
		if(vContinuar){
			if($("#txtClaveClV").val() == ""){
				alert("Debe ingresar la Clave");
				$("#txtClaveClV").focus();
				vContinuar = false;
			}
		}
		if(vContinuar){
			if($("#txtBlJust").val() == "1"){
				if($("#txtJustif").val() == ""){
					alert("Debe ingresar la Justificación");
					$("#txtJustif").focus();
					vContinuar = false;
				}
			}
		}
		if(vContinuar){
			var vVlrTot = parseFloat($("#divVlrTot").html());
			$.post("funciones.php",{
				opc:'CrearVta',
				nrof:$("#divNroFra").html(),
				cli:$("#txtClienteV").val(),
				clav:$("#txtClaveClV").val(),
				vlrtot:vVlrTot,
				just:$("#txtJustif").val()
			}, function(data){
				$.post("funciones.php",{
					opc:'CorreoVenta',
					nrof:$("#divNroFra").html(),
					cli:$("#txtClienteV").val(),
					just:$("#txtJustif").val()
				}, function(data2){
					$("#divNroFra").html(data[0]);
					$("#divAlerta").html(data[1]);
					$("#txtClienteV").val("");
					$("#txtClaveClV").val("");
					$("#divNomCl").html("");
					$("#divSaldoCl").html("");		
					$("#txtProducto").val("");
					$("#divProducto").html("");	
					$("#divVlr").html("");
					$("#divCant").html("");
					$("#txtCantidad").val("");
					$("#divLstProds").html("");
					$("#divVlrTot").html("");
					$("#divSaldoParc").html("");
					$("#txtJustif").val("");
					$("#txtJustif").hide();
					$("#txtClienteV").focus();
					//$("#divAlerta").html("");	
				},'json');
			},'json');
		}
		$("#btnComprar").removeAttr("disabled");
	});
/******* Ventas.php ***********/

/******* Informes.php ***********/	
	$("#btnConsultarInf").click(function(){
		var vError = false;
		var vFechI = "";
		var vFechF = "";
		if(vError == false){
			if($("#txtTipoInf").val() == "CarTar" || $("#txtTipoInf").val() == "Vtas" || $("#txtTipoInf").val() == "Entr" || $("#txtTipoInf").val() == "InfDiaVtas" || $("#txtTipoInf").val() == "InfArtClie" || $("#txtTipoInf").val() == "InfDiaCompras"){
				if($("#txtFechIni").val() == ""){
					alert("Debe ingresar la fecha inicial del intervalo a consultar");
					$("#txtFechIni").focus();
					vError = true;
				}
				else{
					vFechI = $("#txtFechIni").val();
				}
				if(vError == false){
					if($("#txtFechFin").val() == ""){
						alert("Debe ingresar la fecha final del intervalo a consultar");
						$("#txtFechFin").focus();
						vError = true;
					}
					else{
						vFechF = $("#txtFechFin").val();
					}
				}
			}
		}
		if(vError == false){
			$.post("funciones.php",{
				opc: 'Informes',
				tipInf: $("#txtTipoInf").val(),
				fechI: vFechI,
				fechF: vFechF
			}, function(data){
				if(data[0] == "OK"){
					$("#tbodyInf").html(data[1]);
				}
				else{
					$("#divAlerta").html(data[0]);
				}
			},'json');
		}
	});
/******* Informes.php ***********/	
});
