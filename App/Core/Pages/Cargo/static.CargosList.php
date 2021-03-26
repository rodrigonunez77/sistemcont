<?php
require_once $App->getPathDomain()."Cargo.php";
require_once $App->getPathDomain()."lib.Table.php";	 	
require_once $App->getPathPages()."IListTable.php";

class CargosList implements IListTable {
	public static function getList($SqlWhere = ''){
		if($SqlWhere == '') $SqlWhere = " ORDER BY cargos.IDCARGO DESC";
		return (Cargo::getList($SqlWhere));		
	}	
}
?>