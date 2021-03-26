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

	$data = stripslashes($_POST['res']);

	$data = json_decode($data);

    //$codigoUnico=$_POST['FECHASISTEMA'].'-'.$_SESSION['DEPARTAMENTO'].$_GET['SID'];

   // echo $_POST['check-factura-1'];
	   		

    //echo ($_POST['TABLAENCOMIENDA']);


		//$log=new Log();

	//echo $data->NROPLACA."   ---";

	if($data->ANTICIPO>0){
		$sentenciaDel="DELETE FROM `descuentoencomienda` WHERE `FECHAREGISTRO`='".$data->FECHAREGISTRO."' AND `NROPLACA`='".$data->NROPLACA."' ";
		Table::executeQuery($sentenciaDel);

		$sentencia="INSERT  INTO `descuentoencomienda` SET `DEPARTAMENTO`='".$_SESSION['DEPARTAMENTO']."',`IDLUGAR`='".$_SESSION['IDLUGAR']."',`IDUSUARIO`='".$_GET['SID']."',`USUARIO`='".$_SESSION['USUARIO']."',`FECHASISTEMA`='".$data->FECHASISTEMA."',`FECHAREGISTRO`='".$data->FECHAREGISTRO."',`NROPLACA`='".$data->NROPLACA."',`ANTICIPO`='".$data->ANTICIPO."' ";
		Table::executeQuery($sentencia);
	

		
		echo "TRUE";
	}
	else{
		echo " Error! el monto es incorrecto.";
	}

/*
	$sentencia="insert into`encomienda` set `DEPARTAMENTO`='".$_SESSION['DEPARTAMENTO']."',`IDLUGAR`='".$_SESSION['IDLUGAR']."',`IDUSUARIO`='".$_GET['SID']."',`USUARIO`='".$_SESSION['USUARIO']."',`FECHASISTEMA`='".$_POST['FECHASISTEMA']."',`FECHAREGISTRO`='".$_POST['FECHAREGISTRO']."',`NROENCOMIENDA`='".$_POST['NROENCOMIENDA']."',`NROBUS`='".$_POST['NROBUS']."',`NROPLACA`='".$_POST['NROPLACA']."',`LOCALIDAD`='".$_POST['LOCALIDAD']."',`CONDUCTOR`='".$_POST['CONDUCTOR']."',`NROLICENCIA`='".$_POST['NROLICENCIA']."',`RELEVO`='".$_POST['RELEVO']."',`NROLICENCIAREV`='".$_POST['NROLICENCIAREV']."',`CODIGOUNICO`='".$codigoUnico."_ENCOMIENDA',`TOTALBULTOS`='".$totalB."',`TOTALPAGADO`='".$totalPagado."',`TOTALPORPAGAR`='".$totalPorPagar."' ";
	Table::executeQuery($sentencia);
	
	    echo("TRUE");
*/
    
   
	
	
?>