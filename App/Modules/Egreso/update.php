<?PHP
	/*
	*	CABECERA
	*/
	require_once '../../Core/Components/App.inc.php';
	require_once $App->getPathSecurity("Security.php");	 
	Security::ValidSession();
		/*	Datos del ususario	*/
		require_once $App->getPathDomain()."Usuario.php";	 	 
		$rol = Security::decrypt($_SESSION['ROLES']);
		/* VarsEnviroment	*/
		$Vars = "?SID=".$_GET["SID"]."&SESION=".$_GET["SESION"]."&R=".$_GET["R"];
		$VarsAjax = "SID=".$_GET["SID"]."&SESION=".$_GET["SESION"]."&R=".$_GET["R"];
		$titulo = "";
	/*
	*	FIN CABECERA 
	*/
		

    require_once $App->getPathPages()."Log/static.LogsTransaction.php";
	require_once $App->getPathPages()."Movimiento/static.MovimientosTransaction.php";
    require_once $App->getPathDomain()."lib.Table.php";

	
	$data = stripslashes($_POST['res']);

	$data = json_decode($data);

	$movimiento = new Movimiento($data->IDMOVIMIENTO);
  
   // $movimiento->setDepartamento($_SESSION['DEPARTAMENTO']);
//movimiento->setIdLugar(1);
	//$movimiento->setIdUsuario($_GET['SID']);
	$movimiento->setNroReciboIngreso(0);
	$movimiento->setNroReciboEgreso($data->NRORECIBOEGRESO);
	$movimiento->setTipoRegistro('S');
	$movimiento->setFechaRegistro($data->FECHAREGISTRO);
    $movimiento->setFechaSistema($data->FECHAREGISTRO);
	$movimiento->setNombreOrigen('FLOTA YUNGUEÑA');
	$movimiento->setNombreDestino($data->NOMBREDESTINO);
	$movimiento->setIdConcepto($data->CONCEPTOU);
	$movimiento->setConcepto($data->DESCRIPCIONU);
	$movimiento->setTipoConcepto($data->TIPOCONCEPTO);
	$movimiento->setMontoBs($data->MONTOBS);
	$movimiento->setAcuenta($data->ACUENTA);
	$movimiento->setSaldo($data->SALDO);
	$movimiento->setTotalBs($data->TOTALBS);
	$movimiento->setObservacion($data->OBSERVACION);
	$movimiento->setEstado('PAGADO');
	$movimiento->setTipoPago($data->TIPOPAGO);
	$movimiento->setCodigoUnico('10');
	$movimiento->setGlosa('-');
	$movimiento->setAutorizadoPor('-');
	$movimiento->setRevisadoPor('-');
	$movimiento->setPreparadoPor('-');
    MovimientosTransaction::update($movimiento);


	$descripcion=implode("@",(array)$data);
	$log=new Log();
	$log->setDepartamento($_SESSION['DEPARTAMENTO']);
	$log->setIdUsuario($_SESSION['IDUSUARIO']);
	$log->setFechaRegistro($data->FECHAREGISTRO);
    $log->setFechaSistema($data->FECHASISTEMA);
    $log->setNombreTabla('movimientos');
    $log->setNombreModulo('egreso');
    $log->setTipoEvento('update');
    $log->setDescripcion($descripcion);
    $log->setUsuario($_SESSION['USUARIO']);
    $log->setCodigoUnico($movimiento->getCodigoUnico());
    LogsTransaction::insert($log);
    
	//if(!MovimientosTransaction::update($movimiento)) die("Error al insertar Egresos");
	
    echo("TRUE");
    
	
?>