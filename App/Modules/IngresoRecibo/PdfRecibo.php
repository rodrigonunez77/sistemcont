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
	require_once $App->getPathComponents("ReportPdf/class.docPDFVerticalRecibo.inc.php");
	
	$Data=Table::getListQuery("select * from movimientos where IDMOVIMIENTO=".$_GET['IDMOVIMIENTO']);
	
	$GLOBALS['PIE_USUARIO']=$_SESSION['USUARIO'];
	$GLOBALS['TITULO_GENERAL']="RECIBO DE INGRESO";
	$GLOBALS['TITULO_REPORTE']="NRO:".$Data[0]['NRORECIBOEGRESO'];
	$GLOBALS['TITULO_FECHA']="";
	$GLOBALS['FILE_LOGO']= $App->getImagen("logo.jpeg");
	if($Data[0]['IMGDEPOSITO']!=""){
	   $GLOBALS['FILE_DEPOSITO']= '../../Images/Depositos/'.$Data[0]['IMGDEPOSITO'];		
	}


	
	//echo "<BR><h1>---- PAGINA EN CONSTRUCCION ---- </h1></BR>";
	
	// PREPARANDO LA MATRIZ

	$fechaReg=explode('-', $Data[0]['FECHAREGISTRO']);
	$fechaReg=$fechaReg[2]."/".$fechaReg[1].'/'.$fechaReg[0];
	
	$pdf = new docPDF("P","mm","Letter");
	$pdf->AddPage(); 
	$alto=6; 
	$pdf->SetFont('Arial','B',12);
	$pdf->SetXY(160,54);
	//$pdf->Cell(70,$alto,'BS.: '.number_format($Data[0]['MONTOBS'], 2,',','.'),'0', 0 , 'L',0 );//
	//$pdf->Cell(70,$alto,"FECHA: ".$fechaReg,'0', 0 , 'L',0);
	$pdf->Cell(70,$alto,"NRO:".str_pad($Data[0]['NRORECIBOINGRESO'],8,'0',STR_PAD_LEFT),'0', 0 , 'L',0);
	$pdf->Ln();

	$pdf->SetXY(18,64);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(100,$alto,'RECIBIDO DE:.............................................................................................................................. ','0', 0 , 'L',0 );//
	$pdf->SetXY(52,63);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(140,$alto, strtoupper(utf8_decode($Data[0]['NOMBREORIGEN'])),'0', 0 , 'L',0 );//
///////////////////////////////////////////////////////////////////////////////
	$pdf->SetXY(18,74);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(140,$alto,'LA SUMA DE:................................................................................................................................ ','0', 0 , 'L',0 );//
	$pdf->SetXY(51,73);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(140,$alto,convertir_a_letras($Data[0]['MONTOBS']),'0', 0 , 'L',0 );//

	$pdf->SetXY(18,84);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(140,$alto,'POR CONCEPTO DE:................................................................................................................... ','0', 0 , 'L',0 );//
	$pdf->SetXY(65,83);
	$pdf->SetFont('Arial','',10);
	//$pdf->Cell(140,$alto,$Data[0]['CONCEPTO'],'0', 0 , 'L',0 );//
    $pdf->MultiCell(138,$alto,$Data[0]['CONCEPTO'],'', 'L',false );
    ///////PARA EL TOTAL
    $posY=$pdf->GetY();
	$pdf->SetXY(18,$posY+3);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(22,6,"TOTAL BS: ",'', 0 , 'C',0 );
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(40,6,number_format($Data[0]['MONTOBS'], 2,',','.'),'', 0 , 'L',0 );
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(20,6,"SALDO BS: ",'', 0 , '',0 );
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(40,6,number_format(0, 2,',','.'),'', 0 , 'L',0 );
	$pdf->SetFont('Arial','B',10);
    $pdf->Cell(30,6,"FECHA ENTREGA: ",'', 0 , 'C',0 );
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,6,$fechaReg,'', 0 , 'L',0 );


	
	$pdf->SetXY(18,$posY+18);

	$pdf->SetFont('Arial','B',6);
	$pdf->Cell(45,20,"",'LT', 0 , 'C',0 );
	$pdf->Cell(45,20,"",'T', 0 , 'C',0 );
    $pdf->Cell(45,20,"",'T', 0 , 'C',0 );
	$pdf->Cell(45,20,"",'TR', 0 , 'C',0 );
	$pdf->SetXY(18,$posY+35);
	$pdf->SetFont('Arial','B',6);
	$pdf->Cell(60,6,"...................................",'', 0 , 'C',0 );
	$pdf->Cell(60,6,"...............................................",'', 0 , 'C',0 );
    $pdf->Cell(60,6,"................................................",'', 0 , 'C',0 );

	$pdf->SetXY(18,$posY+38);
	$pdf->SetFont('Arial','B',6);
	$pdf->Cell(60,6,"CLIENTE",'L', 0 , 'C',0 );
	$pdf->Cell(60,6,"AUTORIZADO POR",'', 0 , 'C',0 );
    $pdf->Cell(60,6,"STARIO. HACIENDA",'R', 0 , 'C',0 );


	
	$pdf->SetXY(18,$posY+44);
	$pdf->SetFont('Arial','B',6);
	$pdf->Cell(180,20,"",'T', 0 , 'C',0 );
	//PARA LA OBSERVAION
    $pdf->SetXY(18,$posY+50);
	$pdf->SetFont('Arial','B',6);
	$pdf->Cell(22,3,"OBSERVACIONES: ",'', 0 , 'L',0 );

	$pdf->SetFont('Arial','',6);
	$pdf->MultiCell(90,3,$Data[0]['OBSERVACION'],'', 'L',false );
	
	$pdf->OutPut();
	

?>
