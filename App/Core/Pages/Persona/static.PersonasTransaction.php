<?php
require_once $App->getPathDomain()."Proveedor.php";	 	
require_once $App->getPathDomain()."lib.Table.php";

class PersonasTransaction {
	public static function insert($data){
		$data = $data;
		$data->insert();
		
		return true;
	}	

	public static function getCodeNext(){
		$Base = new MySql();
		return Table::__PRIMARY_KEY__($Base,"proveedor","IDPROVEEDOR");		
	}
	/**
	 * Elimina una lista serializada ...
	 *
	 * @param string $strSerializado
	 * @param char $caracterSeparador
	 * @return true-false
	 */
	public static function deleteList($Serializado, $_caracter){
		if ($Serializado!="" ){
			$Transaction = new Proveedor();
			$ArrayList = explode($_caracter,$Serializado);	
			for($i=0; $i<count($ArrayList) ; $i++){
				$Transaction->delete($ArrayList[$i]);
			}			
		} 
		return true;
	}

	public static function delete($id){	
		$data = new Proveedor;
		$data->delete($id);
	}

	public static function update($Actualizado){
		$data = $Actualizado;
		$data->update();		
	}
}
?>