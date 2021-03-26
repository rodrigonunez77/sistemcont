<?php
require_once $App->getPathDomain()."Lugar.php";
require_once $App->getPathDomain()."lib.Table.php";	 	
require_once $App->getPathPages()."IListTable.php";

class LugaresList implements IListTable {
	public static function getList($SqlWhere = ''){
		if($SqlWhere == '') $SqlWhere = " ORDER BY lugares.IDLUGAR DESC";
		return (Lugar::getList($SqlWhere));		
	}	
}
?>