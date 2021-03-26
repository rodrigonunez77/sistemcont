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
	require_once $App->getPathComponents("ReportPdf/class.docPDFHorizontal.inc.php");
	
	$Data=Table::getListQuery("Select * from encomienda where IDENCOMIENDA=".$_GET['id']);
	
	$fechaReg=explode('-', $Data[0]['FECHAREGISTRO']);
	$fechaReg=$fechaReg[2]."/".$fechaReg[1].'/'.$fechaReg[0];

	$GLOBALS['PIE_USUARIO']=$_SESSION['USUARIO'];
	$GLOBALS['TITULO_GENERAL']="MANIFIESTO DE ENCOMIENDA NRO: ".str_pad($Data[0]['NROENCOMIENDA'],6,'0',STR_PAD_LEFT);
	$GLOBALS['TITULO_REPORTE']=$fechaReg;
	$GLOBALS['TITULO_FECHA']="";
	$GLOBALS['FILE_LOGO']= $App->getImagen("logo.jpeg");
	/*if($Data[0]['IMGDEPOSITO']!=""){
	   $GLOBALS['FILE_DEPOSITO']="";		
	}
	*/


	
	//echo "<BR><h1>---- PAGINA EN CONSTRUCCION ---- </h1></BR>";
	
	// PREPARANDO LA MATRIZ

	
	
	$pdf = new docPDF("L","mm","Letter");
	$pdf->AddPage(); 
	$alto=6; 
	$pdf->SetFont('Arial','B',10);
	$pdf->SetXY(18,54);
	$pdf->Cell(17,$alto,utf8_decode('BUS Nº.: '),'0', 0 , 'L',0 );
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,$alto,$Data[0]['NROBUS'],'0', 0 , 'L',0 );
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(15,$alto,"PLACA: ",'0', 0 , 'L',0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(50,$alto,$Data[0]['NROPLACA'],'0', 0 , 'L',0);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(25,$alto,"LOCALIDAD:",'0', 0 , 'L',0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(70,$alto,utf8_decode($Data[0]['LOCALIDAD']),'0', 0 , 'L',0);
	$pdf->Ln();
    
    $pdf->SetX(18);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(26,$alto,utf8_decode('CONDUCTOR: '),'0', 0 , 'L',0 );
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(50,$alto, utf8_decode($Data[0]['CONDUCTOR']),'0', 0 , 'L',0 );
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(25,$alto, utf8_decode("Nº:LICENCIA: "),'0', 0 , 'L',0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,$alto,$Data[0]['NROLICENCIA'],'0', 0 , 'L',0);

	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(17,$alto,utf8_decode('RELEVO: '),'0', 0 , 'L',0 );
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(50,$alto,utf8_decode($Data[0]['RELEVO']),'0', 0 , 'L',0 );
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(25,$alto, utf8_decode("Nº:LICENCIA: "),'0', 0 , 'L',0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(50,$alto,$Data[0]['NROLICENCIAREV'],'0', 0 , 'L',0);

	//***TITULO DE LA TABLA MANIFIESTO**/////
	$pdf->Ln();
	$pdf->SetX(18);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(26,$alto,utf8_decode('SIN FACTURA: '),'0', 0 , 'L',0 );
	$pdf->Ln();
	$pdf->SetX(18);
	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(10,$alto,"NRO",'TR', 0 , 'C',0 );
	$pdf->Cell(20,$alto,"NRO. GUIA",'TR', 0 , 'C',0 );
	$pdf->Cell(63,$alto,"REMITENTE",'TR', 0 , 'C',0 );
	$pdf->Cell(20,$alto,"NRO. BULTOS",'TR', 0 , 'C',0 );
    $pdf->Cell(63,$alto,"CONSIGNATARIO",'TR', 0 , 'C',0 );
	$pdf->Cell(25,$alto,"CONTENIDO",'TR', 0 , 'C',0 );
	$pdf->Cell(21,$alto,"IMP. PAGADO",'TR', 0 , 'C',0 );
	$pdf->Cell(21,$alto,"IMP. POR PAGAR",'T', 0 , 'C',0 );
	//$pdf->Cell(15,$alto,"FACTURA",'T', 0 , 'C',0 );
	$pdf->Ln();
	//$pdf->Cell(17,$alto,"FIRMA",'TR', 0 , 'C',0 );
	$totalPagodo=0;
	$totalPorPagar=0;
	$swFactura=false;
	$DataDetalle=Table::getListQuery("Select * from detalleencomienda where IDENCOMIENDA=".$_GET['id']);
	foreach ($DataDetalle as $key => $value) {
		# code...
		if($value['FACTURA']=='NO'){
			$pdf->SetX(18);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(10,$alto,$key+1,'TR', 0 , 'C',0 );
			$pdf->Cell(20,$alto,$value['NROGUIA'],'TR', 0 , 'C',0 );
			$pdf->Cell(63,$alto, utf8_decode( strtoupper($value['REMITENTE'])),'TR', 0 , '',0 );
			$pdf->Cell(20,$alto,$value['NROBULTO1'],'TR', 0 , 'C',0 );
		    $pdf->Cell(63,$alto,utf8_decode( strtoupper($value['CONSIGNATARIO'])),'TR', 0 , '',0 );
			$pdf->Cell(25,$alto,utf8_decode( strtoupper($value['CONTENIDO'])),'TR', 0 , 'C',0 );
			$pdf->Cell(21,$alto,number_format($value['IMPPAGADO'], 2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(21,$alto,number_format($value['IMPPORPAGAR'], 2,',','.'),'T', 0 , 'C',0 );
			//$pdf->Cell(15,$alto,$value['FACTURA'],'TR', 0 , 'C',0 );
			$pdf->Ln();
			$totalPagodo=$totalPagodo+$value['IMPPAGADO'];
			$totalPorPagar=$totalPorPagar+$value['IMPPORPAGAR'];
		}
		else{
			$swFactura=true;
		}
	}

	$pdf->SetX(18);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(10,$alto,'','T', 0 , 'C',0 );
	$pdf->Cell(20,$alto,'','T', 0 , 'C',0 );
	$pdf->Cell(63,$alto,'','T', 0 , 'C',0 );
	$pdf->Cell(20,$alto,'','T', 0 , 'C',0 );
    $pdf->Cell(63,$alto,'','T', 0 , 'C',0 );
	$pdf->Cell(25,$alto,'TOTAL','T', 0 , 'C',0 );
	$pdf->Cell(21,$alto,number_format($totalPagodo, 2,',','.'),'T', 0 , 'C',0 );
	$pdf->Cell(21,$alto,number_format($totalPorPagar, 2,',','.'),'T', 0 , 'C',0 );
	//$pdf->Cell(15,$alto,'','T', 0 , 'C',0 );
	$pdf->Ln();
	///** CODIGO PARA IMPRIMIR LOS REGISTROS QUE TIENE FACTURA***////

	//***TITULO DE LA TABLA MANIFIESTO**/////
   if($swFactura){
	$pdf->Ln();
	$pdf->SetX(18);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(26,$alto,utf8_decode('CON FACTURA: '),'0', 0 , 'L',0 );
	$pdf->Ln();
	$pdf->SetX(18);
	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(10,$alto,"NRO",'TR', 0 , 'C',0 );
	$pdf->Cell(20,$alto,"NRO. GUIA",'TR', 0 , 'C',0 );
	$pdf->Cell(63,$alto,"REMITENTE",'TR', 0 , 'C',0 );
	$pdf->Cell(20,$alto,"NRO. BULTOS",'TR', 0 , 'C',0 );
    $pdf->Cell(63,$alto,"CONSIGNATARIO",'TR', 0 , 'C',0 );
	$pdf->Cell(25,$alto,"CONTENIDO",'TR', 0 , 'C',0 );
	$pdf->Cell(21,$alto,"IMP. PAGADO",'TR', 0 , 'C',0 );
	$pdf->Cell(21,$alto,"IMP. POR PAGAR",'T', 0 , 'C',0 );
	//$pdf->Cell(15,$alto,"FACTURA",'T', 0 , 'C',0 );
	$pdf->Ln();
	//$pdf->Cell(17,$alto,"FIRMA",'TR', 0 , 'C',0 );
	$totalPagodo=0;
	$totalPorPagar=0;

	
	foreach ($DataDetalle as $key => $value) {
		# code...
		if($value['FACTURA']=='SI'){
			$pdf->SetX(18);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(10,$alto,$key+1,'TR', 0 , 'C',0 );
			$pdf->Cell(20,$alto,$value['NROGUIA'],'TR', 0 , 'C',0 );
			$pdf->Cell(63,$alto, utf8_decode( strtoupper($value['REMITENTE'])),'TR', 0 , '',0 );
			$pdf->Cell(20,$alto,$value['NROBULTO1'],'TR', 0 , 'C',0 );
		    $pdf->Cell(63,$alto,utf8_decode( strtoupper($value['CONSIGNATARIO'])),'TR', 0 , '',0 );
			$pdf->Cell(25,$alto,utf8_decode( strtoupper($value['CONTENIDO'])),'TR', 0 , 'C',0 );
			$pdf->Cell(21,$alto,number_format($value['IMPPAGADO'], 2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(21,$alto,number_format($value['IMPPORPAGAR'], 2,',','.'),'T', 0 , 'C',0 );
			//$pdf->Cell(15,$alto,$value['FACTURA'],'TR', 0 , 'C',0 );
			$pdf->Ln();
			$totalPagodo=$totalPagodo+$value['IMPPAGADO'];
			$totalPorPagar=$totalPorPagar+$value['IMPPORPAGAR'];
		}
	}

	$pdf->SetX(18);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(10,$alto,'','T', 0 , 'C',0 );
	$pdf->Cell(20,$alto,'','T', 0 , 'C',0 );
	$pdf->Cell(63,$alto,'','T', 0 , 'C',0 );
	$pdf->Cell(20,$alto,'','T', 0 , 'C',0 );
    $pdf->Cell(63,$alto,'','T', 0 , 'C',0 );
	$pdf->Cell(25,$alto,'TOTAL','T', 0 , 'C',0 );
	$pdf->Cell(21,$alto,number_format($totalPagodo, 2,',','.'),'T', 0 , 'C',0 );
	$pdf->Cell(21,$alto,number_format($totalPorPagar, 2,',','.'),'T', 0 , 'C',0 );
	//$pdf->Cell(15,$alto,'','T', 0 , 'C',0 );
	$pdf->Ln();

	}

	/// firmas de pie de pagina
	/*$pdf->SetFont('Arial','B',9);
	$pdf->SetXY(15,170);
	$pdf->Cell(8,$alto,"Son: ",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,convertir_a_letras($totalAporteOfi),'', 0 , 'L',0 );
	*/
	$pdf->SetXY(15,194);
	$pdf->Cell(50,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"---------------------------------------------------",'', 0 , 'C',0 );
	$pdf->Cell(70,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"--------------------------------------------------",'', 0 , 'C',0 );

	$pdf->SetXY(15,198);
	$pdf->Cell(50,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"ENTREGUE CONFORME",'', 0 , 'C',0 );
	$pdf->Cell(70,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"RECIBI CONFORME",'', 0 , 'C',0 );

	$pdf->OutPut();
	

?>
