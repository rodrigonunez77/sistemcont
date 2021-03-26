<?php
require_once $App->getPathDomain()."MySql.php";
require_once $App->getPathDomain()."ITransaccion.php";


class DetalleDestino implements ITransaccion  {
    
    private $idDetalleDestino;	
    private $idLiquidacion;
    private $localidad;
    private $nroPasajero;
    private $costoPasaje;
    private $importe;
    private $idUsuario;
    private $idLugar;
    private $departamento;
    private $codigoUnico;
                
    function __construct($id='') {
            if(trim($id!='')){
                    $Base = new MySql();
                    $Sql = "SELECT * FROM detalledestino WHERE detalledestino.IDDETALLEDESTINO= '".$id."';";
                    $Base->Query($Sql);
                    if($Base->NumRows()==1 && $Row = $Base->NextRecord()){
                            $this->idDetalleDestino= $Row['IDDETALLEDESTINO'];	
                            $this->idLiquidacion = $Row['IDLIQUIDACION'];
                            $this->localidad = $Row['LOCALIDAD'];	
                            $this->nroPasajero = $Row['NROPASAJERO'];
                            $this->costoPasaje = $Row['COSTOPASAJE'];
                            $this->importe = $Row['IMPORTE'];
                            $this->idUsuario = $Row['IDUSUAIRO'];
                            $this->idLugar = $Row['IDLUGAR'];
                            $this->departamento = $Row['DEPARTAMENTO'];
                            $this->codigoUnico = $Row['CODIGOUNICO'];
                    }
                    else{
                            if($id!=0)
                                    trigger_error("Error en la clase: DETALLE DESTINO, funcion: __construct".$Sql); 
                    }				
            }
    }
    
    function getIdDetalleDestino() {
        return $this->idDetalleDestino;
    }

    function getIdLiquidacion() {
        return $this->idLiquidacion;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getNroPasajero() {
        return $this->nroPasajero;
    }

    function getCostoPasaje() {
        return $this->costoPasaje;
    }

    function getImporte() {
        return $this->importe;
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

    function setIdDetalleDestino($idDetalleDestino) {
        $this->idDetalleDestino = $idDetalleDestino;
    }

    function setIdLiquidacion($idLiquidacion) {
        $this->idLiquidacion = $idLiquidacion;
    }

    function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    function setNroPasajero($nroPasajero) {
        $this->nroPasajero = $nroPasajero;
    }

    function setCostoPasaje($costoPasaje) {
        $this->costoPasaje = $costoPasaje;
    }

    function setImporte($importe) {
        $this->importe = $importe;
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
			$id = $this->idDetalleDestino;

		$Sql = "DELETE FROM detalledestino WHERE detalledestino.IDDETALLEDESTINO= '".$id."'";
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
		$Sql = "INSERT INTO detalledestino set 
					IDLIQUIDACION='".$this->idLiquidacion."',
                                        LOCALIDAD='".$this->localidad."',
                                        NROPASAJERO='".$this->nroPasajero."',
                                        COSTOPASAJE='".$this->costoPasaje."',
                                        IMPORTE='".$this->importe."',
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
		$Sql = "UPDATE detalledestino set 
                            LOCALIDAD='".$this->localidad."',
                            NROPASAJERO='".$this->nroPasajero."',
                            COSTOPASAJE='".$this->costoPasaje."',
                            IMPORTE='".$this->importe."',
                            
                            ";
		if(trim($id)!='')
			$Sql = $Sql." WHERE detalledestino.IDDETALLEDESTINO='".$id."';";
		else 
			$Sql = $Sql." WHERE detalledestino.IDDETALLEDESTINO='".$this->idDetalleDestino."';";
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
		$Sql = "SELECT * FROM detalledestino ".$SqlWhere;
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