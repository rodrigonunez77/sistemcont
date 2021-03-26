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
		

	require_once $App->getPathPages()."Cargo/static.CargosTransaction.php";
	require_once $App->getPathPages()."Log/static.LogsTransaction.php";
    require_once $App->getPathDomain()."lib.Table.php";

	$data = stripslashes($_POST['res']);

	$data = json_decode($data);

	$cargo = new Cargo($data->ID);
	$cargo->setDescripcion(strtoupper($data->DESCRIPCION));
	$cargo->setItem($data->ITEM);
    $cargo->setFechaRegistro($data->FECHAREGISTRO);
    $cargo->setFechaSistema($data->FECHASISTEMA);
    CargosTransaction::update($cargo);

    $log=new Log();
    $descripcion=implode("@",(array)$data);
	$log->setDepartamento($_SESSION['DEPARTAMENTO']);
	$log->setIdUsuario($_SESSION['IDUSUARIO']);
	$log->setFechaRegistro($data->FECHAREGISTRO);
    $log->setFechaSistema($data->FECHASISTEMA);
    $log->setNombreTabla('cargos');
    $log->setNombreModulo('cargo');
    $log->setTipoEvento('update');
    $log->setDescripcion($descripcion);
    $log->setUsuario($_SESSION['USUARIO']);
    $log->setCodigoUnico($cargo->getCodigoUnico());
    LogsTransaction::insert($log);
    
    echo("TRUE");

?>