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
	
	$Data=Table::getListQuery("select * from encomienda where FECHAREGISTRO='".$_GET['f']."' AND NROPLACA='".$_GET['n']."' AND IDUSUARIO='".$_GET['id']."'");
	
	$GLOBALS['PIE_USUARIO']=$_SESSION['USUARIO'];
	$GLOBALS['TITULO_GENERAL']="LIQUIDACION DE CARGA";
	$GLOBALS['TITULO_REPORTE']="";
	$GLOBALS['TITULO_FECHA']="";
	$GLOBALS['FILE_LOGO']= $App->getImagen("logo.jpeg");
	$pdf = new docPDF("P","mm","Letter");
	$pdf->AddPage(); 
	//if($Data[0]['IMGDEPOSITO']!=""){
	  // $GLOBALS['FILE_DEPOSITO']= '../../Images/Depositos/'.$Data[0]['IMGDEPOSITO'];		
	//}
	$fechaReg=explode('-', $_GET['f']);
	$fechaReg=$fechaReg[2]."/".$fechaReg[1].'/'.$fechaReg[0];

	/*$alto=6; 
	$pdf->SetFont('Arial','B',12);
	$pdf->SetXY(18,54);
	$pdf->Cell(70,$alto,'BS.: '.number_format(0, 2,',','.'),'0', 0 , 'L',0 );//
	$pdf->Cell(70,$alto,"FECHA: ".$fechaReg,'0', 0 , 'L',0);
	$pdf->Cell(70,$alto,"NRO:".str_pad(55,8,'0',STR_PAD_LEFT),'0', 0 , 'L',0);
	$pdf->Ln();
	*/
	//echo "<BR><h1>---- PAGINA EN CONSTRUCCION ---- </h1></BR>";
	
	// PREPARANDO LA MATRIZ
   $DataPropietario=Table::getListQuery("select * from liquidacion where NROPLACA='".$_GET['n']."' ORDER BY IDLIQUIDACION DESC");
   $nombreSocio="";
   $ciSocio="";
   if (isset($DataPropietario[0]['NROPLACA'])) {
   	# code...
   		$nombreSocio=$DataPropietario[0]['NOMBRE'].' '.$DataPropietario[0]['PATERNO'].' '.$DataPropietario[0]['MATERNO'];
   		$ciSocio=$DataPropietario[0]['CI'];
   }
	
	$alto=6; 


	$pdf->SetXY(18,50);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(60,$alto,'SOCIO PROPIETARIO:...................................................................................... ','0', 0 , 'L',0 );//
	$pdf->SetXY(58,49);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(60,$alto,strtoupper(utf8_decode($nombreSocio)),'0', 0 , 'L',0 );//

	$pdf->SetXY(150,50);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(60,$alto,'LIC:...................................... ','0', 0 , 'L',0 );//
	$pdf->SetXY(160,49);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(60,$alto,strtoupper(utf8_decode($ciSocio)),'0', 0 , 'L',0 );//
/////DATOS CONDUCTOR
	$pdf->SetXY(18,56);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(60,$alto,'CONDUCTOR:..................................................................................................... ','0', 0 , 'L',0 );//
	$pdf->SetXY(45,55);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(60,$alto,strtoupper(utf8_decode($Data[0]['CONDUCTOR'])),'0', 0 , 'L',0 );//

	$pdf->SetXY(150,56);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(60,$alto,'LIC:...................................... ','0', 0 , 'L',0 );//
	$pdf->SetXY(160,55);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(60,$alto,strtoupper(utf8_decode($Data[0]['NROLICENCIA'])),'0', 0 , 'L',0 );//
	/////DATOS FECHA
	$pdf->SetXY(18,61);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(60,$alto,'FECHA:...................................................... ','0', 0 , 'L',0 );//
	$pdf->SetXY(35,60);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(60,$alto,$fechaReg,'0', 0 , 'L',0 );//

	$pdf->SetXY(100,61);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(60,$alto,'DESTINO:...................................... ','0', 0 , 'L',0 );//
	$pdf->SetXY(118,60);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(60,$alto,strtoupper(utf8_decode('GUYARA')),'0', 0 , 'L',0 );//
    
    //PLACA
   
	$pdf->SetXY(18,66);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(60,$alto,'PLACA:...................................................... ','0', 0 , 'L',0 );//
	$pdf->SetXY(35,65);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(60,$alto,$_GET['n'],'0', 0 , 'L',0 );//

    $pdf->Ln();
    $pdf->Ln();

	$alto=4;
	$pdf->SetX(18);
	$pdf->SetFont('Arial','B',6);

	$pdf->Cell(20,$alto,utf8_decode('N° MANIFIESTO'),'LTR', 0 , 'C',0 );
	$pdf->Cell(15,$alto,'C/F o S/F','TR', 0 , 'C',0 );
	$pdf->Cell(45,$alto,'DESTINO','TR', 0 , 'C',0 );
	$pdf->Cell(20,$alto,'MONTO','TR', 0 , 'C',0 );
	$pdf->Cell(20,$alto,'POR PAGAR','TR', 0 , 'C',0 );
	$pdf->Cell(20,$alto,'IVA - IT 16%','TR', 0 , 'C',0 );
	$pdf->Cell(20,$alto,'APORTE OFI. 20%','TR', 0 , 'C',0 );
	$pdf->Cell(20,$alto,'CANCELADO','TR', 0 , 'C',0 );
	$pdf->Ln();
	$totalMonto=0;
	$totalPorPagar=0;
	$totalRetencion=0;
	$totalAportO=0;
	$totalCancelado=0;

	foreach ($Data as $key => $value) {
		# code...
		$DataDetalle=Table::getListQuery("select SUM(IMPPAGADO)AS TOTAL,SUM(IMPPORPAGAR)AS TOTALPORPAGAR  from detalleencomienda where IDENCOMIENDA=".$value['IDENCOMIENDA']." AND FACTURA='NO'");
	    if (isset($DataDetalle[0]['TOTAL'])) {
	    	$iva=0;
	    	$aporteOfi=(($DataDetalle[0]['TOTAL']-$iva)*20)/100;
	    	$cancelado=$DataDetalle[0]['TOTAL']-$iva-$aporteOfi;

	    	$totalMonto=$totalMonto+$DataDetalle[0]['TOTAL'];
			$totalPorPagar=$totalPorPagar+$DataDetalle[0]['TOTALPORPAGAR'];
			$totalRetencion=$totalRetencion+$iva;
			$totalAportO=$totalAportO+$aporteOfi;
			$totalCancelado=$totalCancelado+$cancelado;

	    	$pdf->SetX(18);

			$pdf->SetFont('Arial','',6);
			$pdf->Cell(20,$alto,$value['NROENCOMIENDA'],'LTR', 0 , 'C',0 );
			$pdf->Cell(15,$alto,'S/F','LTR', 0 , 'C',0 );
			$pdf->Cell(45,$alto,$value['LOCALIDAD'],'TR', 0 , 'C',0 );
		    $pdf->Cell(20,$alto,number_format($DataDetalle[0]['TOTAL'], 2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(20,$alto,number_format($DataDetalle[0]['TOTALPORPAGAR'], 2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(20,$alto,number_format($iva, 2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(20,$alto,number_format($aporteOfi, 2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(20,$alto,number_format($cancelado, 2,',','.'),'TR', 0 , 'C',0 );
		    $pdf->Ln();
	    }

	    $DataDetalle=Table::getListQuery("select SUM(IMPPAGADO)AS TOTAL  from detalleencomienda where IDENCOMIENDA=".$value['IDENCOMIENDA']." AND FACTURA='SI'");
	    if (isset($DataDetalle[0]['TOTAL'])) {
	    	$iva=($DataDetalle[0]['TOTAL']*16)/100;
	    	$aporteOfi=(($DataDetalle[0]['TOTAL']-$iva)*20)/100;
	    	$cancelado=$DataDetalle[0]['TOTAL']-$iva-$aporteOfi;

	    	$totalMonto=$totalMonto+$DataDetalle[0]['TOTAL'];
			//$totalPorPagar=$totalPorPagar+$DataDetalle[0]['TOTALPORPAGAR'];
			$totalRetencion=$totalRetencion+$iva;
			$totalAportO=$totalAportO+$aporteOfi;
			$totalCancelado=$totalCancelado+$cancelado;

	    	$pdf->SetX(18);

			$pdf->SetFont('Arial','',6);
			$pdf->Cell(20,$alto,$value['NROENCOMIENDA'],'LTR', 0 , 'C',0 );
			$pdf->Cell(15,$alto,'C/F','LTR', 0 , 'C',0 );
			$pdf->Cell(45,$alto,$value['LOCALIDAD'],'TR', 0 , 'C',0 );
		    $pdf->Cell(20,$alto,number_format($DataDetalle[0]['TOTAL'], 2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(20,$alto,number_format(0, 2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(20,$alto,number_format($iva, 2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(20,$alto,number_format($aporteOfi, 2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(20,$alto,number_format($cancelado, 2,',','.'),'TR', 0 , 'C',0 );
		    $pdf->Ln();
	    }
	}
	$pdf->SetX(18);
	
	$pdf->Cell(20,$alto,'','T', 0 , 'C',0 );
	$pdf->Cell(15,$alto,'','T', 0 , 'C',0 );
	$pdf->Cell(45,$alto,'TOTALES:','T', 0 , 'C',0 );
	$pdf->Cell(20,$alto,number_format($totalMonto, 2,',','.'),'T', 0 , 'C',0 );
	$pdf->Cell(20,$alto,number_format($totalPorPagar, 2,',','.'),'T', 0 , 'C',0 );
	$pdf->Cell(20,$alto,number_format($totalRetencion, 2,',','.'),'T', 0 , 'C',0 );
	$pdf->Cell(20,$alto,number_format($totalAportO, 2,',','.'),'T', 0 , 'C',0 );
	$pdf->Cell(20,$alto,number_format($totalCancelado, 2,',','.'),'T', 0 , 'C',0 );
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();


	$pdf->SetX(18);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(90,$alto,'OBSERVACIONES:.....................................................................................................................................................................................................','', 0 , '',0 );
	$DataAnticipo=Table::getListQuery("select * from descuentoencomienda where NROPLACA='".$Data[0]['NROPLACA']."'  and FECHAREGISTRO='".$Data[0]['FECHAREGISTRO']."'");
	$anticipo=0;
    if (isset($DataAnticipo[0]['ANTICIPO'])) {
        # code...
        $anticipo=$DataAnticipo[0]['ANTICIPO'];
    }

	$liquidoPagable=$totalCancelado-$anticipo;
	$pdf->Ln();

	

	$pdf->SetX(18);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(20,$alto,'ANTICIPO :','', 0 , '',0 );
	$pdf->Cell(20,$alto,number_format($anticipo, 2,',','.'),'', 0 , '',0 );
	$pdf->Ln();
	$pdf->SetX(18);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(30,$alto,'LIQUIDO PAGABLE :','', 0 , '',0 );
	$pdf->Cell(20,$alto,number_format($liquidoPagable, 2,',','.'),'', 0 , '',0 );
	$pdf->Ln();
    $pdf->SetX(18);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,$alto,'SON:','', 0 , '',0 );
	
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(10,$alto,convertir_a_letras($liquidoPagable),'', 0 , '',0 );


	$pdf->OutPut();
	

?>
