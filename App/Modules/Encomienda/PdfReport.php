<?php 
		ini_set('max_execution_time', 900000);
		ini_set('memory_limit',"2000000M");
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
	require_once $App->getPathDomain()."lib.Table.php";
	require_once $App->getPathComponents("Formatos/static.ConvertirNumerosLetras.php"); 
	require_once $App->getPathComponents("ReportPdf/class.docPDFVerticalInfoDiario.inc.php");
	
	/*$fechaInicio=explode('-',$_GET["f"]);
	$fechaInicio=$fechaInicio[2].'/'.$fechaInicio[1].'/'.$fechaInicio[0];

	*/
	$GLOBALS['PIE_USUARIO']=$_SESSION['USUARIO'];
	$GLOBALS['TITULO_GENERAL']="";
	$GLOBALS['TITULO_REPORTE']="";
	$GLOBALS['TITULO_FECHA']="";
	$GLOBALS['FILE_LOGO']= $App->getImagen("logo.jpeg");
	

	
	//echo "<BR><h1>---- PAGINA EN CONSTRUCCION ---- </h1></BR>";
	
	// PREPARANDO LA MATRIZ

	
	
	$pdf = new docPDF("P","mm","Letter");
	$pdf->AddPage(); 
	$alto=6; 

	
    

    $pdf->OutPut();

?>
