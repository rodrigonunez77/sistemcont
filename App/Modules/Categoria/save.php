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
		

	require_once $App->getPathPages()."Categoria/static.CategoriasTransaction.php";
	require_once $App->getPathPages()."Log/static.LogsTransaction.php";
    require_once $App->getPathDomain()."lib.Table.php";

	$data = stripslashes($_POST['res']);

	$data = json_decode($data);
   
	$codigoUnico=$data->FECHASISTEMA.'-'.$_SESSION['DEPARTAMENTO'].$_GET['SID'];

	$categoria = new Categoria();
	$categoria->setDescripcion(strtoupper($data->DESCRIPCION));
	$categoria->setTipoConcepto(strtoupper($data->TIPOCONCEPTO));
    $categoria->setCodigoUnico($codigoUnico);
    CategoriasTransaction::insert($categoria);

	$log=new Log();
	
	$descripcion=implode("@",(array)$data);

	$log->setDepartamento($_SESSION['DEPARTAMENTO']);
	$log->setIdUsuario($_SESSION['IDUSUARIO']);
	$log->setFechaRegistro($data->FECHAREGISTRO);
    $log->setFechaSistema($data->FECHASISTEMA);
    $log->setNombreTabla('categorias');
    $log->setNombreModulo('categoria');
    $log->setTipoEvento('insert');
    $log->setDescripcion($descripcion);
    $log->setUsuario($_SESSION['USUARIO']);
    $log->setCodigoUnico($codigoUnico);
    LogsTransaction::insert($log);

    echo("TRUE");
	
?>