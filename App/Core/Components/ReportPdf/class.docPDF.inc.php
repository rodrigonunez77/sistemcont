<?php
require('fpdf/fpdf.php');


class docPDF extends FPDF {
	private $__MargenIzquierdo = 30;
	private $__MargenDerecho = 26;
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
		//$this->Cell(0, 50, $this->Image($GLOBALS['FILE_LOGO'], $this->GetX()-10,$this->GetY()-10),0,0,'C');
		
		
		$this->Cell($Longitud,8,$Text,0,0,'L');
		
		$this->SetXY(0,$this->__MargenIzquierdo);
		$this->Cell(0,8,"(BASE DE DATOS DGR - MODULO REPORTES)",0,0,'C');
		
		if(isset($GLOBALS['FILE_LOGO']))
			$this->Image($GLOBALS['FILE_LOGO'],90,5,50);
		$this->Line(25,37,195,37);			
		$this->Ln(9);

		/**
		 * Cabecera para todas las hojas
		 */
		$this->setMargenes();
		$this->SetDisplayMode("real"); 
		$this->insertTitulo("REPORTE");
		$this->SetFont('Arial','B',12);
		//$this->Ln(2);
		$this->MultiCell(0,4,$GLOBALS['TITULO_REPORTE'],12,'C',false);
		//$this->Cell(0,4,"SIGLA: ".$GLOBALS['SIGLA_OECA'],"B",0,'C');
		//$this->Line(25,49,195,49);
		//$this->Ln(10);			
		//$this->Line($this->GetX(),$this->GetY() - 10,$this->GetX()+170,$this->GetY() - 10);			
		$this->Ln(6);
		
	}

	/**
	 * Pie de la pagina
	 *
	 */
	function Footer() {

		//$this->ln(15);
		$this->Line(25,260,195,260);
		//$this->SetY(-25);
		$this->SetY(-19);
		$this->SetFont('Arial','I',8);
		
		$Text = "Fecha de Impresión: ".date("d/m/Y");
		$this->SetFont('Arial','B',8);
		$Longitud = $this->GetStringWidth($Text)+8;
		$this->Cell($Longitud,5,$Text,0,0,'L');
		
		$Text = "Hora de Impresión: ".date("H:i");
		$this->SetFont('Arial','B',8);
		$Longitud = $this->GetStringWidth($Text)+8;
		$this->Cell($Longitud,5,$Text,0,0,'L');

		//$Text = "Usuario: ".$GLOBALS['PIE_USUARIO'];
		$this->SetFont('Arial','B',8);
		$Longitud = $this->GetStringWidth($Text)+8;
		$this->Cell($Longitud,5,$Text,0,0,'L');
		//$this->ln(4);
		$this->SetFont('Arial','I',8);
		$this->Cell(0,5,"Página ".$this->PageNo(),0,0,'R');
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
		$this->SetFont('Arial','B',16);
		$this->Cell(0,8,$titulo,0,0,'C');
		$this->Ln(8);
	}	
}
?>