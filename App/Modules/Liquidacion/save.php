<?PHP
	/*
	*	CABECERA
	*/
	require_once '../../Core/Components/App.inc.php';
	require_once $App->getPathSecurity("Security.php");	 
	Security::ValidSession();
		/*	Datos del ususario	*/
		require_once $App->getPathDomain()."Usuario.php";	 	 
		// $rol = Security::decrypt($_SESSION['ROLES']);
        $rol = ($_SESSION['ROLES']);
		/* VarsEnviroment	*/
		$Vars = "?SID=".$_GET["SID"]."&SESION=".$_GET["SESION"]."&R=".$_GET["R"];
		$VarsAjax = "SID=".$_GET["SID"]."&SESION=".$_GET["SESION"]."&R=".$_GET["R"];
		$titulo = "";
	/*
	*	FIN CABECERA 
	*/
		
	//require_once $App->getPathPages()."Persona/static.PersonasTransaction.php";
	require_once $App->getPathPages()."Liquidacion/static.LiquidacionesTransaction.php";
	require_once $App->getPathPages()."DetalleDestino/static.DetalleDestinosTransaction.php";
	require_once $App->getPathPages()."DetalleDescuento/static.DetalleDescuentosTransaction.php";
	require_once $App->getPathPages()."Log/static.LogsTransaction.php";
    require_once $App->getPathDomain()."lib.Table.php";

	//$data = stripslashes($_POST['res']);

	//$data = json_decode($data);
	/*$persona = new Persona();

	$idPersona=PersonasTransaction::getCodeNext();

	$persona->setIdPersona($idPersona);
	$persona->setDni($_POST['CI']);
    $persona->setNombre($_POST['NOMBRE']);
    $persona->setPaterno($_POST['PATERNO']);
    $persona->setMaterno($_POST['MATERNO']);
    $persona->setTelefono('');
    $persona->setEmail('');
    $persona->setExpedido('');
    $persona->setDireccion('');
    $persona->setObservacion('');
    $persona->setImagen('');

    PersonasTransaction::insert($persona);

*/
    if($_POST['LIQUIDOPAGABLE']<=0){

    	echo "TRUEFALSE";
    }
    else{
    	$codigoUnico=$_POST['FECHASISTEMA'].'-'.$_SESSION['DEPARTAMENTO'].$_GET['SID'];

    	//$DataLiq=Table::getListQuery("select max(NROINFORME) AS NROINFORME from liquidacion where IDUSUARIO='".$_GET['SID']."'");

    	$DataNro=Table::getListQuery("select NROINFORME from liquidacion where IDUSUARIO='".$_GET['SID']."' AND FECHAREGISTRO='".$_POST['FECHAREGISTRO']."' ");

    	$nroInfo=0;
    	if(isset($DataNro[0]['NROINFORME'])){
           $nroInfo=$DataNro[0]['NROINFORME'];
    	}
    	else{
		     $DataNro=Table::getListQuery("select max(NROINFORME) AS NROINFORME from liquidacion ");
		     $nroInfo=($DataNro[0]['NROINFORME'])+1;
    	}
		$liquidacion = new Liquidacion();
		$liquidacion->setFechaRegistro($_POST['FECHAREGISTRO']);
		$liquidacion->setFechaSistema($_POST['FECHASISTEMA']);
		$liquidacion->setLugarViaje($_POST['LUGARVIAJE']);
		$liquidacion->setCi($_POST['CI']);
	    $liquidacion->setNombre(strtoupper($_POST['NOMBRE']));
	    $liquidacion->setPaterno(strtoupper($_POST['PATERNO']));
	    $liquidacion->setMaterno(strtoupper($_POST['MATERNO']));
	    $liquidacion->setNroPlaca(strtoupper($_POST['NROPLACA']));

	    $liquidacion->setCiChofer($_POST['CICHOFER']);
	    $liquidacion->setNombreChofer(strtoupper($_POST['NOMBRECHOFER']));
	    $liquidacion->setPaternoChofer(strtoupper($_POST['PATERNOCHOFER']));
	    $liquidacion->setMaternoChofer(strtoupper($_POST['MATERNOCHOFER']));

	    $liquidacion->setNroInforme($nroInfo);
	    $liquidacion->setTotalRecaudado($_POST['TOTALRECAUDADO']);
	    $liquidacion->setDescuento($_POST['TOTALDESCUENTO']);
	    $liquidacion->setLiquidoPagable($_POST['LIQUIDOPAGABLE']);
	    $liquidacion->setIdUsuario($_GET['SID']);
	    $liquidacion->setIdLugar($_SESSION['IDLUGAR']);
	    $liquidacion->setDepartamento($_SESSION['DEPARTAMENTO']);
	    $liquidacion->setCodigoUnico($codigoUnico.'-liquidacion');
	    LiquidacionesTransaction::insert($liquidacion);

	    $DataLiq=Table::getListQuery("select max(IDLIQUIDACION) AS IDLIQUIDACION from liquidacion where IDUSUARIO='".$_GET['SID']."'");

	    ///detalle descuento
	    //$aporteOfi=0;
	    //$retencion=0;
	    for ($i=1; $i <=15 ; $i++) { 
	    	# code...
	   		if (isset($_POST['td-descripcion-'.$i]) && trim($_POST['td-descripcion-'.$i])!='') {
	    		# code...

	    		if($i<=2){

	    		}
				$detalleDescuento = new DetalleDescuento();
			    $detalleDescuento->setIdLiquidacion($DataLiq[0]['IDLIQUIDACION']);
			    $detalleDescuento->setIdCategoria($_POST['td-categoria-'.$i]);
			    $detalleDescuento->setTipoConcepto('-');
			    $detalleDescuento->setDescripcion($_POST['td-descripcion-'.$i]);
			    $detalleDescuento->setDescuento($_POST['td-descuento-'.$i]);
			    $detalleDescuento->setPorcentaje($_POST['td-porcentaje-3']);
			    $detalleDescuento->setIdUsuario($_GET['SID']);
			    $detalleDescuento->setIdLugar($_SESSION['IDLUGAR']);
			    $detalleDescuento->setDepartamento($_SESSION['DEPARTAMENTO']);
			    $detalleDescuento->setCodigoUnico($codigoUnico.'-detalleDescuento');
			    detalleDescuentosTransaction::insert($detalleDescuento);
			}	
	    }
	    //detall destino
	    for ($i=1; $i <=15 ; $i++) { 
	    	# code...
	    	if (isset($_POST['td-localidad-'.$i]) && trim($_POST['td-localidad-'.$i])!='') {
	    		# code...
			    $detalleDestino = new DetalleDestino();
			    $detalleDestino->setIdLiquidacion($DataLiq[0]['IDLIQUIDACION']);
			    $detalleDestino->setLocalidad(strtoupper($_POST['td-localidad-'.$i]));
			    $detalleDestino->setNroPasajero($_POST['td-nropasajero-'.$i]);
			    $detalleDestino->setCostoPasaje($_POST['td-costopasaje-'.$i]);
			    $detalleDestino->setImporte($_POST['td-importe-'.$i]);
			    $detalleDestino->setIdUsuario($_GET['SID']);
			    $detalleDestino->setIdLugar($_SESSION['IDLUGAR']);
			    $detalleDestino->setDepartamento($_SESSION['DEPARTAMENTO']);
			    $detalleDestino->setCodigoUnico($codigoUnico.'-detalleDestino');
			    LiquidacionesTransaction::insert($detalleDestino);
			}	
	    }


		$log=new Log();
		

		//$descripcion=implode("@",(array)$data);

		$log->setDepartamento($_SESSION['DEPARTAMENTO']);
		$log->setIdUsuario($_SESSION['IDUSUARIO']);
		$log->setFechaRegistro($_POST['FECHAREGISTRO']);
	    $log->setFechaSistema($_POST['FECHASISTEMA']);
	    $log->setNombreTabla('liquidacion');
	    $log->setNombreModulo('liquidaciones');
	    $log->setTipoEvento('insert');
	    $log->setDescripcion('');
	    $log->setUsuario($_SESSION['USUARIO']);
	    $log->setCodigoUnico($codigoUnico.'-liquidacion');
	    LogsTransaction::insert($log);

	    echo("TRUE");

    }
   
	
	
?>