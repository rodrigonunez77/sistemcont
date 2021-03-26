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
	
	


	

	
	//echo "<BR><h1>---- PAGINA EN CONSTRUCCION ---- </h1></BR>";
	
	// PREPARANDO LA MATRIZ

	
	
	$pdf = new docPDF("L","mm","Letter");
	$pdf->AddPage(); 
	$alto=6; 

	$Data=Table::getListQuery("select * from encomienda where IDENCOMIENDA=".$_GET['id']);

	$fechaInicio=explode('-',$Data[0]['FECHAREGISTRO']);
	$fechaInicio=$fechaInicio[2].'/'.$fechaInicio[1].'/'.$fechaInicio[0];

	$GLOBALS['PIE_USUARIO']=$_SESSION['USUARIO'];
	//$GLOBALS['TITULO_GENERAL']="jljljl";
	$GLOBALS['TITULO_REPORTE']=$fechaInicio;
	//$GLOBALS['TITULO_FECHA']="ljl";
	$GLOBALS['FILE_LOGO']= $App->getImagen("logo.jpeg");

    
       

   
	$alto=3; 
    $pdf->SetX(18);
	$pdf->Image($App->getImagen("logo.jpeg"),15,8,245,35);

    $pdf->SetFont('Arial','B',12);
	$pdf->SetX(18);
	$pdf->Cell(250,$alto,"INFORME DIARIO: ".str_pad($Data[0]['NROENCOMIENDA'],5,'0',STR_PAD_LEFT),'0', 0 , 'C',0 );
	$pdf->Ln(10);

    $pdf->SetFont('Arial','B',8);
	$pdf->SetX(18);
	$pdf->Cell(180,$alto,"LA PAZ, ".$fechaInicio,'0', 0 , 'L',0 );
	
	$pdf->Ln();
	$pdf->Ln();
	$posY=$pdf->GetY();
	$pdf->SetFont('Arial','B',8);
    $pdf->SetX(15);

	$pdf->MultiCell(55,$alto,"Propietario",'T',  'L',false );
	$pdf->SetXY(70,$posY);
	$pdf->MultiCell(45,$alto,"Localidad",'T',  'L',false );
	$pdf->SetXY(113,$posY);
    $pdf->MultiCell(16,$alto,"Nro Pasajero",'T', 'C',false );
    $pdf->SetXY(129,$posY);
    $pdf->MultiCell(16,$alto,"Valor Pasaje",'T', 'C',false );
    $pdf->SetXY(146,$posY);
    $pdf->MultiCell(16,$alto,"Importe",'T', 'C',false );
    $pdf->SetXY(162,$posY);
    $pdf->MultiCell(16,$alto,"Total Pagado",'T', 'C',false );
   // $pdf->SetXY(147,$posY);
    $posX_=162;
    $DetalleDesTitulo=Table::getListQuery("");

   /* foreach ($DetalleDesTitulo as $keyTitulo => $valueTitulo) {
    	# code...
    	if($keyTitulo>=2 &&  $keyTitulo<=5){
    		$posX_=$posX_+16;
    		$pdf->SetXY($posX_,$posY);
    		$cadDescripcion=strtolower($valueTitulo['DESCRIPCION']);
	    	$pdf->MultiCell(16,$alto,ucwords($cadDescripcion),'T', 'C',false );
	        
        }
    }*/
   
    $pdf->Ln();
/*
			
			$pdf->Cell(45,$alto,$valueDestino['LOCALIDAD'],'T',  'L',false );
		    $pdf->Cell(16,$alto,number_format($valueDestino['NROPASAJERO'],2,',','.'),'T', 0 , 'C',0 );
		    $pdf->Cell(16,$alto,number_format($valueDestino['COSTOPASAJE'],2,',','.'),'T', 0 , 'C',0 );
		    $pdf->Cell(16,$alto,number_format($valueDestino['IMPORTE'],2,',','.'),'T', 0 , 'C',0 );
		    $pdf->Cell(16,$alto,'-','T', 0 , 'C',0 );
		    $pdf->Cell(16,$alto,"-",'T', 0 , 'C',0 );
		    $pdf->Cell(16,$alto,"-",'T', 0 , 'C',0 );
		    $pdf->Cell(16,$alto,"-",'T', 0 , 'C',0 );
		    $pdf->Cell(16,$alto,"-",'T', 0 , 'C',0 );
		    $pdf->Cell(16,$alto,"-",'T', 0 , 'C',0 );
		    //$pdf->Cell(16,$alto,"-",'T', 0 , 'C',0 );
		    $pdf->Ln();*/
		   
    
  	
  	$pdf->SetFont('Arial','B',9);
	$pdf->SetXY(15,170);
	$pdf->Cell(8,$alto,"Son: ",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,convertir_a_letras($totalAporteOfi),'', 0 , 'L',0 );

	$pdf->SetXY(15,186);
	$pdf->Cell(50,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"---------------------------------------------------",'', 0 , 'C',0 );
	$pdf->Cell(70,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"--------------------------------------------------",'', 0 , 'C',0 );

	$pdf->SetXY(15,190);
	$pdf->Cell(50,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"ENTREGUE CONFORME",'', 0 , 'C',0 );
	$pdf->Cell(70,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"STRIO. HACIENDA",'', 0 , 'C',0 );
///// DESCARGO IVA IT


	
    $pdf->OutPut();

?>
