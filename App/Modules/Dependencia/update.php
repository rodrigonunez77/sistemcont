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
		

	require_once $App->getPathPages()."Dependencia/static.DependenciasTransaction.php";
	require_once $App->getPathPages()."Log/static.LogsTransaction.php";
    require_once $App->getPathDomain()."lib.Table.php";

	$data = stripslashes($_POST['res']);

	$data = json_decode($data);

	$dependencia = new Dependencia($data->ID);
	$dependencia->setDescripcion(strtoupper($data->DESCRIPCION));
	$dependencia->setTipo($data->TIPO);
	$dependencia->setDepartamento('-');
	$dependencia->setDireccion(strtoupper($data->DIRECCION));
	$dependencia->setSistemas($data->SISTEMAS);
    $dependencia->setFechaRegistro($data->FECHAREGISTRO);
    $dependencia->setFechaSistema($data->FECHASISTEMA);
    DependenciasTransaction::update($dependencia);

    $log=new Log();
    $descripcion=implode("@",(array)$data);
	$log->setDepartamento($_SESSION['DEPARTAMENTO']);
	$log->setIdUsuario($_SESSION['IDUSUARIO']);
	$log->setFechaRegistro($data->FECHAREGISTRO);
    $log->setFechaSistema($data->FECHASISTEMA);
    $log->setNombreTabla('dependencias');
    $log->setNombreModulo('dependencia');
    $log->setTipoEvento('update');
    $log->setDescripcion($descripcion);
    $log->setUsuario($_SESSION['USUARIO']);
    $log->setCodigoUnico($dependencia->getCodigoUnico());
    LogsTransaction::insert($log);
    
    echo("TRUE");

?>