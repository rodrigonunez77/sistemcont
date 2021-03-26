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
	$GLOBALS['TITULO_GENERAL']="COMPROBANTE DE EGRESO";
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
	$pdf->SetXY(18,54);
	$pdf->Cell(70,$alto,'BS.: '.number_format($Data[0]['MONTOBS'], 2,',','.'),'0', 0 , 'L',0 );//
	$pdf->Cell(70,$alto,"FECHA: ".$fechaReg,'0', 0 , 'L',0);
	$pdf->Cell(70,$alto,"NRO:".str_pad($Data[0]['NRORECIBOEGRESO'],8,'0',STR_PAD_LEFT),'0', 0 , 'L',0);
	$pdf->Ln();

	$pdf->SetXY(18,64);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(140,$alto,'HEMOS ENTREGADO A:................................................................................................................... ','0', 0 , 'L',0 );//
	$pdf->SetXY(71,63);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(140,$alto,strtoupper(utf8_decode($Data[0]['NOMBREDESTINO'])),'0', 0 , 'L',0 );//
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
	$pdf->Cell(140,$alto,$Data[0]['CONCEPTO'],'0', 0 , 'L',0 );//


	$pdf->SetXY(18,102);
	$pdf->SetFont('Arial','B',6);
	
	$pdf->Cell(90,7,"OBSERVACIONES",'LTR', 0 , '',0 );
	$pdf->Cell(90,7,"RECIBI CONFORME",'TR', 0 , 'C',0 );
	$pdf->SetFont('Arial','B',6);
	$pdf->Ln();
	$pdf->SetX(18);
	$pdf->Cell(90,7,"",'LR', 0 , '',0 );
	$pdf->Cell(90,7,"NOMBRE................................................................",'R', 0 , '',0 );
	$pdf->SetFont('Arial','B',6);
	$pdf->Ln();
	$pdf->SetX(18);
	$pdf->Cell(90,7,"",'LR', 0 , '',0 );
	$pdf->Cell(90,7,"CI:.......................................................................",'R', 0 , '',0 );
	
	$pdf->SetXY(18,123);

	$pdf->SetFont('Arial','B',6);
	$pdf->Cell(45,20,"",'LTR', 0 , 'C',0 );
	$pdf->Cell(45,20,"",'TR', 0 , 'C',0 );
    $pdf->Cell(45,20,"",'TR', 0 , 'C',0 );
	$pdf->Cell(45,20,"",'TR', 0 , 'C',0 );
	$pdf->SetXY(18,143);
	$pdf->SetFont('Arial','B',6);
	$pdf->Cell(45,6,"PRESIDENTE",'LTR', 0 , 'C',0 );
	$pdf->Cell(45,6,"STRIO. HACIENDA",'TR', 0 , 'C',0 );
    $pdf->Cell(45,6,"STRIO. TRANSPORTE",'TR', 0 , 'C',0 );
	$pdf->Cell(45,6,"REG. INTERNO",'TR', 0 , 'C',0 );
	
	$pdf->SetXY(18,149);
	$pdf->SetFont('Arial','B',6);
	$pdf->Cell(180,20,"",'T', 0 , 'C',0 );
	
    $pdf->SetXY(18,107);
	$pdf->SetFont('Arial','',6);
	$pdf->MultiCell(90,3,$Data[0]['OBSERVACION'],'', 'L',false );
   

	// codigo para los saldos
	$pdf->SetFont('Arial','B',12);
	$pdf->SetXY(18,92);
	$pdf->Cell(70,$alto,'A CUENTA: '.number_format($Data[0]['MONTOBS'], 2,',','.'),'0', 0 , 'L',0 );//
	$pdf->Cell(70,$alto,"SALDO: ".number_format($Data[0]['SALDO'], 2,',','.'),'0', 0 , 'L',0);
	$pdf->Cell(70,$alto,"TOTAL :".number_format($Data[0]['TOTALBS'], 2,',','.'),'0', 0 , 'L',0);
	$pdf->Ln();

	$pdf->OutPut();
	

?>
