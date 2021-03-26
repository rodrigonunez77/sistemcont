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
	require_once $App->getPathComponents("ImagenesOperaciones/ImagenUpload.php");
    require_once $App->getPathDomain()."lib.Table.php";
	
	//$data = stripslashes($_POST['res']);

	//$data = json_decode($data);
    $tipoPago="";
	if(isset($_POST['TIPOPAGO'])){
		$tipoPago=$_POST['TIPOPAGO'];
	}

	$movimiento = new Movimiento($_POST['IDMOVIMIENTO']);

    //$movimiento->setDepartamento($_SESSION['DEPARTAMENTO']);
	//$movimiento->setIdLugar(1);
	//$movimiento->setIdUsuario($_GET['SID']);
	$movimiento->setNroReciboIngreso($_POST['NRORECIBOINGRESO']);
	$movimiento->setNroReciboEgreso(1);
	$movimiento->setTipoRegistro('I');
	$movimiento->setFechaRegistro($_POST['FECHAREGISTRO']);
    $movimiento->setFechaSistema($_POST['FECHAREGISTRO']);
	$movimiento->setNombreOrigen($_POST['NOMBREORIGEN']);
	$movimiento->setNombreDestino('FLOTA YUNGUEÑA');
	$movimiento->setIdConcepto(0);
	$movimiento->setConcepto($_POST['CONCEPTO']);
	$movimiento->setTipoConcepto('GENERAL');
	$movimiento->setMontoBs($_POST['MONTOBS']);
	$movimiento->setObservacion($_POST['OBSERVACION']);
	$movimiento->setEstado($_POST['ESTADO']);
	$movimiento->setTipoPago($tipoPago);
	$movimiento->setCodigoUnico('10');
	$movimiento->setGlosa('-');
	$movimiento->setAutorizadoPor('-');
	$movimiento->setRevisadoPor('-');
	$movimiento->setPreparadoPor('-');

	if (isset($_FILES["IMAGENU"]["name"])) {
		if($_FILES["IMAGENU"]["name"]!=""){
			
			// guardamos la imagen
			$extension = explode(".",$_FILES["IMAGENU"]["name"]);
			$num = count($extension)-1;
			$ext = $extension[$num];
				
			$movimiento->setImgDeposito('DEP-'.$_POST['NRORECIBOINGRESO'].".".$ext);
			
			$imagen = new ImagenUpload();
			//$imagen->remove("Empleados/");
			$imagen->upload($_FILES["IMAGENU"],'DEP-'.$_POST['NRORECIBOINGRESO']."","Depositos/");		
		}
	}
	


	MovimientosTransaction::update($movimiento);

	//if(!MovimientosTransaction::update($movimiento)) die("Error en la insercion de usuarios");
	
    echo("TRUE");
	
?>