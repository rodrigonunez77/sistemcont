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
		

	require_once $App->getPathPages()."Movimiento/static.MovimientosTransaction.php";
    require_once $App->getPathDomain()."lib.Table.php";
	
	$data = stripslashes($_POST['res']);

	$data = json_decode($data);

	$movimiento = new Movimiento();

    $movimiento->setDepartamento($_SESSION['DEPARTAMENTO']);
	$movimiento->setIdLugar(1);
	$movimiento->setIdUsuario($_GET['SID']);
	$movimiento->setNroReciboIngreso(0);
	$movimiento->setNroReciboEgreso($data->NRORECIBOEGRESO);
	$movimiento->setTipoRegistro('S');
	$movimiento->setFechaRegistro($data->FECHAREGISTRO);
    $movimiento->setFechaSistema($data->FECHAREGISTRO);
	$movimiento->setNombreOrigen('FLOTA YUNGUEÑA');
	$movimiento->setNombreDestino($data->NOMBREDESTINO);
	$movimiento->setIdConcepto(0);
	$movimiento->setConcepto($data->CONCEPTO);
	$movimiento->setTipoConcepto('GENERAL');
	$movimiento->setMontoBs($data->MONTOBS);
	$movimiento->setObservacion($data->OBSERVACION);
	$movimiento->setEstado('PAGADO');
	$movimiento->setEstadoDeposito('CONFIRMADO');
	$movimiento->setTipoPago($data->TIPOPAGO);
	$movimiento->setCodigoUnico('10');
	$movimiento->setGlosa('-');
	$movimiento->setAutorizadoPor('-');
	$movimiento->setRevisadoPor('-');
	$movimiento->setPreparadoPor('-');


	if(!MovimientosTransaction::insert($movimiento)) die("Error en la insercion de usuarios");
	
    echo("TRUE");
    
	
?>