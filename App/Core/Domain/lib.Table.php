<?php

class Table {

	/**
	 * Obtiene el ultimo id + 1 de la tabla dada, $Base es un objeto MySql
	 *
	 * @param Object:MySql $Base
	 * @param String:Nombre_Tabla $Tabla
	 * @param String:Campo_Primario $Campo
	 * @return int:Nuevo_Id
	 */
	static function __PRIMARY_KEY__($Base, $Tabla,$Campo) {
		$Sql = sprintf("SELECT %s FROM %s ORDER BY %s DESC LIMIT 0,1", $Campo, $Tabla, $Campo);
		
		$Base->Query($Sql);
		if ($Base->NumRows() > 0) {
			$Row = $Base->NextRecord();
			return ($Row["$Campo"] +1);
		}else{
			return 1;
		}
	}
	
	/**
	 * Obtiene el numero correlativo incrementado en una unidad, $Base es un objeto MySql
	 *
	 * @param Object:MySql $Base
	 * @param String:Nombre_tabla $Tabla
	 * @param String:Campo_a_correlacionar $Campo
	 * @param [String:condicion] $Condicion
	 */
	static function __FOREIGN_KEY__($Base, $Tabla, $Campo, $Condicion = ''){
		if(trim($Condicion)=='')
			$Sql = sprintf("SELECT %s FROM %s ORDER BY %s DESC LIMIT 0,1", $Campo, $Tabla, $Campo);
		else
			$Sql = sprintf("SELECT %s FROM %s WHERE (%s) ORDER BY %s DESC LIMIT 0,1", $Campo, $Tabla, $Condicion, $Campo);
		
		$Base->Query($Sql);
		if ($Base->NumRows() > 0) {
			$Row = $Base->NextRecord();
			return ($Row["$Campo"]);
		}else{
			return 1;
		}
	}
	/**
	***
	se obtiene el id de una tabla para usar como un id Foranea
	**
	**/
	static function __CORRELATE_FIELD__($Base, $Tabla, $Campo, $Condicion = ''){
		if(trim($Condicion)=='')
			$Sql = sprintf("SELECT %s FROM %s ORDER BY %s DESC LIMIT 0,1", $Campo, $Tabla, $Campo);
		else
			$Sql = sprintf("SELECT %s FROM %s WHERE (%s) ORDER BY %s DESC LIMIT 0,1", $Campo, $Tabla, $Condicion, $Campo);
		
		$Base->Query($Sql);
		if ($Base->NumRows() > 0) {
			$Row = $Base->NextRecord();
			return ($Row["$Campo"] +1);
		}else{
			return 1;
		}
	}

	
	/**
	 * Consulta de ejecucion
	 *
	 * @param string $query
	 */	
	public static function executeQuery($query) {
		$Base = new MySql();
		if(trim($query)!=''){
			$Base->Query($query);
		}
	}
	/**
	 * Consulta de seleccion a cualquier tabla, ya sea con subconsultas
	 *
	 * @param String $Sql
	 * @return Array
	 */
	public static function getListQuery($Sql){
		$Base = new MySql();
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