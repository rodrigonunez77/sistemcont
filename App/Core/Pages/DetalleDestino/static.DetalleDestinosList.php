<?php
require_once $App->getPathDomain()."DetalleDestino.php";
require_once $App->getPathDomain()."lib.Table.php";	 	
require_once $App->getPathPages()."IListTable.php";

class DetalleDestinosList implements IListTable {
	public static function getList($SqlWhere = ''){
		if($SqlWhere == '') $SqlWhere = " ORDER BY IDDETALLEDESTINO DESC";
		return (DetalleDestino::getList($SqlWhere));		
	}	
}
?>