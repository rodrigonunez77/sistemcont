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
	
	require_once $App->getPathComponents("ReportPdf/class.docPDFVerticalLibDiario.inc.php");
	///class PDF_MC_Table extends FPDF
	//include($App->getPathComponents("ReportPdf/mc_table.php"));
	
	$fechaInicio=explode('-',$_GET["FECHAINICIO"]);
	$fechaInicio=$fechaInicio[2].'/'.$fechaInicio[1].'/'.$fechaInicio[0];

	$fechaFin=explode('-',$_GET["FECHAFIN"]);
	$fechaFin=$fechaFin[2].'/'.$fechaFin[1].'/'.$fechaFin[0];
	
	$GLOBALS['PIE_USUARIO']=$_SESSION['USUARIO'];
	$GLOBALS['TITULO_GENERAL']="INFORME DE: ".$_GET['TIPOREPORTE'].' - '.$_GET['TIPOCONCEPTO'];
	$GLOBALS['TITULO_REPORTE']=$_GET["FECHAINICIO"];
	$GLOBALS['TITULO_FECHA']="DEL: ".$fechaInicio.' AL: '.$fechaFin;
	$GLOBALS['FILE_LOGO']= $App->getImagen("logo.jpeg");
	

	
	//echo "<BR><h1>---- PAGINA EN CONSTRUCCION ---- </h1></BR>";
	
	// PREPARANDO LA MATRIZ

	if($_GET['TIPOREPORTE']=='EGRESOS'){
        $etiqueta ='EGRESO';
        $tipoRegisto='S';
        $condicion=" and ESTADO='PAGADO' ";
    }
    else if($_GET['TIPOREPORTE']=='CUENTAS POR COBRAR'){
        $etiqueta = 'INGRESO'; 
        $tipoRegisto='I';
        $condicion=" and ESTADO='POR COBRAR' ";
    }
    else{
        $etiqueta ='INGRESO'; 
        $tipoRegisto='I';
        $condicion=" and ESTADO='PAGADO' ";
    }

	
	$pdf = new docPDF("P","mm","Letter");
	$pdf->AddPage(); 
	$alto=3; 
	$pdf->SetFont('Arial','B',6);
	$pdf->SetXY(18,48);
	$pdf->Cell(80,$alto,"",'0', 0 , 'L',0 );//$_SESSION["UBICACION"]
	$pdf->Cell(80,$alto, "",'0', 0 , 'C',0);	
	$pdf->Cell(80,$alto,"",'0', 0 , 'L',0);
	$pdf->Ln();
	$pdf->SetX(18);
	$pdf->Cell(60,$alto,$rol,'0', 0 , 'L',0 );//$_SESSION["NOMBRE_COMPLETO"]
	$pdf->Ln();
	
	$pdf->SetX(18);
	$pdf->SetFont('Arial','B',6);
	
	
	$pdf->Cell(10,$alto,"NRO",'TR', 0 , 'C',0 );
	$pdf->Cell(20,$alto,"FECHA REGISTRO",'TR', 0 , 'C',0 );
	$pdf->Cell(25,$alto,"NRO. COMPROBANTE",'TR', 0 , 'C',0 );
	$pdf->Cell(35,$alto,"CONCEPTO",'TR', 0 , 'C',0 );
    $pdf->Cell(66,$alto,"DETALLE",'TR', 0 , 'C',0 );
	$pdf->Cell(17,$alto,$etiqueta,'TR', 0 , 'C',0 );

	$pdf->Ln();
	

	$Data=Table::getListQuery("select * from movimientos where TIPOREGISTRO='".$tipoRegisto."' AND TIPOCONCEPTO='".$_GET['TIPOCONCEPTO']."' and FECHAREGISTRO between '".$_GET['FECHAINICIO']."' and '".$_GET['FECHAFIN']."' ".$condicion." AND ESTADODEPOSITO='CONFIRMADO'");
       
       $totalMonto=0;

        foreach ($Data as $key => $value){

        	$alto=3;
        	/*$cantidadCaracteres= strlen( $value['OBSERVACION']);
            if($cantidadCaracteres>40 && $cantidadCaracteres<=70){
		    	$alto=$alto*2;
		    }

		    if($cantidadCaracteres>70 && $cantidadCaracteres<=90){
		    	$alto=$alto*3;

		    }

		    if($cantidadCaracteres>90 && $cantidadCaracteres<=118){
		    	$alto=$alto*3;
		    }

		    if($cantidadCaracteres>120 && $cantidadCaracteres<=150){
                $alto=$alto*4;
		    }
		    if($cantidadCaracteres>150 && $cantidadCaracteres<=180){
				$alto=$alto*4;
		    }
			*/
            if($tipoRegisto=='S'){
                $nroComprobante=$value['NRORECIBOEGRESO'];
                $montoIngreso=0;
            }
            else{
               
                $nroComprobante=$value['NRORECIBOINGRESO'];

                $montoEgreso=0;
            }          

             $fechaRegistro=explode('-', $value['FECHAREGISTRO']);
             $fechaRegistro=$fechaRegistro[2].'/'.$fechaRegistro[1].'/'.$fechaRegistro[0];
           
            

			$pdf->SetX(73);
            $posY=$pdf->GetY();
			$pdf->SetFont('Arial','',6);
           
			
			//$pdf->Cell(35,$alto,$value['CONCEPTO'],'TR', 0 , 'C',0 );//corregir multicell
		
			$pdf->MultiCell(35,3,utf8_decode($value['CONCEPTO']),'T', 'L',false );
			$pdf->SetXY(108,$posY);
			$pdf->MultiCell(66,3,utf8_decode( strtoupper($value['OBSERVACION'])),'T', 'L',false );
			
			$posYAux=$pdf->GetY();
			
			$altoCelda=$posYAux-$posY;

			$pdf->SetXY(174,$posY);
			$pdf->Cell(17,$alto,number_format($value['MONTOBS'], 2,',','.'),'T', 0 , 'C',0 );
			//$pdf->Cell(17,$alto,(),'T', 0 , 'C',0 );
			//$pdf->MultiCell(17,$alto,number_format($value['MONTOBS'], 2,',','.'),'T', 'L',false );

			///inpresion de filas restante
			$pdf->SetX(18);
			$pdf->Cell(10,$altoCelda,$key+1,'T', 0 , 'C',0 );
			$pdf->Cell(20,$altoCelda,$fechaRegistro,'T', 0 , 'C',0 );
			$pdf->Cell(25,$altoCelda,str_pad($nroComprobante,8,'0',STR_PAD_LEFT),'T', 0 , 'C',0 );
			///fin de impresion de filas restantes

			$pdf->Ln();

			$totalMonto=$totalMonto+$value['MONTOBS'];

			if($pdf->GetY()>=250 && $pdf->GetY()<=260){	
				//$pdf->SetAutoPageBreak(true , 50);	// margen minimo
				$pdf->AddPage();
				$pdf->SetX(18);
				$pdf->SetFont('Arial','B',6);
				$alto=3;
				
				$pdf->Cell(10,$alto,"NRO",'TR', 0 , 'C',0 );
				$pdf->Cell(20,$alto,"FECHA REGISTRO",'TR', 0 , 'C',0 );
				$pdf->Cell(25,$alto,"NRO. COMPROBANTE",'TR', 0 , 'C',0 );
				$pdf->Cell(35,$alto,"CONCEPTO",'TR', 0 , 'C',0 );
			    $pdf->Cell(66,$alto,"DETALLE",'TR', 0 , 'C',0 );
				$pdf->Cell(17,$alto,$etiqueta,'TR', 0 , 'C',0 );

				$pdf->Ln();
		    }

		}
	
	
	$pdf->SetX(18);
	$pdf->SetFont('Arial','B',6);
	
	
    $pdf->Cell(10,$alto,"",'T', 0 , 'C',0 );     
    $pdf->Cell(30,$alto,"",'T', 0, 'C',0 );     
    $pdf->Cell(25,$alto,"",'T', 0 , 'C',0 );
	$pdf->Cell(55,$alto,"",'T', 0 , 'C',0 );    
	$pdf->Cell(36,$alto,"TOTAL",'T',0 , 'C',0 );    
	$pdf->Cell(17,$alto,number_format($totalMonto,2,',','.'),'T', 0 , 'C',0 );

	
	$pdf->OutPut();
	

?>
