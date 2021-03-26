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
	
	$fechaInicio=explode('-',$_GET["f"]);
	$fechaInicio=$fechaInicio[2].'/'.$fechaInicio[1].'/'.$fechaInicio[0];

	
	$GLOBALS['PIE_USUARIO']=$_SESSION['USUARIO'];
	$GLOBALS['TITULO_GENERAL']="";
	$GLOBALS['TITULO_REPORTE']=$_GET["f"];
	$GLOBALS['TITULO_FECHA']="";
	$GLOBALS['FILE_LOGO']= $App->getImagen("logo.jpeg");
	

	
	//echo "<BR><h1>---- PAGINA EN CONSTRUCCION ---- </h1></BR>";
	
	// PREPARANDO LA MATRIZ

	
	
	$pdf = new docPDF("P","mm","Letter");
	$pdf->AddPage(); 
	$alto=6; 


    $Data=Table::getListQuery("select * from liquidacion where FECHAREGISTRO='".$_GET['f']."' AND IDUSUARIO=".$_GET['id']);
       
       $totalMonto=0;

    foreach ($Data as $key => $value){
    		/* titulo de ñiquidacion**/
		$pdf->SetFont('Arial','B',10);
		$pdf->SetX(18);
		$pdf->Cell(180,$alto,"LIQUIDACION : ".str_pad($value['NROINFORME'],5,'0',STR_PAD_LEFT),'0', 0 , 'C',0 );
		$pdf->Ln(10);


		$pdf->SetFont('Arial','B',11);
		$pdf->SetX(18);
		$pdf->Cell(30,$alto,"Propietario Sr.: .........................................................",'0', 0 , 'L',0 );
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(80,$alto-1,utf8_decode($value['NOMBRE'].' '.$value['PATERNO'].' '.$value['MATERNO']) ,'0', 0 , 'L',0 );
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(25,$alto,"Bus Placa: ........................................ ",'0', 0 , 'L',0 );
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(30,$alto-1,utf8_decode($value['NROPLACA']),'0', 0 , 'L',0 );
		$pdf->Ln();
		$pdf->SetX(18);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(30,$alto,"Lugar Viaje: ........................................",'0', 0 , 'L',0 );
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(80,$alto-1,utf8_decode(strtoupper($value['LUGARVIAJE'])) ,'0', 0 , 'L',0 );
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(15,$alto,"Fecha: ...............................................",'0', 0 , 'L',0 );
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(30,$alto-1,$fechaInicio,'0', 0 , 'L',0 );
		$pdf->Ln();


		
		$pdf->SetXY(18,70);
		
		$alto=4;
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(30,$alto,"DETALLE DESTINO",'0', 0 , 'L',0 );
		$pdf->Ln();
        $pdf->SetX(18);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(10,$alto,"NRO",'TR', 0 , 'C',0 );
		$pdf->Cell(75,$alto,"LOCALIDAD",'TR', 0 , 'C',0 );
		$pdf->Cell(30,$alto,"NRO. PASAJEROS",'TR', 0 , 'C',0 );
		$pdf->Cell(30,$alto,"COSTO PASAJE",'TR', 0 , 'C',0 );
	    $pdf->Cell(30,$alto,"IMPORTE",'T', 0 , 'C',0 );

		$pdf->Ln();
		$DetalleDestino=Table::getListQuery("select * from detalledestino where IDLIQUIDACION=".$value['IDLIQUIDACION']);
		

		$totalRecaudado=0;
		foreach ($DetalleDestino as $keyDestino => $valueDestino) {
			$pdf->SetX(18);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(10,$alto,$keyDestino+1,'TR', 0 , 'C',0 );
			$pdf->Cell(75,$alto,$valueDestino['LOCALIDAD'],'TR', 0 , 'C',0 );
			$pdf->Cell(30,$alto,$valueDestino['NROPASAJERO'],'TR', 0 , 'C',0 );
			$pdf->Cell(30,$alto,number_format($valueDestino['COSTOPASAJE'],2,',','.'),'TR', 0 , 'C',0 );
		    $pdf->Cell(30,$alto,number_format($valueDestino['IMPORTE'],2,',','.'),'T', 0 , 'C',0 );
		    $totalRecaudado=$totalRecaudado+$valueDestino['IMPORTE'];
			$pdf->Ln();
		}

		$pdf->SetX(18);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(10,$alto,"",'T', 0 , 'C',0 );
		$pdf->Cell(75,$alto,"",'T', 0 , 'C',0 );
		$pdf->Cell(30,$alto,"",'T', 0 , 'C',0 );
		$pdf->Cell(30,$alto,'TOTAL RECAUDADO:','T', 0 , 'C',0 );
	    $pdf->Cell(30,$alto,number_format($totalRecaudado,2,',','.'),'T', 0 , 'C',0 );

	    /// descuento
		
		$pdf->Ln();
        $pdf->SetX(18);
		
	    $pdf->SetFont('Arial','',10);
		$pdf->Cell(30,$alto,"DETALLE DESCUENTO",'0', 0 , 'L',0 );
		$pdf->Ln();
        $pdf->SetX(18);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(10,$alto,"NRO",'TR', 0 , 'C',0 );
		$pdf->Cell(75,$alto,"DESCUENTO",'TR', 0 , 'C',0 );
	    $pdf->Cell(30,$alto,"IMPORTE",'T', 0 , 'C',0 );
	    $pdf->Ln();
	    $DetalleDescuento=Table::getListQuery("select * from detalledescuento where IDLIQUIDACION=".$value['IDLIQUIDACION']);

		$totalDescuento=0;
		foreach ($DetalleDescuento as $keyDescuento => $valueDescuento) {
			$pdf->SetX(18);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(10,$alto,$keyDescuento+1,'TR', 0 , 'C',0 );
			$pdf->Cell(75,$alto,$valueDescuento['DESCRIPCION'],'TR', 0 , 'C',0 );
		    $pdf->Cell(30,$alto,number_format($valueDescuento['DESCUENTO'],2,',','.'),'T', 0 , 'C',0 );
		    $totalDescuento=$totalDescuento+$valueDescuento['DESCUENTO'];
			$pdf->Ln();
		}

		$pdf->SetX(18);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(60,$alto,"",'T', 0 , 'C',0 );
		$pdf->Cell(20,$alto,'TOTAL DESCUENTO:','T', 0 , 'C',0 );
	    $pdf->Cell(35,$alto,number_format($totalDescuento,2,',','.'),'T', 0 , 'C',0 );
		$pdf->Ln();
	    $pdf->SetX(18);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(60,$alto,"",'', 0 , 'C',0 );
		$pdf->Cell(20,$alto,'LIQUIDO PAGABLE:','', 0 , 'C',0 );
	    $pdf->Cell(35,$alto,number_format($totalRecaudado-$totalDescuento,2,',','.'),'', 0 , 'C',0 );

	    //// etiqueta entregue conforme y recibi conforme
	    $pdf->SetFont('Arial','B',7);
	
		$pdf->SetXY(25,247);
		$pdf->Cell(15,$alto,"",'', 0 , 'L',0 );
		$pdf->Cell(45,$alto,"------------------------------------------------------",'', 0 , 'C',0 );
		$pdf->Cell(60,$alto,"",'', 0 , 'L',0 );
		$pdf->Cell(45,$alto,"-----------------------------------------------------",'', 0 , 'C',0 );

		$pdf->SetXY(25,250);
		$pdf->Cell(15,$alto,"",'', 0 , 'L',0 );
		$pdf->Cell(45,$alto,"ENTREGUE CONFORME",'', 0 , 'C',0 );
		$pdf->Cell(60,$alto,"",'', 0 , 'L',0 );
		$pdf->Cell(45,$alto,"RECIBI. CONFORME",'', 0 , 'C',0 );

		$pdf->SetXY(25,253);
		$pdf->Cell(15,$alto,"",'', 0 , 'L',0 );
		$pdf->Cell(45,$alto,utf8_decode(strtoupper($_SESSION['NOMBRECOMPLETO'])),'', 0 , 'C',0 );
		$pdf->Cell(60,$alto,"",'', 0 , 'L',0 );
		$pdf->Cell(45,$alto,utf8_decode($value['NOMBRE'].' '.$value['PATERNO'].' '.$value['MATERNO']),'', 0 , 'C',0 );


		if(count($Data)>$key+1){
			$pdf->AddPage(); 
		}
	}
	   
    //$pdf->Cell(17,$alto,number_format($totalMonto,2,',','.'),'T', 0 , 'C',0 );
	///INFORME DIARIO
	$fechaArray = explode("/",$fechaInicio);
	$Fecha=explode("-", $_GET['f']);
	$timestamp = strtotime($Fecha[0]."-".$Fecha[1]."-".$Fecha[2]);
	$dia = date('l',$timestamp);
	$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    
	switch($dia){
		case "Monday": $fechatitulo="".$fechaArray[0]." de ".$meses[$fechaArray[1]-1]." de ".$fechaArray[2];break;
		case "Tuesday": $fechatitulo="".$fechaArray[0]." de ".$meses[$fechaArray[1]-1]." de ".$fechaArray[2];break;
		case "Wednesday": $fechatitulo="".$fechaArray[0]." de ".$meses[$fechaArray[1]-1]." de ".$fechaArray[2];break;
		case "Thursday": $fechatitulo="".$fechaArray[0]." de ".$meses[$fechaArray[1]-1]." de ".$fechaArray[2];break;
		case "Friday": $fechatitulo="".$fechaArray[0]." de ".$meses[$fechaArray[1]-1]." de ".$fechaArray[2];break;
		case "Saturday": $fechatitulo="".$fechaArray[0]." de ".$meses[$fechaArray[1]-1]." de ".$fechaArray[2];break;
		case "Sunday": $fechatitulo="".$fechaArray[0]." de ".$meses[$fechaArray[1]-1]." de ".$fechaArray[2];break;
	}

	//$pdf = new docPDF("L","mm","Letter");
    $pdf->AddPage("L"); 
    

	$alto=3; 
    $pdf->SetX(18);
	$pdf->Image($App->getImagen("logo.jpeg"),15,8,245,35);

    $pdf->SetFont('Arial','B',12);
	$pdf->SetX(18);
	$pdf->Cell(250,$alto,"INFORME DIARIO: ".str_pad($Data[0]['NROINFORME'],5,'0',STR_PAD_LEFT),'0', 0 , 'C',0 );
	$pdf->Ln(10);

    $pdf->SetFont('Arial','B',8);
	$pdf->SetX(18);
	$pdf->Cell(180,$alto,"LA PAZ, ".$fechatitulo,'0', 0 , 'L',0 );
	
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
    $DetalleDesTitulo=Table::getListQuery("select DISTINCT(`detalledescuento`.`DESCRIPCION`)
FROM `liquidacion`,`detalledescuento`
WHERE `liquidacion`.`IDLIQUIDACION`=`detalledescuento`.`IDLIQUIDACION`
AND `liquidacion`.`NROINFORME`=".$Data[0]['NROINFORME']." AND `detalledescuento`.`DESCRIPCION`!='APORTE PARA TRABAJO'");

    foreach ($DetalleDesTitulo as $keyTitulo => $valueTitulo) {
    	# code...
    	if($keyTitulo>=2 &&  $keyTitulo<=5){
    		$posX_=$posX_+16;
    		$pdf->SetXY($posX_,$posY);
    		$cadDescripcion=strtolower($valueTitulo['DESCRIPCION']);
	    	$pdf->MultiCell(16,$alto,ucwords($cadDescripcion),'T', 'C',false );
	        
        }
    }
    $posX_=$posX_+16;
    $pdf->SetXY($posX_,$posY);
	$pdf->MultiCell(16,$alto,'Total Aporte Of.','T', 'C',false );
    /*
    $pdf->MultiCell(16,$alto,"Aporte Oficina",'T', 'C',false );
    $pdf->SetXY(163,$posY);
    $pdf->MultiCell(16,$alto,"Pro Accidente",'T','C',false );
    $pdf->SetXY(179,$posY);
    $pdf->MultiCell(16,$alto,"Pro Deporte",'T', 'C',false );
    $pdf->SetXY(195,$posY);
    $pdf->MultiCell(16,$alto,"Pro Alquiler",'T', 'C',false );
	$pdf->SetXY(211,$posY);
    $pdf->MultiCell(16,$alto,"Pro Trabajo",'T', 'C',false );
    $pdf->SetXY(227,$posY);
    $pdf->MultiCell(16,$alto,"Total Aporte Of.",'T', 'C',false );
    */
    $pdf->Ln();

    $totalesArray = array(10);
    for ($i=0; $i <=15 ; $i++) { 
    	$totalesArray[$i]=0;
    }

    $totalLiquido=0;
    $totalImporte=0;
	foreach ($Data as $key => $value) {
		$DetalleDestino=Table::getListQuery("select * from detalledestino where IDLIQUIDACION=".$value['IDLIQUIDACION']);
		$subTotal=0;
		foreach ($DetalleDestino as $keyDestino => $valueDestino) {
			$pdf->SetFont('Arial','',6);
			$pdf->SetX(15);
			$pdf->Cell(55,$alto,$value['NOMBRE'].' '.$value['PATERNO'].' '.$value['MATERNO'],'T',  'L',false );
			
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
		    $pdf->Ln();
		    $subTotal=$subTotal+$valueDestino['IMPORTE'];
		}
		    $totalImporte=$totalImporte+$subTotal;
		    $pdf->SetFont('Arial','B',6);
			$pdf->SetX(15);
			$pdf->Cell(55,$alto,'','T', 0 , 'C',0 );
			$pdf->Cell(45,$alto,'','T', 0 , 'C',0 );
		    $pdf->Cell(16,$alto,'','T', 0 , 'C',0 );
		    $pdf->Cell(16,$alto,'Sub Total','T', 0 , 'C',0 );
		    $pdf->SetFont('Arial','',6);
		    $pdf->Cell(16,$alto, number_format($subTotal,2,',','.'),'T', 0 , 'C',0 );
		    $pdf->Cell(16,$alto,number_format($value['LIQUIDOPAGABLE'],2,',','.'),'T', 0 , 'C',0 );
		    
		    $totalLiquido=$totalLiquido+$value['LIQUIDOPAGABLE'];

	        $DetalleDescuento=Table::getListQuery("select * from detalledescuento where IDLIQUIDACION=".$value['IDLIQUIDACION']." AND IDCATEGORIA =2 ");
	        $totalDescuento=0;

	        
	        $indexArray=0;
		    foreach ($DetalleDescuento as $keyDescuento => $valueDescuento) {
		    	//if($keyDescuento>=2 &&  $keyDescuento<=5){
		    		$pdf->Cell(16,$alto,number_format($valueDescuento['DESCUENTO'],2,',','.'),'T', 0 , 'C',0 );
		    		$totalDescuento=$totalDescuento+$valueDescuento['DESCUENTO'];

		    		$totalesArray[$indexArray]=$valueDescuento['DESCUENTO']+$totalesArray[$indexArray];
		    		$indexArray++;
		    	//}
		    	
		    }
		    
		    $pdf->Cell(16,$alto, number_format($totalDescuento,2,',','.'),'T', 0 , 'C',0 );
		    $totalesArray[$indexArray]=$totalDescuento+$totalesArray[$indexArray];

		$pdf->Ln();
	}
	$pdf->SetFont('Arial','B',6);
	$pdf->SetX(15);
	$pdf->Cell(55,$alto,'','T', 0 , 'C',0 );
	$pdf->Cell(45,$alto,'','T', 0 , 'C',0 );
    $pdf->Cell(16,$alto,'','T', 0 , 'C',0 );
    $pdf->Cell(16,$alto,'Total','T', 0 , 'C',0 );
    $pdf->SetFont('Arial','',6);
    $pdf->Cell(16,$alto,number_format($totalImporte,2,',','.'),'T', 0 , 'C',0 );
    $pdf->Cell(16,$alto,number_format($totalLiquido,2,',','.'),'T', 0 , 'C',0 );
	$totalAporteOfi=0;
	$i=0;
	foreach ($DetalleDescuento as $keyDescuento => $valueDescuento) {
		//if($keyDescuento>=2 &&  $keyDescuento<=6){
			$pdf->Cell(16,$alto,number_format($totalesArray[$i],2,',','.'),'T', 0 , 'C',0 );
	    	$totalAporteOfi=$totalesArray[$i];
	    	$i++;
		//}
	}
    $pdf->Cell(16,$alto,number_format($totalesArray[$i],2,',','.'),'T', 0 , 'C',0 );
	$totalAporteOfi=$totalesArray[$i];

	////IMAGENES
	$DataImagen=Table::getListQuery("select * from imagendepositos where NROINFORME=".$Data[0]['NROINFORME']);
  	
  	$posXImg=$pdf->GetY()+10;
  	$wsImagen=0;
  	$posYImg=120;
    foreach ($DataImagen as $keyImg => $valueImg) {
    	if($valueImg['DESCRIPCION']=='APORTE OFICINA'){
  	      
  	      if ($wsImagen==1) {
  	      	 $pdf->AddPage("L"); 
			$alto=3; 
		    $pdf->SetX(18);
			$pdf->Image($App->getImagen("logo.jpeg"),15,8,245,35);

		    $pdf->SetFont('Arial','B',12);
			$pdf->SetX(18);
			$pdf->Cell(250,$alto,"INFORME DIARIO: ".str_pad($Data[0]['NROINFORME'],5,'0',STR_PAD_LEFT),'0', 0 , 'C',0 );
			$pdf->Ln(10);

		    $pdf->SetFont('Arial','B',8);
			$pdf->SetX(18);
			$pdf->Cell(180,$alto,"LA PAZ, ".$fechatitulo,'0', 0 , 'L',0 );
			$posXImg=50;
  	      }
  	      $pdf->Image('../../images/Depositos/'.$valueImg['NOMBRE'].'.'.$valueImg['EXTENCION'],80,$posXImg,120,50);
  	      $posXImg=$posXImg+60;

  	      $wsImagen++;
    	}

    }
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


	$pdf->AddPage(); 
    

	$alto=3; 
    $pdf->SetX(18);

    $pdf->SetFont('Arial','B',12);
	$pdf->SetX(18);
	$pdf->Cell(180,$alto,"DESCARGO IVA 13% - IT 3% : ".str_pad($Data[0]['NROINFORME'],5,'0',STR_PAD_LEFT),'0', 0 , 'C',0 );
	$pdf->Ln(10);

    $pdf->SetFont('Arial','B',8);
	$pdf->SetX(18);
	$pdf->Cell(180,$alto,"LA PAZ, ".$fechatitulo,'0', 0 , 'L',0 );
	
	$pdf->Ln();
	$pdf->Ln();
	$posY=$pdf->GetY();
	$pdf->SetFont('Arial','B',8);
    $pdf->SetX(20);

	$pdf->MultiCell(60,$alto,"Propietario",'T',  'L',false );
	$pdf->SetXY(80,$posY);
	$pdf->MultiCell(30,$alto,"Localidad",'T',  'C',false );
	$pdf->SetXY(110,$posY);
    $pdf->MultiCell(20,$alto,"Monto Facturado",'T', 'C',false );
    $pdf->SetXY(130,$posY);
    $pdf->MultiCell(20,$alto,"IV 13%",'T', 'C',false );
    $pdf->SetXY(150,$posY);
    $pdf->MultiCell(20,$alto,"IT 3%",'T', 'C',false );
    $pdf->SetXY(170,$posY);
    $pdf->MultiCell(20,$alto,"Total 16%",'T', 'C',false );

    $pdf->Ln();
    $alto=5;
    $totalRecaudado=0;
    $totalDesArray= array(15);
    for ($i=0; $i <15 ; $i++) { 
    	$totalDesArray[$i]=0;
    }
    foreach ($Data as $key => $value) {
    	$pdf->SetX(20);
    	$pdf->SetFont('Arial','',7);
		$pdf->Cell(60,$alto,$value['NOMBRE'].' '.$value['PATERNO'].' '.$value['MATERNO'],'T',  'L',false );
	    $pdf->Cell(30,$alto,$value['LUGARVIAJE'],'T', 0 , 'C',0 );
	    $pdf->Cell(20,$alto,number_format($value['TOTALRECAUDADO'],2,',','.'),'T', 0 , 'C',0 );

	    $DetalleDescuento=Table::getListQuery("select * from detalledescuento where IDLIQUIDACION=".$value['IDLIQUIDACION']);
	    $subTotalDes=0;
	    $i=0;
	  	foreach ($DetalleDescuento as $keyDescuento => $valueDescuento) {
	  		if($keyDescuento<2){
	  			$pdf->Cell(20,$alto,number_format($valueDescuento['DESCUENTO'],2,',','.'),'T', 0 , 'C',0 );
	  			$subTotalDes=$subTotalDes+$valueDescuento['DESCUENTO'];
	  			$totalDesArray[$i]=$totalDesArray[$i]+$valueDescuento['DESCUENTO'];
	  			$i++;
	  		}

	  	}

	  	$pdf->Cell(20,$alto,number_format($subTotalDes,2,',','.'),'T', 0 , 'C',0 );
	  	$pdf->Ln();
	  	$totalRecaudado=$totalRecaudado+$value['TOTALRECAUDADO'];
	  	$totalDesArray[$i]=$totalDesArray[$i]+$subTotalDes;
    }

    $pdf->SetX(20);
    $pdf->SetFont('Arial','B',8);
	$pdf->Cell(60,$alto,"",'T',  'L',false );
	$pdf->Cell(30,$alto,"TOTAL",'T', 0 , 'C',0 );
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(20,$alto,number_format($totalRecaudado,2,',','.'),'T', 0 , 'C',0 );

   $totalAporteOfi=0;
    for ($i=0; $i < 3; $i++) { 
    	$pdf->Cell(20,$alto,number_format($totalDesArray[$i],2,',','.'),'T', 0 , 'C',0 );
    	$totalRetencion=$totalDesArray[$i];
    }
  	
  	$posYImg=$pdf->GetY()+20;
	$wsImagen=0;
    foreach ($DataImagen as $keyImg => $valueImg) {
    	if($valueImg['DESCRIPCION']=='RENTENCIONES'){
    		if($wsImagen==1){
    			
    			$posYImg=$posYImg+55;
    		}
    		elseif($wsImagen==2){
    			$pdf->AddPage(); 
    

				$alto=3; 
			    $pdf->SetX(18);

			    $pdf->SetFont('Arial','B',12);
				$pdf->SetX(18);
				$pdf->Cell(180,$alto,"DESCARGO IVA 13% - IT 3% : ".str_pad($Data[0]['NROINFORME'],5,'0',STR_PAD_LEFT),'0', 0 , 'C',0 );
				$pdf->Ln(10);

			    $pdf->SetFont('Arial','B',8);
				$pdf->SetX(18);
				$pdf->Cell(180,$alto,"LA PAZ, ".$fechatitulo,'0', 0 , 'L',0 );

				$posYImg=60;
    		}
    		$pdf->Image('../../images/Depositos/'.$valueImg['NOMBRE'].'.'.$valueImg['EXTENCION'],40,$posYImg,125,40);
    		$wsImagen++;

    	}
  	   
    }

  	$pdf->SetFont('Arial','B',9);
	$pdf->SetXY(15,220);
	$pdf->Cell(8,$alto,"Son: ",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,convertir_a_letras($totalRetencion),'', 0 , 'L',0 );

	$pdf->SetXY(15,240);
	$pdf->Cell(35,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"---------------------------------------------------",'', 0 , 'C',0 );
	$pdf->Cell(40,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"--------------------------------------------------",'', 0 , 'C',0 );

	$pdf->SetXY(15,244);
	$pdf->Cell(35,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"ENTREGUE CONFORME",'', 0 , 'C',0 );
	$pdf->Cell(40,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"STRIO. HACIENDA",'', 0 , 'C',0 );
////// hoja de control


	
	$pdf->AddPage(); 
    

	$alto=3; 
    $pdf->SetX(18);

    $pdf->SetFont('Arial','B',12);
	$pdf->SetX(18);
	$pdf->Cell(180,$alto,"HOJA DE CONTROL: ".str_pad($Data[0]['NROINFORME'],5,'0',STR_PAD_LEFT),'0', 0 , 'C',0 );
	$pdf->Ln(5);
	$pdf->SetX(18);
	$pdf->Cell(180,$alto,"SECTOR BOLETERIA INTERDEPARTAMENTAL",'0', 0 , 'C',0 );
	$pdf->Ln(10);

    $pdf->SetFont('Arial','B',8);
	$pdf->SetX(18);
	//$pdf->Cell(180,$alto,"LA PAZ, ".$fechatitulo,'0', 0 , 'L',0 );
	
	$pdf->Ln();
	$pdf->Ln();
	$posY=$pdf->GetY();
	$pdf->SetFont('Arial','B',8);
    $pdf->SetX(20);
    $pdf->MultiCell(15,$alto,"FECHA",'T',  'L',false );
	$pdf->SetXY(35,$posY);
	$pdf->MultiCell(65,$alto,"NOMBRE SOCIO",'T',  'C',false );
	$pdf->SetXY(100,$posY);
    $pdf->MultiCell(30,$alto,"MULTA FISCALIZACION",'T', 'C',false );
    $pdf->SetXY(130,$posY);
    $pdf->MultiCell(30,$alto,"MULTA POR RETRASO",'T', 'C',false );
    $pdf->SetXY(160,$posY);
    $pdf->MultiCell(30,$alto,"OBSERVACIONES",'T', 'C',false );

    $DataTrabajo=Table::getListQuery("select `liquidacion`.`FECHAREGISTRO`,
	   CONCAT(`liquidacion`.`NOMBRE`,' ' ,`liquidacion`.`PATERNO`,' ',`liquidacion`.`MATERNO`) AS NOMBRECOMPLETO,
	   `detalledescuento`.`DESCUENTO`
	   FROM `liquidacion`, `detalledescuento`
	   WHERE `liquidacion`.`IDLIQUIDACION`=`detalledescuento`.`IDLIQUIDACION`
	   AND `liquidacion`.`FECHAREGISTRO`='".$_GET['f']."'
	   AND `liquidacion`.`IDUSUARIO`=".$_GET['id']."
	   AND `detalledescuento`.`IDCATEGORIA`='3'
	   AND `detalledescuento`.`DESCUENTO`>0");
    $pdf->Ln();
    $alto=5;
    $totalDesTra=0;
    foreach ($DataTrabajo as $keyT => $valueT) {
    	$pdf->SetFont('Arial','',8);
	    $pdf->SetX(20);
		$pdf->Cell(15,$alto,$valueT['FECHAREGISTRO'],'T', 0 , 'C',0 );
	    $pdf->Cell(65,$alto,$valueT['NOMBRECOMPLETO'],'T', 0 , 'C',0 );
	    $pdf->Cell(30,$alto,number_format($valueT['DESCUENTO'],2,',','.'),'T', 0 , 'C',0 );
	    $pdf->Cell(30,$alto,"",'T', 0 , 'C',0 );
	    $pdf->Cell(30,$alto,"",'T', 0 , 'C',0 );
	    $pdf->Ln();
	    $totalDesTra=$totalDesTra+$valueT['DESCUENTO'];
    }
    $pdf->SetFont('Arial','',8);
    $pdf->SetX(20);
	$pdf->Cell(15,$alto,"",'T', 0 , 'C',0 );
    $pdf->Cell(65,$alto,"TOTAL",'T', 0 , 'C',0 );
    $pdf->Cell(30,$alto,number_format($totalDesTra,2,',','.'),'T', 0 , 'C',0 );
    $pdf->Cell(30,$alto,"",'T', 0 , 'C',0 );
    $pdf->Cell(30,$alto,"",'T', 0 , 'C',0 );
    $pdf->Ln();

    $posYImg=$pdf->GetY()+20;
    $wsImagen=0;
    foreach ($DataImagen as $keyImg => $valueImg) {
    	if($valueImg['DESCRIPCION']=='HOJA CONTROL'){
    		
    		if($wsImagen==1){
    			
    			$posYImg=$posYImg+55;
    		}
    		elseif($wsImagen==2){
    			$pdf->AddPage(); 
    

				$alto=3; 
			    $pdf->SetX(18);

			    $pdf->SetFont('Arial','B',12);
				$pdf->SetX(18);
				$pdf->Cell(180,$alto,"HOJA DE CONTROL: ".str_pad($Data[0]['NROINFORME'],5,'0',STR_PAD_LEFT),'0', 0 , 'C',0 );
				$pdf->Ln(5);
				$pdf->SetX(18);
				$pdf->Cell(180,$alto,"SECTOR BOLETERIA INTERDEPARTAMENTAL",'0', 0 , 'C',0 );
				$pdf->Ln(10);

				$posYImg=60;
    		}


			$pdf->Image('../../images/Depositos/'.$valueImg['NOMBRE'].'.'.$valueImg['EXTENCION'],40,$posYImg,125,40);
    		$wsImagen++;
    	}
  	   
    }
    $pdf->SetFont('Arial','B',9);
	$pdf->SetXY(15,220);
	$pdf->Cell(8,$alto,"Son: ",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,convertir_a_letras($totalDesTra),'', 0 , 'L',0 );


	$pdf->SetXY(15,240);
	$pdf->Cell(35,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"---------------------------------------------------",'', 0 , 'C',0 );
	$pdf->Cell(40,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"--------------------------------------------------",'', 0 , 'C',0 );

	$pdf->SetXY(15,244);
	$pdf->Cell(35,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"ENTREGUE CONFORME",'', 0 , 'C',0 );
	$pdf->Cell(40,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"STRIO. HACIENDA",'', 0 , 'C',0 );

//////HOJA ADICIONAL

	$pdf->AddPage(); 
    

	$alto=3; 
    $pdf->SetX(18);

    $pdf->SetFont('Arial','B',12);
	$pdf->SetX(18);
	$pdf->Cell(180,$alto,"DESCUENTOS ADICIONALES - INFORME: ".str_pad($Data[0]['NROINFORME'],5,'0',STR_PAD_LEFT),'0', 0 , 'C',0 );
	$pdf->Ln(5);
	$pdf->SetX(18);
	$pdf->Cell(180,$alto,"SECTOR BOLETERIA INTERDEPARTAMENTAL",'0', 0 , 'C',0 );
	$pdf->Ln(10);

    $pdf->SetFont('Arial','B',8);
	$pdf->SetX(18);
	//$pdf->Cell(180,$alto,"LA PAZ, ".$fechatitulo,'0', 0 , 'L',0 );
	
	$pdf->Ln();
	$pdf->Ln();
	$posY=$pdf->GetY();
	$pdf->SetFont('Arial','B',7);
    $pdf->SetX(15);
    $pdf->MultiCell(15,$alto,"FECHA",'T',  'L',false );
	$pdf->SetXY(30,$posY);
	$pdf->MultiCell(75,$alto,"NOMBRE SOCIO",'T',  'C',false );
	$pdf->SetXY(105,$posY);
    $pdf->MultiCell(45,$alto,"DESCRIPCION DE DESCUENTO",'T', 'C',false );
    $pdf->SetXY(150,$posY);
    $pdf->MultiCell(20,$alto,"DESCUENTO",'T', 'C',false );
    $pdf->SetXY(170,$posY);
    $pdf->MultiCell(25,$alto,"OBSERVACIONES",'T', 'C',false );

    $DataTrabajo=Table::getListQuery("select `liquidacion`.`FECHAREGISTRO`,
	   CONCAT(`liquidacion`.`NOMBRE`,' ' ,`liquidacion`.`PATERNO`,' ',`liquidacion`.`MATERNO`) AS NOMBRECOMPLETO,
	   `detalledescuento`.`DESCUENTO`,`detalledescuento`.`DESCRIPCION`
	   FROM `liquidacion`, `detalledescuento`
	   WHERE `liquidacion`.`IDLIQUIDACION`=`detalledescuento`.`IDLIQUIDACION`
	   AND `liquidacion`.`FECHAREGISTRO`='".$_GET['f']."'
	   AND `liquidacion`.`IDUSUARIO`=".$_GET['id']."
	   AND `detalledescuento`.`IDCATEGORIA`=4
	   AND `detalledescuento`.`DESCUENTO`>0");
    $pdf->Ln();
    $alto=5;
    $totalDesTra=0;
    foreach ($DataTrabajo as $keyT => $valueT) {
    	$pdf->SetFont('Arial','',8);
	    $pdf->SetX(15);
		$pdf->Cell(15,$alto,$valueT['FECHAREGISTRO'],'T', 0 , 'L',0 );
	    $pdf->Cell(75,$alto,utf8_decode($valueT['NOMBRECOMPLETO']),'T', 0 , 'C',0 );
	    $pdf->Cell(45,$alto,ucwords(utf8_decode($valueT['DESCRIPCION'])),'T', 0 , 'C',0 );
	    $pdf->Cell(20,$alto,number_format($valueT['DESCUENTO'],2,',','.'),'T', 0 , 'C',0 );
	    $pdf->Cell(25,$alto,"",'T', 0 , 'C',0 );
	    $pdf->Ln();
	    $totalDesTra=$totalDesTra+$valueT['DESCUENTO'];
    }
    $pdf->SetFont('Arial','',8);
    $pdf->SetX(15);
	$pdf->Cell(65,$alto,"",'T', 0 , 'C',0 );
    $pdf->Cell(65,$alto,"TOTAL",'T', 0 , 'C',0 );
    $pdf->Cell(30,$alto,number_format($totalDesTra,2,',','.'),'T', 0 , 'C',0 );
    $pdf->Cell(20,$alto,"",'T', 0 , 'C',0 );
   // $pdf->Cell(30,$alto,"",'T', 0 , 'C',0 );
    $pdf->Ln();

     $posYImg=$pdf->GetY()+20;
     $wsImagen=0;
    foreach ($DataImagen as $keyImg => $valueImg) {
    	if($valueImg['DESCRIPCION']=='VARIOS'){
    		if($wsImagen==1){
    			
    			$posYImg=$posYImg+55;
    		}
    		elseif($wsImagen==2){
    			
				$pdf->AddPage(); 
			    

				$alto=3; 
			    $pdf->SetX(18);

			    $pdf->SetFont('Arial','B',12);
				$pdf->SetX(18);
				$pdf->Cell(180,$alto,"DESCUENTOS ADICIONALES - INFORME: ".str_pad($Data[0]['NROINFORME'],5,'0',STR_PAD_LEFT),'0', 0 , 'C',0 );
				$pdf->Ln(5);
				$pdf->SetX(18);
				$pdf->Cell(180,$alto,"SECTOR BOLETERIA INTERDEPARTAMENTAL",'0', 0 , 'C',0 );
				$pdf->Ln(10);

				$posYImg=60;
    		}
    		$pdf->Image('../../images/Depositos/'.$valueImg['NOMBRE'].'.'.$valueImg['EXTENCION'],40,$posYImg,125,40);
    		$wsImagen++;

    	}
  	   
    }

    $pdf->SetFont('Arial','B',8);
	$pdf->SetXY(15,220);
	$pdf->Cell(8,$alto,"Son: ",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,convertir_a_letras($totalDesTra),'', 0 , 'L',0 );


	$pdf->SetXY(15,240);
	$pdf->Cell(35,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"---------------------------------------------------",'', 0 , 'C',0 );
	$pdf->Cell(40,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"--------------------------------------------------",'', 0 , 'C',0 );

	$pdf->SetXY(15,244);
	$pdf->Cell(35,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"ENTREGUE CONFORME",'', 0 , 'C',0 );
	$pdf->Cell(40,$alto,"",'', 0 , 'L',0 );
	$pdf->Cell(45,$alto,"STRIO. HACIENDA",'', 0 , 'C',0 );

/// INFORME ADICIONA DE DESCUENTOS


	///// se imprime la imagen de los depositos
	/*$pdf->AddPage(); 
    

	$alto=3; 
    $pdf->SetX(18);

    $pdf->SetFont('Arial','B',12);
	$pdf->SetX(18);
	$pdf->Cell(180,$alto,"CONPROBANTES DE DEPOSITOS - INFORME:".str_pad($Data[0]['NROINFORME'],5,'0',STR_PAD_LEFT),'0', 0 , 'C',0 );
	$pdf->Ln(5);


     $DataImagen=Table::getListQuery("select * from imagendepositos where NROINFORME=".$Data[0]['NROINFORME']);
     $posXImg=50;
     foreach ($DataImagen as $keyImg => $valueImg) {
     	# code...
     	$pdf->Image('../../images/Depositos/'.$valueImg['NOMBRE'].'.'.$valueImg['EXTENCION'],40,$posXImg,140,60);
     	
     	$posXImg=$posXImg+65;
     	if($posXImg==245){
     	    $posXImg=50;
     	    $pdf->AddPage(); 
    

			$alto=3; 
		    $pdf->SetX(18);

		    $pdf->SetFont('Arial','B',12);
			$pdf->SetX(18);
			$pdf->Cell(180,$alto,"CONPROBANTES DE DEPOSITOS - INFORME:".str_pad($Data[0]['NROINFORME'],5,'0',STR_PAD_LEFT),'0', 0 , 'C',0 );
			$pdf->Ln(5);	
     	}
     }
	*/
    $pdf->OutPut();

?>
