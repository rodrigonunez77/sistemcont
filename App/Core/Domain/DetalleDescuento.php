<?php
require_once $App->getPathDomain()."MySql.php";
require_once $App->getPathDomain()."ITransaccion.php";


class DetalleDescuento implements ITransaccion  {
    
    private $idDetalleDescuento;	
    private $idLiquidacion;
    private $idCategoria;
    private $tipoConcepto;
    private $descripcion;
    private $descuento;
    private $porcentaje;
    private $idUsuario;
    private $idLugar;
    private $departamento;
    private $codigoUnico;
                
    function __construct($id='') {
        if(trim($id!='')){
                $Base = new MySql();
                $Sql = "SELECT * FROM detalledescuento WHERE detalledescuento.IDDETALLEDESCUENTO= '".$id."';";
                $Base->Query($Sql);
                if($Base->NumRows()==1 && $Row = $Base->NextRecord()){
                        $this->idDetalleDescuento= $Row['IDDETALLEDESCUENTO'];	
                        $this->idLiquidacion = $Row['IDLIQUIDACION'];
                        $this->idCategoria = $Row['IDCATEGORIA'];	
                        $this->tipoConcepto = $Row['TIPOCONCEPTO'];
                        $this->descripcion = $Row['DESCRIPCION'];
                        $this->descuento = $Row['DESCUENTO'];
                        $this->porcentaje = $Row['PORCENTAJE'];
                        $this->idUsuario = $Row['IDUSUARIO'];
                        $this->idLugar = $Row['IDLUGAR'];
                        $this->departamento = $Row['DEPARTAMENTO'];
                        $this->codigoUnico = $Row['CODIGOUNICO'];
                        
                }
                else{
                        if($id!=0)
                                trigger_error("Error en la clase: DETALLE DESCUENTO, funcion: __construct".$Sql); 
                }				
        }
    }
    
    function getIdDetalleDescuento() {
        return $this->idDetalleDescuento;
    }

    function getIdLiquidacion() {
        return $this->idLiquidacion;
    }

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function getTipoConcepto() {
        return $this->tipoConcepto;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getDescuento() {
        return $this->descuento;
    }

    function getPorcentaje() {
        return $this->porcentaje;
    }


    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdLugar() {
        return $this->idLugar;
    }

    function getDepartamento() {
        return $this->departamento;
    }

    function getCodigoUnico() {
        return $this->codigoUnico;
    }

    function setIdDetalleDescuento($idDetalleDescuento) {
        $this->idDetalleDescuento = $idDetalleDescuento;
    }

    function setIdLiquidacion($idLiquidacion) {
        $this->idLiquidacion = $idLiquidacion;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    function setTipoConcepto($tipoConcepto) {
        $this->tipoConcepto = $tipoConcepto;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setDescuento($descuento) {
        $this->descuento = $descuento;
    }

    function setPorcentaje($porcentaje) {
        $this->porcentaje = $porcentaje;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdLugar($idLugar) {
        $this->idLugar = $idLugar;
    }

    function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    function setCodigoUnico($codigoUnico) {
        $this->codigoUnico = $codigoUnico;
    }

                    
    
    
    /**
	 * @see ITransaccion::delete()
	 *
	 * @param [int] $id
	 */
	public function delete($id='') {
		$Base = new MySql();
		if(trim($id)=='')
			$id = $this->idDetalleDescuento;

		$Sql = "DELETE FROM detalledescuento WHERE detalledescuento.IDDETALLEDESCUENTO= '".$id."'";
		//print_r($Sql);
		$Base->Query($Sql);
	}
	
	/**
	 * @see ITransaccion::find()
	 *
	 * @param int $id
	 */
	public function find($id) {
	}
	
	/**
	 * @see ITransaccion::insert()
	 *
	 * @param int $id
	 */
	public function insert($id='') {
		$Base = new MySql();
		$Sql = "INSERT INTO detalledescuento  SET
                            IDLIQUIDACION='".$this->idLiquidacion."', 
                            IDCATEGORIA='".$this->idCategoria."',
                            TIPOCONCEPTO='".$this->tipoConcepto."',
                            DESCRIPCION='".$this->descripcion."',
                            DESCUENTO='".$this->descuento."',
                            PORCENTAJE='".$this->porcentaje."',
                            IDUSUARIO='".$this->idUsuario."',
                            IDLUGAR='".$this->idLugar."',
                            DEPARTAMENTO='".$this->departamento."',
                            CODIGOUNICO='".$this->codigoUnico."'
			";
		//echo $Sql;
		$Base->Query($Sql);
		//$this->idCliente = $id;  	
	}
	
	/**
	 * @see ITransaccion::update()
	 *
	 * @param [int] $id
	 */
	public function update($id='') {
		$Base = new MySql();
		$Sql = "UPDATE detalledescuento SET 			
					IDCATEGORIA='".$this->descripcion."',
					TIPOCONCEPTO='".$this->tipoConcepto."',
                                        DESCRIPCION='".$this->descripcion."',
                                        PORCENTAJE='".$this->porcentaje."',
                                        DESCUENTO='".$this->descuento."'
					";
                
		if(trim($id)!='')
			$Sql = $Sql." WHERE detalledescuento.IDDETALLEDESCUENTO='".$id."';";
		else 
			$Sql = $Sql." WHERE detalledescuento.IDDETALLEDESCUENTO='".$this->idDetalleDescuento."';";
		$Base->Query($Sql);
	}

	/**
	 * Obtiene la lista 
	 * (Se puede dar la clausula WHERE para seleccion)'
	 * 
	 * @param [String] $SqlWhere
	 */
	public static function getList($SqlWhere = ''){
		$Base = new MySql();
		$Sql = "SELECT * FROM detalledescuento ".$SqlWhere;
		$Base->Query($Sql);
		$Data = array();	
		$NumRow = 0;
		while ($Base->NumRows()>0 && $Row = $Base->NextRecord()){
			$Data[$NumRow] = $Row;		
			$NumRow++;
		}		
		return $Data;		
	}		
}
?>