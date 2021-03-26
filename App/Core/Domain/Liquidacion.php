<?php
require_once $App->getPathDomain()."MySql.php";
require_once $App->getPathDomain()."ITransaccion.php";


class Liquidacion implements ITransaccion  {
    
    private $idLiquidacion;	
    private $fechaRegistro;
    private $fechaSistema;
    private $lugarViaje;
    private $ci;
    private $nombre;
    private $paterno;
    private $materno;
    private $ciChofer;
    private $nombreChofer;
    private $paternoChofer;
    private $maternoChofer;
    private $nroPlaca;
    private $nroInforme;
    private $totalRecaudado;
    private $descuento;
    private $liquidoPagable;
    private $idUsuario;
    private $idLugar;
    private $departamento;
    private $codigoUnico;
            
    function __construct($id='') {
            if(trim($id!='')){
                    $Base = new MySql();
                    $Sql = "SELECT * FROM liquidacion WHERE liquidacion.IDLIQUIDACION= '".$id."';";
                    $Base->Query($Sql);
                    if($Base->NumRows()==1 && $Row = $Base->NextRecord()){
                            $this->idLiquidacion= $Row['IDLIQUIDACION'];	
                            $this->fechaRegistro = $Row['FECHAREGISTRO'];
                            $this->fechaSistema = $Row['FECHASISTEMA'];	
                            $this->lugarViaje = $Row['LUGARVIAJE'];
                            $this->ci = $Row['CI'];
                            $this->nombre = $Row['NOMBRE'];
                            $this->paterno = $Row['PATERNO'];
                            $this->materno = $Row['MATERNO'];
                             $this->ciChofer = $Row['CICHOFER'];
                            $this->nombreChofer = $Row['NOMBRECHOFER'];
                            $this->paternoChofer = $Row['PATERNOCHOFER'];
                            $this->maternoChofer = $Row['MATERNOCHOFER'];

                            $this->nroPlaca = $Row['NROPLACA'];
                             $this->nroInforme= $Row['NROINFORME'];
                            $this->totalRecaudado = $Row['TOTALRECAUDADO'];
                            $this->descuento = $Row['DESCUENTO'];
                            $this->liquidoPagable = $Row['LIQUIDOPAGABLE'];
                            $this->idUsuario = $Row['IDUSUARIO'];
                            $this->idLugar = $Row['IDLUGAR'];
                            $this->departamento = $Row['DEPARTAMENTO'];
                            $this->codigoUnico = $Row['CODIGOUNICO'];
                    }
                    else{
                            if($id!=0)
                                    trigger_error("Error en la clase: LIQUIDACION, funcion: __construct".$Sql); 
                    }				
            }
    }
    
    function getIdLiquidacion() {
        return $this->idLiquidacion;
    }

    function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    function getFechaSistema() {
        return $this->fechaSistema;
    }

    function getLugarViaje() {
        return $this->lugarViaje;
    }

    function getCi() {
        return $this->ci;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPaterno() {
        return $this->paterno;
    }

    function getMaterno() {
        return $this->materno;
    }

    function getCiChofer() {
        return $this->ciChofer;
    }

    function getNombreChofer() {
        return $this->nombreChofer;
    }

    function getPaternoChofer() {
        return $this->paternoChofer;
    }

    function getMaternoChofer() {
        return $this->maternoChofer;
    }


    function getNroPlaca() {
        return $this->nroPlaca;
    }

    function getNroInforme() {
        return $this->nroInforme;
    }

    function getTotalRecaudado() {
        return $this->totalRecaudado;
    }

    function getDescuento() {
        return $this->descuento;
    }

    function getLiquidoPagable() {
        return $this->liquidoPagable;
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

    function setIdLiquidacion($idLiquidacion) {
        $this->idLiquidacion = $idLiquidacion;
    }

    function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    function setFechaSistema($fechaSistema) {
        $this->fechaSistema = $fechaSistema;
    }

    function setLugarViaje($lugarViaje) {
        $this->lugarViaje = $lugarViaje;
    }

    function setCi($ci) {
        $this->ci = $ci;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPaterno($paterno) {
        $this->paterno = $paterno;
    }

    function setMaterno($materno) {
        $this->materno = $materno;
    }

    function setCiChofer($ciChofer) {
        $this->ciChofer = $ciChofer;
    }

    function setNombreChofer($nombreChofer) {
        $this->nombreChofer = $nombreChofer;
    }

    function setPaternoChofer($paternoChofer) {
        $this->paternoChofer = $paternoChofer;
    }

    function setMaternoChofer($maternoChofer) {
        $this->maternoChofer = $maternoChofer;
    }

    function setNroPlaca($nroPlaca) {
        $this->nroPlaca = $nroPlaca;
    }

    function setNroInforme($nroInforme) {
        $this->nroInforme = $nroInforme;
    }

    function setTotalRecaudado($totalRecaudado) {
        $this->totalRecaudado = $totalRecaudado;
    }

    function setDescuento($descuento) {
        $this->descuento = $descuento;
    }

    function setLiquidoPagable($liquidoPagable) {
        $this->liquidoPagable = $liquidoPagable;
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
			$id = $this->idCargo;

		$Sql = "DELETE FROM liquidacion WHERE liquidacion.IDLIQUIDACION= '".$id."'";
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
		$Sql = "INSERT INTO liquidacion SET
                            FECHAREGISTRO='".$this->fechaRegistro."',
                            FECHASISTEMA='".$this->fechaSistema."',
                            LUGARVIAJE='".$this->lugarViaje."',
                            CI='".$this->ci."',
                            NOMBRE='".$this->nombre."',
                            PATERNO='".$this->paterno."',
                            MATERNO='".$this->materno."',

                            CICHOFER='".$this->ciChofer."',
                            NOMBRECHOFER='".$this->nombreChofer."',
                            PATERNOCHOFER='".$this->paternoChofer."',
                            MATERNOCHOFER='".$this->maternoChofer."',

                            NROPLACA='".$this->nroPlaca."',
                            NROINFORME='".$this->nroInforme."',
                            TOTALRECAUDADO='".$this->totalRecaudado."',
                            DESCUENTO='".$this->descuento."',
                            LIQUIDOPAGABLE='".$this->liquidoPagable."',
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
		$Sql = "UPDATE liquidacion SET
                            FECHAREGISTRO='".$this->fechaRegistro."',
                            FECHASISTEMA='".$this->fechaSistema."',
                            LUGARVIAJE='".$this->lugarViaje."',
                            CI='".$this->ci."',
                            NOMBRE='".$this->nombre."',
                            PATERNO='".$this->paterno."',
                            MATERNO='".$this->materno."',
                            CICHOFER='".$this->ciChofer."',
                            NOMBRECHOFER='".$this->nombreChofer."',
                            PATERNOCHOFER='".$this->paternoChofer."',
                            MATERNOCHOFER='".$this->maternoChofer."',

                            NROPLACA='".$this->nroPlaca."',
                            NROINFORME='".$this->nroInforme."',
                            TOTALRECAUDADO='".$this->totalRecaudado."',
                            DESCUENTO='".$this->descuento."',
                            LIQUIDOPAGABLE='".$this->liquidoPagable."',
                            IDUSUARIO='".$this->idUsuario."',
                            IDLUGAR='".$this->idLugar."',
                            DEPARTAMENTO='".$this->departamento."',
                            CODIGOUNICO='".$this->codigoUnico."'			
			";
		if(trim($id)!='')
			$Sql = $Sql." WHERE liquidacion.IDLIQUIDACION='".$id."';";
		else 
			$Sql = $Sql." WHERE liquidacion.IDLIQUIDACION='".$this->idLiquidacion."';";
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
		$Sql = "SELECT * FROM liquidacion ".$SqlWhere;
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