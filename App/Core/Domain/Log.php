<?php
require_once $App->getPathDomain()."MySql.php";
require_once $App->getPathDomain()."ITransaccion.php";


class Log implements ITransaccion  {
    
    private $idLog;	
    private $departamento;
    private $idUsuario;
    private $fechaRegistro;
    private $fechaSistema;
    private $nombreTabla;
    private $nombreModulo;
    private $tipoEvento;
    private $descripcion;
    private $usuario;
    private $codigoUnico;
    
    function __construct($id='') {
        if(trim($id!='')){
                $Base = new MySql();
                $Sql = "SELECT * FROM logs WHERE logs.IDLOG= '".$id."';";
                $Base->Query($Sql);
                if($Base->NumRows()==1 && $Row = $Base->NextRecord()){
                        $this->idLog= $Row['IDLOG'];	
                        $this->departamento = $Row['DEPARTAMENTO'];	
                        $this->idUsuario = $Row['IDUSUARIO'];
                        $this->fechaRegistro = $Row['FECHAREGISTRO'];
                        $this->fechaSistema = $Row['FECHASISTEMA'];
                        $this->nombreTabla = $Row['NOMBRETABLA'];
                        $this->nombreModulo = $Row['NOMBREMODULO'];
                        $this->tipoEvento = $Row['TIPOEVENTO'];
                        $this->descripcion = $Row['DESCRIPCION'];
                        $this->usuario = $Row['USUARIO'];
                        $this->codigoUnico=$Row['CODIGOUNICO'];
                }
                else{
                        if($id!=0)
                                trigger_error("Error en la clase: LOG, funcion: __construct".$Sql); 
                }				
        }
    }
    
    function getIdLog() {
        return $this->idLog;
    }

    function getDepartamento() {
        return $this->departamento;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    function getFechaSistema() {
        return $this->fechaSistema;
    }

    function getNombreTabla() {
        return $this->nombreTabla;
    }

    function getNombreModulo() {
        return $this->nombreModulo;
    }

    function getTipoEvento() {
        return $this->tipoEvento;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getCodigoUnico() {
        return $this->codigoUnico;
    }

    function setIdLog($idLog) {
        $this->idLog = $idLog;
    }

    function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    function setFechaSistema($fechaSistema) {
        $this->fechaSistema = $fechaSistema;
    }

    function setNombreTabla($nombreTabla) {
        $this->nombreTabla = $nombreTabla;
    }

    function setNombreModulo($nombreModulo) {
        $this->nombreModulo = $nombreModulo;
    }

    function setTipoEvento($tipoEvento) {
        $this->tipoEvento = $tipoEvento;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
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
			$id = $this->idLog;

		$Sql = "DELETE FROM logs WHERE logs.IDLOG= '".$id."'";
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
		$Sql = "INSERT INTO logs (
					IDLOG,
					DEPARTAMENTO,
					IDUSUARIO,
					FECHAREGISTRO,
					FECHASISTEMA,
					NOMBRETABLA,
					NOMBREMODULO,
                                        TIPOEVENTO,
                                        DESCRIPCION,
                                        USUARIO,
                                        CODIGOUNICO
					)
					VALUES (
						'".$id."', 
						'".$this->departamento."',
						'".$this->idUsuario."',
						'".$this->fechaRegistro."',
						'".$this->fechaSistema."',
						'".$this->nombreTabla."',
                                                '".$this->nombreModulo."',
                                                '".$this->tipoEvento."',
                                                '".$this->descripcion."',
                                                '".$this->usuario."',
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
	}

	/**
	 * Obtiene la lista 
	 * (Se puede dar la clausula WHERE para seleccion)'
	 * 
	 * @param [String] $SqlWhere
	 */
	public static function getList($SqlWhere = ''){
		$Base = new MySql();
		$Sql = "SELECT * FROM logs ".$SqlWhere;
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