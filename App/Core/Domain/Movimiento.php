<?php
require_once $App->getPathDomain()."MySql.php";
require_once $App->getPathDomain()."ITransaccion.php";


class Movimiento implements ITransaccion  {
    private $idMovimiento;	
    private $departamento;
    private $idLugar;
    private $idUsuario;
    private $nroReciboIngreso;
    private $nroReciboEgreso;
    private $tipoRegistro;
    private $fechaRegistro;
    private $fechaSistema;
    private $nombreOrigen;
    private $nombreDestino;
    private $nroDoc;
    private $idConcepto;
    private $concepto;
    private $tipoConcepto;
    private $montoBs;
    private $acuenta;
    private $saldo;
    private $totalBs;
    private $observacion;
    private $estado;
    private $tipoPago;
    private $codigoUnico;
    private $glosa;
    private $autorizadoPor;
    private $revisadoPor;
    private $preparadoPor;
    private $imgDeposito;
    private $estadoDeposito;
            
    function __construct($id='') {
        if(trim($id!='')){
                $Base = new MySql();
                $Sql = "SELECT * FROM movimientos WHERE movimientos.IDMOVIMIENTO= '".$id."';";
                $Base->Query($Sql);
                if($Base->NumRows()==1 && $Row = $Base->NextRecord()){
                        $this->idMovimiento= $Row['IDMOVIMIENTO'];	
                        $this->departamento = $Row['DEPARTAMENTO'];	
                        $this->idLugar = $Row['IDLUGAR'];
                        $this->idUsuario = $Row['IDUSUARIO'];
                        $this->nroReciboIngreso = $Row['NRORECIBOINGRESO'];
                        $this->nroReciboEgreso = $Row['NRORECIBOEGRESO'];
                        $this->tipoRegistro = $Row['TIPOREGISTRO'];
                        $this->fechaRegistro = $Row['FECHAREGISTRO'];
                        $this->fechaSistema = $Row['FECHASISTEMA'];
                        $this->nombreOrigen = $Row['NOMBREORIGEN'];
                        $this->nombreDestino = $Row['NOMBREDESTINO'];
                        $this->nroDoc = $Row['NRODOC'];
                        $this->idConcepto = $Row['IDCONCEPTO'];
                        $this->concepto = $Row['CONCEPTO'];
                        $this->tipoConcepto = $Row['TIPOCONCEPTO'];
                        $this->montoBs = $Row['MONTOBS'];
                        $this->acuenta = $Row['ACUENTA'];
                        $this->saldo = $Row['SALDO'];
                        $this->totalBs = $Row['TOTALBS'];
                        $this->observacion = $Row['OBSERVACION'];
                        $this->estado = $Row['ESTADO'];
                        $this->tipoPago = $Row['TIPOPAGO'];
                        $this->codigoUnico = $Row['CODIGOUNICO'];
                        $this->glosa = $Row['GLOSA'];
                        $this->autorizadoPor = $Row['AUTORIZADOPOR'];
                        $this->revisadoPor = $Row['REVISADOPOR'];
                        $this->preparadoPor = $Row['PREPARADOPOR'];
                        $this->imgDeposito = $Row['IMGDEPOSITO'];
                        $this->estadoDeposito = $Row['ESTADODEPOSITO'];

                }
                else{
                        if($id!=0)
                                trigger_error("Error en la clase: MOVIMIENTO, funcion: __construct".$Sql); 
                }				
        }        
    }
    
    
    function getIdMovimiento() {
        return $this->idMovimiento;
    }

    function getDepartamento() {
        return $this->departamento;
    }

    function getIdLugar() {
        return $this->idLugar;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNroReciboIngreso() {
        return $this->nroReciboIngreso;
    }

    function getNroReciboEgreso() {
        return $this->nroReciboEgreso;
    }

    function getTipoRegistro() {
        return $this->tipoRegistro;
    }

    function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    function getFechaSistema() {
        return $this->fechaSistema;
    }

    function getNombreOrigen() {
        return $this->nombreOrigen;
    }

    function getNombreDestino() {
        return $this->nombreDestino;
    }
    
    function getNroDoc() {
        return $this->nroDoc;
    }

    function getIdConcepto() {
        return $this->idConcepto;
    }

    function getConcepto() {
        return $this->concepto;
    }

    function getTipoConcepto() {
        return $this->tipoConcepto;
    }

    function getMontoBs() {
        return $this->montoBs;
    }

    function getAcuenta() {
        return $this->acuenta;
    }

     function getSaldo() {
        return $this->saldo;
    }

    function getTotalBs() {
        return $this->totalBs;
    }

    function getObservacion() {
        return $this->observacion;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCodigoUnico() {
        return $this->codigoUnico;
    }

    function getGlosa() {
        return $this->glosa;
    }

    function getAutorizadoPor() {
        return $this->autorizadoPor;
    }

    function getRevisadoPor() {
        return $this->revisadoPor;
    }

    function getPreparadoPor() {
        return $this->preparadoPor;
    }
    function getImgDeposito() {
        return $this->imgDeposito;
    }
    function getTipoPago() {
        return $this->tipoPago;
    }
    function getEstadoDeposito() {
        return $this->estadoDeposito;
    }


    function setIdMovimiento($idMovimiento) {
        $this->idMovimiento = $idMovimiento;
    }

    function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    function setIdLugar($idLugar) {
        $this->idLugar = $idLugar;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setNroReciboIngreso($nroReciboIngreso) {
        $this->nroReciboIngreso = $nroReciboIngreso;
    }

    function setNroReciboEgreso($nroReciboEgreso) {
        $this->nroReciboEgreso = $nroReciboEgreso;
    }
    
    function setTipoRegistro($tipoRegistro) {
        $this->tipoRegistro = $tipoRegistro;
    }

    function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    function setFechaSistema($fechaSistema) {
        $this->fechaSistema = $fechaSistema;
    }

    function setNombreOrigen($nombreOrigen) {
        $this->nombreOrigen = $nombreOrigen;
    }

    function setNombreDestino($nombreDestino) {
        $this->nombreDestino = $nombreDestino;
    }
    
    function setNroDoc($nroDoc) {
        $this->nroDoc = $nroDoc;
    }

    function setIdConcepto($idConcepto) {
        $this->idConcepto = $idConcepto;
    }

    function setConcepto($concepto) {
        $this->concepto = $concepto;
    }

    function setTipoConcepto($tipoConcepto) {
        $this->tipoConcepto = $tipoConcepto;
    }

    function setMontoBs($montoBs) {
        $this->montoBs = $montoBs;
    }

    function setAcuenta($acuenta) {
        $this->acuenta = $acuenta;
    }

    function setTotalBs($totalBs) {
        $this->totalBs = $totalBs;
    }

    function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCodigoUnico($codigoUnico) {
        $this->codigoUnico = $codigoUnico;
    }

    function setGlosa($glosa) {
        $this->glosa = $glosa;
    }

    function setAutorizadoPor($autorizadoPor) {
        $this->autorizadoPor = $autorizadoPor;
    }

    function setRevisadoPor($revisadoPor) {
        $this->revisadoPor = $revisadoPor;
    }

    function setPreparadoPor($preparadoPor) {
        $this->preparadoPor = $preparadoPor;
    }

    function setImgDeposito($imgDeposito) {
        $this->imgDeposito = $imgDeposito;
    }

    function setTipoPago($tipoPago) {
        $this->tipoPago = $tipoPago;
    }

    function setEstadoDeposito($estadoDeposito) {
        $this->estadoDeposito = $estadoDeposito;
    }

       
    
   
                
   
	/**
	 * @see ITransaccion::delete()
	 *
	 * @param [int] $id
	 */
	public function delete($id='') {
		$Base = new MySql();
		if(trim($id)=='')
			$id = $this->idMovimiento;

		$Sql = "DELETE FROM movimientos WHERE movimientos.IDMOVIMIENTO= '".$id."'";
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
		$Sql = "INSERT INTO movimientos  SET
			            DEPARTAMENTO='".$this->departamento."', 
                                    IDLUGAR='".$this->idLugar."',
                                    IDUSUARIO='".$this->idUsuario."',
                                    NRORECIBOINGRESO='".$this->nroReciboIngreso."',
                                    NRORECIBOEGRESO='".$this->nroReciboEgreso."',
                                    TIPOREGISTRO='".$this->tipoRegistro."',
                                    FECHAREGISTRO='".$this->fechaRegistro."',
                                    FECHASISTEMA='".$this->fechaSistema."',
                                    NOMBREORIGEN='".$this->nombreOrigen."',
                                    NOMBREDESTINO='".$this->nombreDestino."',
                                    NRODOC='".$this->nroDoc."',
                                    IDCONCEPTO='".$this->idConcepto."',
                                    CONCEPTO='".$this->concepto."',
                                    TIPOCONCEPTO='".$this->tipoConcepto."',
                                    MONTOBS='".$this->montoBs."',
                                    ACUENTA='".$this->acuenta."',
                                    SALDO='".$this->saldo."',
                                    TOTALBS='".$this->totalBs."',
                                    OBSERVACION='".$this->observacion."',
                                    ESTADO='".$this->estado."',
                                    ESTADODEPOSITO='".$this->estadoDeposito."',
                                    TIPOPAGO='".$this->tipoPago."',
                                    CODIGOUNICO='".$this->codigoUnico."', 
                                    GLOSA='".$this->glosa."',
                                    AUTORIZADOPOR= '".$this->autorizadoPor."',
                                    REVISADOPOR= '".$this->revisadoPor."',
                                    PREPARADOPOR='".$this->preparadoPor."',
                                    IMGDEPOSITO='".$this->imgDeposito."'
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
		$Sql = "UPDATE movimientos SET 			
                                    DEPARTAMENTO='".$this->departamento."', 
                                    IDLUGAR='".$this->idLugar."',
                                    IDUSUARIO='".$this->idUsuario."',
                                    NRORECIBOINGRESO='".$this->nroReciboIngreso."',
                                    NRORECIBOEGRESO='".$this->nroReciboEgreso."',
                                    TIPOREGISTRO='".$this->tipoRegistro."',
                                    FECHAREGISTRO='".$this->fechaRegistro."',
                                    FECHASISTEMA='".$this->fechaSistema."',
                                    NOMBREORIGEN='".$this->nombreOrigen."',
                                    NOMBREDESTINO='".$this->nombreDestino."',
                                    NRODOC='".$this->nroDoc."',
                                    IDCONCEPTO='".$this->idConcepto."',
                                    CONCEPTO='".$this->concepto."',
                                    TIPOCONCEPTO='".$this->tipoConcepto."',
                                    MONTOBS='".$this->montoBs."',
                                    ACUENTA='".$this->acuenta."',
                                    SALDO='".$this->saldo."',
                                    TOTALBS='".$this->totalBs."',
                                    OBSERVACION='".$this->observacion."',
                                    ESTADO='".$this->estado."',
                                    ESTADODEPOSITO='".$this->estadoDeposito."',
                                    TIPOPAGO='".$this->tipoPago."',
                                    CODIGOUNICO='".$this->codigoUnico."', 
                                    GLOSA='".$this->glosa."',
                                    AUTORIZADOPOR= '".$this->autorizadoPor."',
                                    REVISADOPOR= '".$this->revisadoPor."',
                                    PREPARADOPOR='".$this->preparadoPor."',
                                    IMGDEPOSITO='".$this->imgDeposito."'";
		if(trim($id)!='')
			$Sql = $Sql." WHERE movimientos.IDMOVIMIENTO='".$id."';";
		else 
			$Sql = $Sql." WHERE movimientos.IDMOVIMIENTO='".$this->idMovimiento."';";
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
		$Sql = "SELECT * FROM movimientos ".$SqlWhere;
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