<?php
require_once $App->getPathDomain()."MySql.php";
require_once $App->getPathDomain()."ITransaccion.php";


class Categoria implements ITransaccion  {
    
    private $idCategoria;	
    private $descripcion;
    private $codigoUnico;
    private $tipoConcepto;

    
    function __construct($id='') {
            if(trim($id!='')){
                    $Base = new MySql();
                    $Sql = "SELECT * FROM categorias WHERE categorias.IDCATEGORIA= '".$id."';";
                    $Base->Query($Sql);
                    if($Base->NumRows()==1 && $Row = $Base->NextRecord()){
                            $this->idCategoria= $Row['IDCATEGORIA'];	
                            $this->descripcion = $Row['DESCRIPCION'];
                            $this->tipoConcepto = $Row['TIPOCONCEPTO'];	
                            $this->codigoUnico = $Row['CODIGOUNICO'];
                    }
                    else{
                            if($id!=0)
                                    trigger_error("Error en la clase: CATEGORIA, funcion: __construct".$Sql); 
                    }				
            }
    }
    
    function getIdCategoria() {
        return $this->idCategoria;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getCodigoUnico() {
        return $this->codigoUnico;
    }

    function getTipoConcepto() {
        return $this->tipoConcepto;
    }


    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setCodigoUnico($codigoUnico) {
        $this->codigoUnico = $codigoUnico;
    }

    function setTipoConcepto($tipoConcepto) {
        $this->tipoConcepto = $tipoConcepto;
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

		$Sql = "DELETE FROM categorias WHERE categorias.IDCATEGORIA= '".$id."'";
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
		$Sql = "INSERT INTO categorias (
					IDCATEGORIA,
					DESCRIPCION,
					TIPOCONCEPTO,
					CODIGOUNICO
					)
					VALUES (
						'".$id."', 
						'".$this->descripcion."',
						'".$this->tipoConcepto."',
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
		$Sql = "UPDATE categorias SET 			
						DESCRIPCION='".$this->descripcion."',
						TIPOCONCEPTO='".$this->tipoConcepto."'				
						";
		if(trim($id)!='')
			$Sql = $Sql." WHERE categorias.IDCATEGORIA='".$id."';";
		else 
			$Sql = $Sql." WHERE categorias.IDCATEGORIA='".$this->idCategoria."';";
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
		$Sql = "SELECT * FROM categorias ".$SqlWhere;
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