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
		

	require_once $App->getPathPages()."Lugar/static.LugaresTransaction.php";
	require_once $App->getPathPages()."Log/static.LogsTransaction.php";
    require_once $App->getPathDomain()."lib.Table.php";

	$data = stripslashes($_POST['res']);

	$data = json_decode($data);

	$lugar = new Lugar($data->ID);
	$lugar->setDescripcion(strtoupper($data->DESCRIPCION));
	$lugar->setIdDependencia($data->IDDEPENDENCIA);
	$lugar->setDepartamento($data->DEPARTAMENTO);
	$lugar->setDireccion(strtoupper($data->DIRECCION));
    $lugar->setFechaRegistro($data->FECHAREGISTRO);
    $lugar->setFechaSistema($data->FECHASISTEMA);
    LugaresTransaction::update($lugar);

    $log=new Log();
    $descripcion=implode("@",(array)$data);
	$log->setDepartamento($_SESSION['DEPARTAMENTO']);
	$log->setIdUsuario($_SESSION['IDUSUARIO']);
	$log->setFechaRegistro($data->FECHAREGISTRO);
    $log->setFechaSistema($data->FECHASISTEMA);
    $log->setNombreTabla('lugares');
    $log->setNombreModulo('lugar');
    $log->setTipoEvento('update');
    $log->setDescripcion($descripcion);
    $log->setUsuario($_SESSION['USUARIO']);
    $log->setCodigoUnico($lugar->getCodigoUnico());
    LogsTransaction::insert($log);
    
    echo("TRUE");

?>