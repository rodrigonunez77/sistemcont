<?php
require_once $App->getPathDomain()."MySql.php";
require_once $App->getPathDomain()."ITransaccion.php";


class Lugar implements ITransaccion  {
    
    private $idLugar;
    private $idDependencia;	
    private $descripcion;
    private $tipo;
    private $fechaRegistro;
    private $fechaSistema;
    private $sistemas;
    private $codigoUnico;
    private $departamento;
    private $direccion;
    
    function __construct($id='') {
            if(trim($id!='')){
                    $Base = new MySql();
                    $Sql = "SELECT * FROM lugares WHERE lugares.IDLUGAR= '".$id."';";
                    $Base->Query($Sql);
                    if($Base->NumRows()==1 && $Row = $Base->NextRecord()){
                            $this->idLugar= $Row['IDLUGAR'];
                            $this->idDependencia= $Row['IDDEPENDENCIA'];
                            $this->descripcion = $Row['DESCRIPCION'];	
                            $this->tipo = $Row['TIPO'];
                            $this->fechaRegistro = $Row['FECHAREGISTRO'];
                            $this->fechaSistema = $Row['FECHASISTEMA'];
                            $this->sistemas = $Row['SISTEMAS'];
                            $this->codigoUnico = $Row['CODIGOUNICO'];
                            $this->departamento = $Row['DEPARTAMENTO'];
                            $this->direccion=$Row['DIRECCION'];
                    }
                    else{
                            if($id!=0)
                                    trigger_error("Error en la clase: LUGAR, funcion: __construct".$Sql); 
                    }				
            }
    }
    
    function getIdLugar() {
        return $this->idLugar;
    }
    
    function getIdDependencia() {
        return $this->idDependencia;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    function getFechaSistema() {
        return $this->fechaSistema;
    }

    function getSistemas() {
        return $this->sistemas;
    }

    function getCodigoUnico() {
        return $this->codigoUnico;
    }

    function getDepartamento() {
        return $this->departamento;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function setIdLugar($idLugar) {
        $this->idLugar = $idLugar;
    }

    function setIdDependencia($idDependencia) {
        $this->idDependencia = $idDependencia;
    }
    
    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    function setFechaSistema($fechaSistema) {
        $this->fechaSistema = $fechaSistema;
    }

    function setSistemas($sistemas) {
        $this->sistemas = $sistemas;
    }

    function setCodigoUnico($codigoUnico) {
        $this->codigoUnico = $codigoUnico;
    }

    function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    
    /**
	 * @see ITransaccion::delete()
	 *
	 * @param [int] $id
	 */
	public function delete($id='') {
		$Base = new MySql();
		if(trim($id)=='')
			$id = $this->idDependencia;

		$Sql = "DELETE FROM lugares WHERE lugares.IDLUGAR= '".$id."'";
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
		$Sql = "INSERT INTO lugares (
                                        IDLUGAR,
					IDDEPENDENCIA,
					DESCRIPCION,
					TIPO,
					FECHAREGISTRO,
					FECHASISTEMA,
					SISTEMAS,
					CODIGOUNICO,
                                        DEPARTAMENTO,
                                        DIRECCION
					)
					VALUES (
						'".$id."', 
                                                '".$this->idDependencia."', 
						'".$this->descripcion."',
						'".$this->tipo."',
						'".$this->fechaRegistro."',
						'".$this->fechaSistema."',
						'".$this->sistemas."',
                                                '".$this->codigoUnico."',
                                                '".$this->departamento."',
                                                '".$this->direccion."'
					);";
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
		$Sql = "UPDATE lugares SET 			
						IDDEPENDENCIA='".$this->idDependencia."',
                                                DESCRIPCION='".$this->descripcion."',
						TIPO='".$this->tipo."',
						FECHAREGISTRO='".$this->fechaRegistro."',
						FECHASISTEMA='".$this->fechaSistema."',
						SISTEMAS='".$this->sistemas."',
						DEPARTAMENTO='".$this->departamento."',
                                                DIRECCION='".$this->direccion."'
						";
		if(trim($id)!='')
			$Sql = $Sql." WHERE lugares.IDLUGAR='".$id."';";
		else 
			$Sql = $Sql." WHERE lugares.IDLUGAR='".$this->idLugar."';";
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
		$Sql = "SELECT * FROM lugares ".$SqlWhere;
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