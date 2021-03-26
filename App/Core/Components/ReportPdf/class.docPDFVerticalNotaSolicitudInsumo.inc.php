
<?php
require('fpdf/fpdf.php');
class docPDF extends FPDF {
	private $__MargenIzquierdo = 25;
	private $__MargenDerecho = 25;
	private $__MargenSuperior = 30;
	
	/**
	 * Cabecera
	 *
	 */
	function Header() {
		
		$Text = "";
		$this->SetFont('Arial','B',7);
		$this->SetXY(25,15);
		$Longitud = $this->GetStringWidth($Text)+6;		
		$Longitudd = $this->GetStringWidth($Text);
		//$this->Cell(0, 50, $this->Image($GLOBALS['FILE_LOGO'], $this->GetX()-10,$this->GetY()-10),0,0,'C');
		
		
		$this->Cell($Longitud,8,$Text,0,0,'L');
		
		$this->SetXY(8,25);
		$this->Cell(202,5,"",0,0,'C');
		
		if(isset($GLOBALS['FILE_LOGO']))
			$this->Image($GLOBALS['FILE_LOGO'],90,5,40);
		$this->Line(23,30,191,30);			
		$this->Ln(6);

		/**
		 * Cabecera para todas las hojas
		 */
		$this->setMargenes();
		$this->SetDisplayMode("real"); 
		$this->insertTitulo($GLOBALS['TITULO_GENERAL']);
		$this->SetFont('Arial','B',12);
		$this->Ln(2);
		$this->MultiCell(0,4,$GLOBALS['TITULO_REPORTE'],10,'C',false);
		$this->SetFont('Arial','',9);
		$this->MultiCell(0,7,"",10,'C',false);	
		$this->SetFont('Arial','',10);
		$this->Cell(37,7,"FECHA:.......................",0,0,'L');
		//$this->Cell(73,7,"TIPO DE CAMBIO   UFV:...........  SUS:...........",0,0,'L');
		$this->Cell(90,7,"",0,0,'L');
		$this->Cell(20,7,utf8_decode("COD. N/S:................."),0,0,'L');
		$this->Ln();
		$this->Cell(90,7,"DE:..........................................................................",0,0,'L');
		$this->Cell(90,7,"A:............................................................................",0,0,'L');
		$this->Ln();
		$this->Cell(90,7,"CARGO:..................................................................",0,0,'L');
		$this->Cell(90,7,"CARGO:..................................................................",0,0,'L');
		$this->Ln();
		$this->Cell(90,7,"OFICINA:.................................................................",0,0,'L');
		$this->Cell(90,7,"OFICINA:.................................................................",0,0,'L');
		$this->Ln(2);
		
	}

	/**
	 * Pie de la pagina
	 *
	 */
	function Footer() {
		
		$this->SetFont('Arial','',9);
		
		$this->SetXY(35,242);
		$this->Cell(10,10,"...............................................",0,0,'L');
		$this->SetXY(42,245);
		$this->Cell(22,10,"FIRMA Y SELLO",0,0,'L');
		$this->SetXY(32,250);
		
		if(isset($GLOBALS['RECAUDADOR']) && $GLOBALS['RECAUDADOR']=="SI")
			$this->Cell(20,10,"ENCARGADO(A) DE ALMACENES",0,0,'L');
		else
			$this->Cell(20,10,"ENCARGADO(A) DE ALMACENES",0,0,'L');
		
		$this->SetXY(90,242);
		$this->Cell(10,10,"...............................................",0,0,'L');
		$this->SetXY(97,245);
		$this->Cell(22,10,"FIRMA Y SELLO",0,0,'L');
		$this->SetXY(104,250);
		$this->Cell(20,10,"VoBo",0,0,'L');
		
		$this->SetXY(150,242);
		$this->Cell(10,10,"...............................................",0,0,'L');
		$this->SetXY(157,245);
		$this->Cell(20,10,"FIRMA Y SELLO",0,0,'L');
		$this->SetXY(147,250);
		if(isset($GLOBALS['RECAUDADOR']) && $GLOBALS['RECAUDADOR']=="SI")
			$this->Cell(45,10,"SOLICITANTE",0,0,'C');
		else
			$this->Cell(20,10,"RESPONSABLE DEPARTAMENTAL",0,0,'L');				
		
		/*$this->SetXY(157,242);
		$this->Cell(10,10,".......................................",0,0,'L');
		$this->SetXY(167,245);
		$this->Cell(20,10,"Contabilidad",0,0,'L');
		*/
		$this->Line(25,263,191,263);
		$this->SetY(-19);
		$this->SetFont('Arial','I',8);
		
		$Text = utf8_decode("Fecha de Impresión: ".date("d/m/Y"));
		$this->SetFont('Arial','B',8);
		$Longitud = $this->GetStringWidth($Text)+8;
		$this->Cell($Longitud,10,$Text,0,0,'L');
		
		$Text =utf8_decode("Hora de Impresión: ".date("H:i"));
		$this->SetFont('Arial','B',8);
		$Longitud = $this->GetStringWidth($Text)+8;
		$this->Cell($Longitud,10,$Text,0,0,'L');

		$Text = "Usuario: ".$GLOBALS['PIE_USUARIO'];
		$this->SetFont('Arial','B',8);
		$Longitud = $this->GetStringWidth($Text)+8;
		$this->Cell($Longitud,10,$Text,0,0,'L');
		
		$this->SetFont('Arial','I',8);
		$this->Cell(0,10,utf8_decode("Página ".$this->PageNo()),0,0,'C');
	}
	
	function setMargenes(){
		$this->SetLeftMargin($this->__MargenIzquierdo);
		$this->SetRightMargin($this->__MargenDerecho);
		$this->SetTopMargin($this->__MargenSuperior);
	}
	
	
	function Tabla($Cabecera='',$Contenido='') {
		$AUX = explode(',',$Cabecera);
		$L = NULL;	// Longitudes de las celdas
		$i = 0;
		//Cabecera
		$this->SetFont('Arial','B',14);
		foreach($AUX as $Index => $Value) {
			$Longitud = $this->GetStringWidth($Value);
			$L[$i] = $Longitud+6;
			$this->Cell($Longitud,7,$Value,1,0,'C');
			$i++;
		}
		$this->Ln();
	}
	
	/**
	 * Inserta el titulo de la pagina
	 *
	 * @param String:Titulo $titulo
	 */
	function insertTitulo($titulo){
		$this->SetFont('Arial','B',13);
		$this->Cell(0,8,$titulo,0,0,'C');
		$this->Ln(8);
	}	
}
?>
