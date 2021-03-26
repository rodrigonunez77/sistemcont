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
	
	$fechaInicio=explode('-',$_GET["FECHAINICIO"]);
	$fechaInicio=$fechaInicio[2].'/'.$fechaInicio[1].'/'.$fechaInicio[0];

	$fechaFin=explode('-',$_GET["FECHAFIN"]);
	$fechaFin=$fechaFin[2].'/'.$fechaFin[1].'/'.$fechaFin[0];
	
	$GLOBALS['PIE_USUARIO']=$_SESSION['USUARIO'];
	$GLOBALS['TITULO_GENERAL']="INFORME LIBRO DIARIO - ".$_GET['TIPOCONCEPTO'];
	$GLOBALS['TITULO_REPORTE']=$_GET["FECHAINICIO"];
	$GLOBALS['TITULO_FECHA']="DEL: ".$fechaInicio.' AL: '.$fechaFin;
	$GLOBALS['FILE_LOGO']= $App->getImagen("logo.jpeg");
	

	
	//echo "<BR><h1>---- PAGINA EN CONSTRUCCION ---- </h1></BR>";
	
	// PREPARANDO LA MATRIZ

	
	
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
    $pdf->Cell(56,$alto,"DETALLE",'TR', 0 , 'C',0 );
	$pdf->Cell(17,$alto,"INGRESO",'TR', 0 , 'C',0 );
	$pdf->Cell(17,$alto,"EGRESO",'TR', 0 , 'C',0 );

	$pdf->Ln();
	
	$Data=Table::getListQuery("select * from movimientos where TIPOCONCEPTO='".$_GET['TIPOCONCEPTO']."' and FECHAREGISTRO between '".$_GET['FECHAINICIO']."' and '".$_GET['FECHAFIN']."' and ESTADO='PAGADO' AND ESTADODEPOSITO='CONFIRMADO' ");
       
       $totalIngresos=0;
       $totalEgresos=0;
        foreach ($Data as $key => $value){
        	$alto=3;

        	$cantidadCaracteres= strlen( $value['OBSERVACION']);
            if($cantidadCaracteres>25 && $cantidadCaracteres<=60){
		    	$alto=$alto*2;
		    }

		    elseif($cantidadCaracteres>60 && $cantidadCaracteres<=80){
		    	$alto=$alto*3;

		    }

		    elseif($cantidadCaracteres>80 && $cantidadCaracteres<=110){
		    	$alto=$alto*3;
		    }

		    elseif($cantidadCaracteres>110 && $cantidadCaracteres<=140){
                $alto=$alto*4;
		    }
		    elseif($cantidadCaracteres>140 && $cantidadCaracteres<=170){
				$alto=$alto*5;
		    }
		    elseif($cantidadCaracteres>170 && $cantidadCaracteres<=200){
				$alto=$alto*6;
		    }

		    elseif($cantidadCaracteres>200 && $cantidadCaracteres<=230){
				$alto=$alto*7;
		    }
		    elseif($cantidadCaracteres>230 && $cantidadCaracteres<=260){
				$alto=$alto*8;
		    }

		    elseif($cantidadCaracteres>260 && $cantidadCaracteres<=290){
				$alto=$alto*9;
		    }


            if($value['TIPOREGISTRO']=='I'){
                $nroComprobante=$value['NRORECIBOINGRESO'];
                $montoIngreso=$value['MONTOBS'];
                $montoEgreso=0;
            }
            else{
                $nroComprobante=$value['NRORECIBOEGRESO'];
                $montoEgreso=$value['MONTOBS'];
                $montoIngreso=0;
            }
             $fechaRegistro=explode('-', $value['FECHAREGISTRO']);
             $fechaRegistro=$fechaRegistro[2].'/'.$fechaRegistro[1].'/'.$fechaRegistro[0];


			$pdf->SetX(18);
			$posY=$pdf->GetY();
			$pdf->SetFont('Arial','',6);
            $pdf->Cell(10,$alto,$key+1,'T', 0 , 'C',0 );
			$pdf->Cell(20,$alto,$fechaRegistro,'T', 0 , 'C',0 );
			$pdf->Cell(25,$alto,str_pad($nroComprobante,8,'0',STR_PAD_LEFT),'T', 0 , 'C',0 );
			$pdf->MultiCell(35,3,utf8_decode( strtoupper($value['CONCEPTO'])),'T',  'L',false );
			$pdf->SetXY(108,$posY);	
			$pdf->MultiCell(56,3,utf8_decode( strtoupper($value['OBSERVACION'])),'T', 'L',false );

		    $pdf->SetXY(164,$posY);

			$pdf->Cell(17,$alto,number_format($montoIngreso, 2,',','.'),'T', 0 , 'C',0 );
			$pdf->Cell(17,$alto,number_format($montoEgreso, 2,',','.'),'T', 0 , 'C',0 );
			$pdf->Ln();
			$totalIngresos=$totalIngresos+$montoIngreso;
			$totalEgresos=$totalEgresos+$montoEgreso;

			if($pdf->GetY()>=245 && $pdf->GetY()<=260){	
				//$pdf->SetAutoPageBreak(true , 50);	// margen minimo
				$pdf->AddPage();
				$pdf->SetX(18);
				$pdf->SetFont('Arial','B',6);
				$alto=3;
				
				$pdf->Cell(10,$alto,"NRO",'TR', 0 , 'C',0 );
				$pdf->Cell(20,$alto,"FECHA REGISTRO",'TR', 0 , 'C',0 );
				$pdf->Cell(25,$alto,"NRO. COMPROBANTE",'TR', 0 , 'C',0 );
				$pdf->Cell(35,$alto,"CONCEPTO",'TR', 0 , 'C',0 );
			    $pdf->Cell(56,$alto,"DETALLE",'TR', 0 , 'C',0 );
				$pdf->Cell(17,$alto,"INGRESO",'TR', 0 , 'C',0 );
				$pdf->Cell(17,$alto,"EGRESO",'TR', 0 , 'C',0 );

				$pdf->Ln();
		    }
		}
	
	
	$pdf->SetX(18);
	$pdf->SetFont('Arial','B',6);
	
	
    $pdf->Cell(10,$alto,"",'T', 0 , 'C',0 );     
    $pdf->Cell(30,$alto,"",'T', 0, 'C',0 );     
    $pdf->Cell(25,$alto,"",'T', 0 , 'C',0 );
	$pdf->Cell(45,$alto,"",'T', 0 , 'C',0 );     
	$pdf->Cell(36,$alto,"TOTAL",'T',0 , 'C',0 );     
	$pdf->Cell(17,$alto,number_format($totalIngresos,2,',','.'),'T', 0 , 'C',0 );
	$pdf->Cell(17,$alto,number_format($totalEgresos, 2,',','.'),'T', 0 , 'C',0 );
	
	$pdf->OutPut();
	

?>
