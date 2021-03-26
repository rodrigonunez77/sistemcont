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
		//$this->Cell(285,8,"(BASE DE DATOS DGR - MODULO REPORTES)",0,0,'C');
		
		if(isset($GLOBALS['FILE_LOGO']))
			$this->Image($GLOBALS['FILE_LOGO'],18,5,245,40);
		$this->Line(18,37,260,37);			
		$this->Ln(9);

		/**
		 * Cabecera para todas las hojas
		 */
		$this->setMargenes();
		$this->SetDisplayMode("real"); 
		$this->insertTitulo($GLOBALS['TITULO_GENERAL']);
		$this->SetFont('Arial','B',12);
		//$this->Ln(2);
		$this->MultiCell(0,4,$GLOBALS['TITULO_REPORTE'],10,'C',false);
		$this->SetFont('Arial','',9);
		$this->MultiCell(0,7,$GLOBALS['TITULO_FECHA'],10,'C',false);
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
		//linea inferior  del pie de pagina
		$this->Line(15,208,260,208);
		//$this->SetY(-25);
		
		$this->SetY(-7);
		$this->SetFont('Arial','I',8);
		
		$Text = utf8_decode( "Fecha de Impresión: ".date("d/m/Y") );
		$this->SetFont('Arial','B',8);
		$Longitud = $this->GetStringWidth($Text)+8;
		$this->Cell($Longitud,5,$Text,0,0,'L');
		
		$Text =utf8_decode(  "Hora de Impresión: ".date("H:i"));
		$this->SetFont('Arial','B',8);
		$Longitud = $this->GetStringWidth($Text)+8;
		$this->Cell($Longitud,5,$Text,0,0,'L');

		$Text = "Usuario: ".$GLOBALS['PIE_USUARIO'];
		$this->SetFont('Arial','B',8);
		$Longitud = $this->GetStringWidth($Text)+8;
		$this->Cell($Longitud,5,$Text,0,0,'L');
		//$this->ln(4);
		$this->SetFont('Arial','I',8);
		$this->Cell  (0,5,utf8_decode( "Página ".$this->PageNo()),0,0,'C');
	}
	
	function setMargenes(){
		$this->SetLeftMargin($this->__MargenIzquierdo);
		$this->SetRightMargin($this->__MargenDerecho);
		$this->SetTopMargin($this->__MargenSuperior);
		$this->SetAutoPageBreak(true , 0);
		//$this->PageBreakTrigger = 900;
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
		///$this->add_font('Century_Gothic', '', 'Century_Gothic.ttf', uni=true);

		# Añade una fuente unicode del sistema, usando su ruta completa
		//$this->add_font('sysfont', '', r'c:\WINDOWS\Fonts\Century_Gothic.ttf', uni=true);
		
		$this->SetFont('Arial','B',13);
		$this->Cell(0,8,$titulo,0,0,'C');
		$this->Ln(8);
	}	
}
?>