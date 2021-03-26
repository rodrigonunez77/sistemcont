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
		

	require_once $App->getPathPages()."Liquidacion/static.LiquidacionesTransaction.php";
	//require_once $App->getPathPages()."DetalleDescuento/static.DetalleDescuentosTransaction.php";
	//require_once $App->getPathPages()."DetalleDestino/static.DetalleDestinosTransaction.php";
	require_once $App->getPathPages()."Log/static.LogsTransaction.php";
    require_once $App->getPathDomain()."lib.Table.php";

	$data = stripslashes($_POST['res']);

	$data = json_decode($data);

	//$liquidacion = new Liquidacion($data->ID);
	//$detalleDescuento = new DetalleDescuento($data->ID);
	//$detalleDestino = new DetalleDestino($data->ID);
	
    $log=new Log();
    $dataEncomienda=Table::getListQuery("select CODIGOUNICO from encomienda where IDENCOMIENDA=".$data->ID);
   // $descripcion=implode("@",(array)$liquidacion);
    if (isset($dataEncomienda[0]['CODIGOUNICO'])) {
    	$codUnico=$dataEncomienda[0]['CODIGOUNICO'];
    }
    else{
    	$codUnico="";
    }
	$log->setDepartamento($_SESSION['DEPARTAMENTO']);
	$log->setIdUsuario($_SESSION['IDUSUARIO']);
	$log->setFechaRegistro($data->FECHAREGISTRO);
    $log->setFechaSistema($data->FECHASISTEMA);
    $log->setNombreTabla('encomienda');
    $log->setNombreModulo('del encomiendas');
    $log->setTipoEvento('delete');
    $log->setDescripcion('');
    $log->setUsuario($_SESSION['USUARIO']);
    $log->setCodigoUnico($codUnico);
    LogsTransaction::insert($log);


    Table::executeQuery("Delete from encomienda where IDENCOMIENDA=".$data->ID);
    
    
    echo("TRUE");
	
?>