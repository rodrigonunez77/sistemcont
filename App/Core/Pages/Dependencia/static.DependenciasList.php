<?php
require_once $App->getPathDomain()."Dependencia.php";
require_once $App->getPathDomain()."lib.Table.php";	 	
require_once $App->getPathPages()."IListTable.php";

class DependenciasList implements IListTable {
	public static function getList($SqlWhere = ''){
		if($SqlWhere == '') $SqlWhere = " ORDER BY dependencias.IDDEPENDENCIA DESC";
		return (Dependencia::getList($SqlWhere));		
	}	
}
?>