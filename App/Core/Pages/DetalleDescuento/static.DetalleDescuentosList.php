<?php
require_once $App->getPathDomain()."DetalleDescuento.php";
require_once $App->getPathDomain()."lib.Table.php";	 	
require_once $App->getPathPages()."IListTable.php";

class DetalleDescuentosList implements IListTable {
	public static function getList($SqlWhere = ''){
		if($SqlWhere == '') $SqlWhere = " ORDER BY IDDETALLEDESCUENTO DESC";
		return (DetalleDescuento::getList($SqlWhere));		
	}	
}
?>