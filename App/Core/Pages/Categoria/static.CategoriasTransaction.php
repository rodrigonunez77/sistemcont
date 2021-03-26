<?php
require_once $App->getPathDomain()."Categoria.php";	 	
require_once $App->getPathDomain()."lib.Table.php";

class CategoriasTransaction {
	public static function insert($Data){
		$data = $Data;
		$data->insert();		
		return true;
	}	

	public static function getCodeNext(){
		$Base = new MySql();
		return Table::__PRIMARY_KEY__($Base,"categorias","IDCATEGORIA");		
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
			$Transaction = new Sucursal();
			$ArrayList = explode($_caracter,$Serializado);	
			for($i=0; $i<count($ArrayList) ; $i++){
				$Transaction->delete($ArrayList[$i]);
			}			
		} 
		return true;
	}

	public static function delete($id){	
		$data = new Categoria;
		$data->delete($id);
	}

	public static function update($Data){
		$data = $Data;
		$data->update();		
	}
}
?>