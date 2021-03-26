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
	require_once $App->getPathComponents("ReportPdf/class.docPDFHorizontalLikidacion.inc.php");
	


	switch ($_GET['TIPOREPORTE']) {
		case 'PRO':
			$tipoReport="POR PROPIETARIO";
			break;
		case 'UOP':
			$tipoReport=" POR USUARIO OPERADOR";
			break;
		case 'CHO':
			$tipoReport="POR CHOFER";
			break;
		case 'NPLA':
			# code...
			$tipoReport="POR NRO. PLACA";
			break;
		
		default:
			$tipoReport="POR FECHAS";
			break;
	}

	 if($_GET['TIPOREPORTE']=='PRO'){
        $descrip = 'NOMBRE PROPIETARIO';
      
        $sql="select `liquidacion`.`IDLIQUIDACION`, `liquidacion`.`FECHAREGISTRO`,
        `liquidacion`.`IDUSUARIO`,
        `liquidacion`.`CI`,
        `liquidacion`.`LUGARVIAJE`,
         CONCAT(`liquidacion`.`NOMBRE`,' ',`liquidacion`.`PATERNO`,' ',`liquidacion`.`MATERNO`)as NOMBRECOMPLETO,
         `liquidacion`.`NROINFORME`,`liquidacion`.`TOTALRECAUDADO`,`liquidacion`.`DESCUENTO`,`liquidacion`.`LIQUIDOPAGABLE`
         from `liquidacion`
         where 
         `liquidacion`.`CI`='".$_GET['CI']."' and
         `liquidacion`.`FECHAREGISTRO` between '".$_GET['FECHAINICIO']."' and '".$_GET['FECHAFIN']."' ORDER BY liquidacion.NROINFORME ASC";
    }
    else if($_GET['TIPOREPORTE']=='CHO'){
        $descrip= 'NOMBRE CHOFER'; 
        
        $sql="select `liquidacion`.`IDLIQUIDACION`, `liquidacion`.`FECHAREGISTRO`,
        `liquidacion`.`CICHOFER`,
        `liquidacion`.`IDUSUARIO`,
        `liquidacion`.`LUGARVIAJE`,
         CONCAT(`liquidacion`.`NOMBRECHOFER`,' ',`liquidacion`.`PATERNOCHOFER`,' ',`liquidacion`.`MATERNOCHOFER`)as NOMBRECOMPLETO,
         `liquidacion`.`NROINFORME`,`liquidacion`.`TOTALRECAUDADO`,`liquidacion`.`DESCUENTO`,`liquidacion`.`LIQUIDOPAGABLE`
         from `liquidacion`
         where 
         `liquidacion`.`CICHOFER`='".$_GET['CI']."' and
         `liquidacion`.`FECHAREGISTRO` between '".$_GET['FECHAINICIO']."' and '".$_GET['FECHAFIN']."' ORDER BY liquidacion.NROINFORME ASC";
    }
    else if($_GET['TIPOREPORTE']=='UOP'){
        $descrip= 'USUARIO OPERADOR'; 
        
        $sql="select `liquidacion`.`IDLIQUIDACION`,`liquidacion`.`FECHAREGISTRO`,
        `usuarios`.`IDUSUARIO`,
        `liquidacion`.`LUGARVIAJE`,
        `usuarios`.`LOGIN` AS NOMBRECOMPLETO,
          `liquidacion`.`NROINFORME`,`liquidacion`.`TOTALRECAUDADO`,`liquidacion`.`DESCUENTO`,`liquidacion`.`LIQUIDOPAGABLE`
         from `liquidacion` ,`usuarios` where
         `usuarios`.`IDUSUARIO`=`liquidacion`.`IDUSUARIO` AND
         `liquidacion`.`IDUSUARIO`='".$_GET['CI']."' and
         `liquidacion`.`FECHAREGISTRO` between '".$_GET['FECHAINICIO']."' and '".$_GET['FECHAFIN']."' ORDER BY liquidacion.NROINFORME ASC";
    }
    else if($_GET['TIPOREPORTE']=='NPLA'){
        $descrip= 'NRO PLACA'; 
        
       $sql="select `liquidacion`.`IDLIQUIDACION`,`liquidacion`.`FECHAREGISTRO`,
        `usuarios`.`IDUSUARIO`,
        `liquidacion`.`LUGARVIAJE`,`liquidacion`.`NROPLACA` AS NOMBRECOMPLETO,
        `usuarios`.`LOGIN` AS NOMBRECOMPLETO_,
          `liquidacion`.`NROINFORME`,`liquidacion`.`TOTALRECAUDADO`,`liquidacion`.`DESCUENTO`,`liquidacion`.`LIQUIDOPAGABLE`
         from `liquidacion` ,`usuarios` where
         `usuarios`.`IDUSUARIO`=`liquidacion`.`IDUSUARIO` AND
         `liquidacion`.`NROPLACA`='".$_GET['CI']."' and
         `liquidacion`.`FECHAREGISTRO` between '".$_GET['FECHAINICIO']."' and '".$_GET['FECHAFIN']."' ORDER BY liquidacion.NROINFORME ASC";
    }

    else{
        //echo '?'; 
       
        $sql="select * from liquidacion where `liquidacion`.`FECHAREGISTRO` between '".$_GET['FECHAINICIO']."' and '".$_GET['FECHAFIN']."' ORDER BY liquidacion.NROINFORME ASC ";
    }

    $fechaInicio=explode('-',$_GET["FECHAINICIO"]);
	$fechaInicio=$fechaInicio[2].'/'.$fechaInicio[1].'/'.$fechaInicio[0];

	$fechaFin=explode('-',$_GET["FECHAFIN"]);
	$fechaFin=$fechaFin[2].'/'.$fechaFin[1].'/'.$fechaFin[0];


	$GLOBALS['PIE_USUARIO']=$_SESSION['USUARIO'];
	$GLOBALS['TITULO_GENERAL']="TIPO DE REPORTE: ".$tipoReport;
	$GLOBALS['TITULO_REPORTE']="DEL ".$fechaInicio.' AL '.$fechaFin;
	$GLOBALS['TITULO_FECHA']="";
	$GLOBALS['FILE_LOGO']= $App->getImagen("logo.jpeg");


	
	
	$pdf = new docPDF("L","mm","Letter");
	$pdf->AddPage(); 
	$alto=3; 

	$pdf->SetX(18);
	$pdf->SetFont('Arial','B',6);
    
    if($_GET['TIPOREPORTE']=='-'){ 
        $posY=$pdf->GetY();

		$pdf->MultiCell(10,6,"NRO.",'TR' , 'C',false );
		$pdf->SetXY(28,$posY);
		$pdf->MultiCell(15,$alto,"FECHA DE REGISTRO",'TR' , 'C',false );
		$pdf->SetXY(43,$posY);
		$pdf->MultiCell(15,$alto,"NRO. INFORME",'TR',  'C',false );
		$pdf->SetXY(58,$posY);
		$pdf->MultiCell(50,6,"PROPIETARIO",'TR', 'C',false );
		$pdf->SetXY(108,$posY);
		$pdf->MultiCell(40,6,"CHOFER",'TR',  'C',false);
		$pdf->SetXY(148,$posY);
		$pdf->MultiCell(15,$alto,"USUARIO OPERADOR",'TR',  'C',false );
		$pdf->SetXY(163,$posY);
		$pdf->MultiCell(15,$alto,"NRO. PLACA",'TR',  'C',false );
		$pdf->SetXY(178,$posY);
		$pdf->MultiCell(25,6,"DESTINO",'TR',  'C',false );
		$pdf->SetXY(203,$posY);
		$pdf->MultiCell(15,$alto,"TOTAL APOR. OFI.",'TR',  'C',false );
		$pdf->SetXY(218,$posY);
		$pdf->MultiCell(20,$alto,"TOTAL APORTE AREA TRABAJO",'TR', 'C',false );
		$pdf->SetXY(238,$posY);
		$pdf->MultiCell(15,$alto,"TOTAL RETENCION",'TR',  'C',false );
		$pdf->SetXY(253,$posY);
		$pdf->MultiCell(16,$alto,"TOTAL RECAUDADO",'T',  'C',false );

    }
    else{

    	$pdf->Cell(10,$alto,"NRO.",'TR', 0 , 'C',0 );
		$pdf->Cell(20,$alto,"FECHA DE REG.",'TR', 0 , 'C',0 );
		$pdf->Cell(20,$alto,"NRO. INFORME",'TR', 0 , 'C',0 );
		$pdf->Cell(50,$alto,$descrip,'TR', 0 , 'C',0 );
		$pdf->Cell(40,$alto,"DESTINO",'TR', 0 , 'C',0 );
		$pdf->Cell(25,$alto,"TOTAL APOR. OFI.",'TR', 0 , 'C',0 );
		$pdf->Cell(30,$alto,"TOTAL APOR. AREA TRAB.",'TR', 0 , 'C',0 );
		$pdf->Cell(25,$alto,"TOTAL RETENCION",'TR', 0 , 'C',0 );
		$pdf->Cell(25,$alto,"TOTAL RECAUDADO",'T', 0 , 'C',0 );
		$pdf->Ln();
    }
	
    //////////////////////////////////


    $Data=Table::getListQuery($sql);
    $totalAportOfi=0;
    $totalAportAre=0;
    $totalRetencion=0;
    $totalRecaudado=0;
    foreach ($Data as $key => $value){

         $DataRetencion=Table::getListQuery("select SUM(detalledescuento.DESCUENTO)AS DESCUENTO from liquidacion,detalledescuento where detalledescuento.IDLIQUIDACION=liquidacion.IDLIQUIDACION and  liquidacion.FECHAREGISTRO='".$value['FECHAREGISTRO']."' and liquidacion.IDUSUARIO=".$value['IDUSUARIO']." AND liquidacion.IDLIQUIDACION=".$value['IDLIQUIDACION']."  and (detalledescuento.DESCRIPCION='IVA 13%' OR detalledescuento.DESCRIPCION='IT 3%')");
            $DataAreaTrabajo=Table::getListQuery("select SUM(detalledescuento.DESCUENTO)AS DESCUENTO from liquidacion,detalledescuento where detalledescuento.IDLIQUIDACION=liquidacion.IDLIQUIDACION and  liquidacion.FECHAREGISTRO='".$value['FECHAREGISTRO']."' and liquidacion.IDUSUARIO=".$value['IDUSUARIO']." AND liquidacion.IDLIQUIDACION=".$value['IDLIQUIDACION']."  and detalledescuento.DESCRIPCION='APORTE PARA TRABAJO' ");


            $DataAporteOfi=Table::getListQuery("select SUM(detalledescuento.DESCUENTO)AS DESCUENTO from liquidacion,detalledescuento where detalledescuento.IDLIQUIDACION=liquidacion.IDLIQUIDACION  and liquidacion.FECHAREGISTRO='".$value['FECHAREGISTRO']."' and liquidacion.IDUSUARIO=".$value['IDUSUARIO']." AND liquidacion.IDLIQUIDACION=".$value['IDLIQUIDACION']."  and detalledescuento.IDCATEGORIA=2");
  
        if($_GET['TIPOREPORTE']=='-'){ 

             $DataUsuarioOp=Table::getListQuery("select LOGIN FROM usuarios where IDUSUARIO=".$value['IDUSUARIO']);
             if (isset($DataUsuarioOp[0]['LOGIN'])) {
                $usuarioOp=$DataUsuarioOp[0]['LOGIN'];
             }
             else{
                $usuarioOp="";
             }
           

            $pdf->SetFont('Arial','',6);
			$pdf->SetX(18);

        	$pdf->Cell(10,$alto,$key+1,'TR', 0 , 'C',0 );
			$pdf->Cell(15,$alto,$value['FECHAREGISTRO'],'TR', 0 , 'C',0 );
			$pdf->Cell(15,$alto,str_pad($value['NROINFORME'],8,'0',STR_PAD_LEFT),'TR', 0 , 'C',0 );
			$pdf->Cell(50,$alto,utf8_decode($value['NOMBRE'].' '.$value['PATERNO'].' '.$value['MATERNO']),'TR', 0 , 'C',0 );
			$pdf->Cell(40,$alto,utf8_decode($value['NOMBRECHOFER'].' '.$value['PATERNOCHOFER'].' '.$value['MATERNOCHOFER']),'TR', 0 , 'C',0 );
			$pdf->Cell(15,$alto,utf8_decode($usuarioOp),'TR', 0 , 'C',0 );
			$pdf->Cell(15,$alto,utf8_decode($value['NROPLACA']),'TR', 0 , 'C',0 );
			$pdf->Cell(25,$alto,strtoupper($value['LUGARVIAJE']),'TR', 0 , 'C',0 );
			$pdf->Cell(15,$alto,number_format($DataAporteOfi[0]['DESCUENTO'],2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(20,$alto,number_format($DataAreaTrabajo[0]['DESCUENTO'],2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(15,$alto,number_format($DataRetencion[0]['DESCUENTO'],2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(16,$alto,number_format($value['TOTALRECAUDADO'],2,',','.'),'T', 0 , 'C',0 );
        	$pdf->Ln();

        }
        else{
			$pdf->SetFont('Arial','',6);
			$pdf->SetX(18);

        	$pdf->Cell(10,$alto,$key+1,'TR', 0 , 'C',0 );
			$pdf->Cell(20,$alto,$value['FECHAREGISTRO'],'TR', 0 , 'C',0 );
			$pdf->Cell(20,$alto,str_pad($value['NROINFORME'],8,'0',STR_PAD_LEFT),'TR', 0 , 'C',0 );
			$pdf->Cell(50,$alto,utf8_decode($value['NOMBRECOMPLETO']),'TR', 0 , 'C',0 );
			$pdf->Cell(40,$alto,strtoupper($value['LUGARVIAJE']),'TR', 0 , 'C',0 );
			$pdf->Cell(25,$alto,number_format($DataAporteOfi[0]['DESCUENTO'],2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(30,$alto,number_format($DataAreaTrabajo[0]['DESCUENTO'],2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(25,$alto,number_format($DataRetencion[0]['DESCUENTO'],2,',','.'),'TR', 0 , 'C',0 );
			$pdf->Cell(25,$alto,number_format($value['TOTALRECAUDADO'],2,',','.'),'T', 0 , 'C',0 );
        	$pdf->Ln();
        }
        $totalAportOfi=$totalAportOfi+$DataAporteOfi[0]['DESCUENTO'];
	    $totalAportAre=$totalAportAre+$DataAreaTrabajo[0]['DESCUENTO'];
	    $totalRetencion=$totalRetencion+$DataRetencion[0]['DESCUENTO'];
	    $totalRecaudado=$totalRetencion+$value['TOTALRECAUDADO'];

    }

    if($_GET['TIPOREPORTE']=='-'){ 
    	   $pdf->SetFont('Arial','B',6);
			$pdf->SetX(18);

        	$pdf->Cell(160,$alto,"",'T', 0 , 'C',0 );

			$pdf->Cell(25,$alto,"TOTALES",'T', 0 , 'C',0 );
			$pdf->Cell(15,$alto,number_format($totalAportOfi,2,',','.'),'T', 0 , 'C',0 );
			$pdf->Cell(20,$alto,number_format($totalAportAre,2,',','.'),'T', 0 , 'C',0 );
			$pdf->Cell(15,$alto,number_format($totalRetencion,2,',','.'),'T', 0 , 'C',0 );
			$pdf->Cell(16,$alto,number_format($totalRecaudado,2,',','.'),'T', 0 , 'C',0 );

    }else{
    	$pdf->SetFont('Arial','B',6);
			$pdf->SetX(18);

        	$pdf->Cell(10,$alto,"",'T', 0 , 'C',0 );
			$pdf->Cell(20,$alto,"",'T', 0 , 'C',0 );
			$pdf->Cell(20,$alto,"",'T', 0 , 'C',0 );
			$pdf->Cell(50,$alto,"",'T', 0 , 'C',0 );
			$pdf->Cell(40,$alto,"TOTALES",'T', 0 , 'C',0 );
			$pdf->Cell(25,$alto,number_format($totalAportOfi,2,',','.'),'T', 0 , 'C',0 );
			$pdf->Cell(30,$alto,number_format($totalAportAre,2,',','.'),'T', 0 , 'C',0 );
			$pdf->Cell(25,$alto,number_format($totalRetencion,2,',','.'),'T', 0 , 'C',0 );
			$pdf->Cell(25,$alto,number_format($totalRecaudado,2,',','.'),'T', 0 , 'C',0 );
    }
       
    $pdf->OutPut();
    

?>
