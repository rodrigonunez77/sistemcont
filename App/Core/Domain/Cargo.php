<?php
require_once $App->getPathDomain()."MySql.php";
require_once $App->getPathDomain()."ITransaccion.php";


class Cargo implements ITransaccion  {
    
    private $idCargo;	
    private $descripcion;
    private $fechaRegistro;
    private $fechaSistema;
    private $item;
    private $codigoUnico;

    
    function __construct($id='') {
            if(trim($id!='')){
                    $Base = new MySql();
                    $Sql = "SELECT * FROM cargos WHERE cargos.IDCARGO= '".$id."';";
                    $Base->Query($Sql);
                    if($Base->NumRows()==1 && $Row = $Base->NextRecord()){
                            $this->idCargo= $Row['IDCARGO'];	
                            $this->descripcion = $Row['DESCRIPCION'];	
                            $this->fechaRegistro = $Row['FECHAREGISTRO'];
                            $this->fechaSistema = $Row['FECHASISTEMA'];
                            $this->item = $Row['ITEM'];
                            $this->codigoUnico = $Row['CODIGOUNICO'];
                    }
                    else{
                            if($id!=0)
                                    trigger_error("Error en la clase: CARGO, funcion: __construct".$Sql); 
                    }				
            }
    }
    
    function getIdCargo() {
        return $this->idCargo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    function getFechaSistema() {
        return $this->fechaSistema;
    }

    function getItem() {
        return $this->item;
    }

    function getCodigoUnico() {
        return $this->codigoUnico;
    }

    function setIdCargo($idCargo) {
        $this->idCargo = $idCargo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    function setFechaSistema($fechaSistema) {
        $this->fechaSistema = $fechaSistema;
    }

    function setItem($item) {
        $this->item = $item;
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
			$id = $this->idCargo;

		$Sql = "DELETE FROM cargos WHERE cargos.IDCARGO= '".$id."'";
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
		$Sql = "INSERT INTO cargos (
					IDCARGO,
					DESCRIPCION,
					FECHAREGISTRO,
					FECHASISTEMA,
					ITEM,
					CODIGOUNICO
					)
					VALUES (
						'".$id."', 
						'".$this->descripcion."',
						'".$this->fechaRegistro."',
						'".$this->fechaSistema."',
						'".$this->item."',
                                                '".$this->codigoUnico."'
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
		$Sql = "UPDATE cargos SET 			
						DESCRIPCION='".$this->descripcion."',				
						FECHAREGISTRO='".$this->fechaRegistro."',
						FECHASISTEMA='".$this->fechaSistema."',
						ITEM='".$this->item."'
						";
		if(trim($id)!='')
			$Sql = $Sql." WHERE cargos.IDCARGO='".$id."';";
		else 
			$Sql = $Sql." WHERE cargos.IDCARGO='".$this->idCargo."';";
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
		$Sql = "SELECT * FROM cargos ".$SqlWhere;
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