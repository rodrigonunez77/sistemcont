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
		
		$this->SetXY(8,25);
		//$this->Cell(202,5,"(BASE DE DATOS DGR - MODULO REPORTES)",0,0,'C');
		
		if(isset($GLOBALS['FILE_LOGO']))
			$this->Image($GLOBALS['FILE_LOGO'],20,8,40);
	//	$this->Line(25,30,191,30);			
		$this->Ln(6);

		/**
		 * Cabecera para todas las hojas
		 */
		$this->setMargenes();
		$this->SetDisplayMode("real"); 
		$this->insertTitulo($GLOBALS['TITULO_GENERAL']);
		//$this->SetFont('Arial','B',12);
		//$this->Ln(2);
		//$this->MultiCell(0,4,$GLOBALS['TITULO_REPORTE'],10,'C',false);
		$this->SetFont('Arial','',9);
		$this->MultiCell(0,7,$GLOBALS['TITULO_FECHA'],10,'C',false);
		//$this->Line(25,49,195,49);
		//$this->Ln(10);			
		//$this->Line($this->GetX(),$this->GetY() - 10,$this->GetX()+170,$this->GetY() - 10);			
		$this->Ln(3);
		
	}

	/**
	 * Pie de la pagina
	 *
	 */
	function Footer() {

		//$this->ln(15);
		$this->Line(25,263,191,263);//LINEA
		//$this->SetY(-25);
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
		$this->Cell($Longitud,10,utf8_decode($Text),0,0,'L');
		//$this->ln(4);
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
