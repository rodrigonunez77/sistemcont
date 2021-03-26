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

    $codigoUnico=$_POST['FECHASISTEMA'].'-'.$_SESSION['DEPARTAMENTO'].$_GET['SID'];

   // echo $_POST['check-factura-1'];
	   		

    //echo ($_POST['TABLAENCOMIENDA']);


		//$log=new Log();

	$totalB=0;
    $totalPagado=0;
    $totalPorPagar=0;
    $tablaEnco=explode('@', $_POST['TABLAENCOMIENDA']);
    
    for ($i=1; $i <=50 ; $i++) { 
	    	# code...
	   	if (isset($_POST['td-nroguia-'.$i]) && trim($_POST['td-nroguia-'.$i])!='') {
   			$totalPagado=$totalPagado+$_POST['td-pagado-'.$i];
    		$totalPorPagar=$totalPorPagar+$_POST['td-porpagar-'.$i];
		}

	}

	$sentencia="insert into`encomienda` set `DEPARTAMENTO`='".$_SESSION['DEPARTAMENTO']."',`IDLUGAR`='".$_SESSION['IDLUGAR']."',`IDUSUARIO`='".$_GET['SID']."',`USUARIO`='".$_SESSION['USUARIO']."',`FECHASISTEMA`='".$_POST['FECHASISTEMA']."',`FECHAREGISTRO`='".$_POST['FECHAREGISTRO']."',`NROENCOMIENDA`='".$_POST['NROENCOMIENDA']."',`NROBUS`='".$_POST['NROBUS']."',`NROPLACA`='".$_POST['NROPLACA']."',`LOCALIDAD`='".$_POST['LOCALIDAD']."',`CONDUCTOR`='".$_POST['CONDUCTOR']."',`NROLICENCIA`='".$_POST['NROLICENCIA']."',`RELEVO`='".$_POST['RELEVO']."',`NROLICENCIAREV`='".$_POST['NROLICENCIAREV']."',`CODIGOUNICO`='".$codigoUnico."_ENCOMIENDA',`TOTALBULTOS`='".$totalB."',`TOTALPAGADO`='".$totalPagado."',`TOTALPORPAGAR`='".$totalPorPagar."' ";
	Table::executeQuery($sentencia);
	
	$sentenciaMax="SELECT MAX(IDENCOMIENDA) AS IDCOMIENDA FROM encomienda WHERE IDUSUARIO=".$_GET['SID']." AND IDLUGAR=".$_SESSION['IDLUGAR'];
	$DataMax=Table::getListQuery($sentenciaMax);

	

	 for ($i=1; $i <=50 ; $i++) { 
	    	# code...
	   	if (isset($_POST['td-nroguia-'.$i]) && trim($_POST['td-nroguia-'.$i])!='') {

	   		if (isset($_POST['check-factura-'.$i]) && $_POST['check-factura-'.$i] == '1'){
	   			$factura='SI';
	   		}
	   		else{
	   			$factura='NO';
	   		}


			$sentenciaDetalle="insert into `detalleencomienda` set `IDENCOMIENDA`=".$DataMax[0]['IDCOMIENDA'].",
			`DEPARTAMENTO`='".$_SESSION['DEPARTAMENTO']."',`IDLUGAR`='".$_SESSION['IDLUGAR']."',
			`IDUSUARIO`='".$_GET['SID']."',`USUARIO`='".$_SESSION['USUARIO']."',
			`NROGUIA`='".$_POST['td-nroguia-'.$i]."',`REMITENTE`='".$_POST['td-remitente-'.$i]."',
			`NROBULTO1`='".$_POST['td-nrobulto-'.$i]."',`CONSIGNATARIO`='".$_POST['td-consignatario-'.$i]."',
			`CI`='".$_POST['td-ci-'.$i]."',`CONTENIDO`='".$_POST['td-contenido-'.$i]."',
			`IMPPAGADO`='".$_POST['td-pagado-'.$i]."',`IMPPORPAGAR`='".$_POST['td-porpagar-'.$i]."',
			`CODIGOUNICO`='".$codigoUnico."_DETALLEENCOMIENDA',`FACTURA`='".$factura."' ";
			Table::executeQuery($sentenciaDetalle);
		}

	}
	

		//$descripcion=implode("@",(array)$data);

		/*$log->setDepartamento($_SESSION['DEPARTAMENTO']);
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
*/
	    echo("TRUE");

    
   
	
	
?>