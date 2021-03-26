<?php
require_once $App->getPathDomain()."Movimiento.php";
require_once $App->getPathDomain()."lib.Table.php";	 	
require_once $App->getPathPages()."IListTable.php";

class MovimientosList implements IListTable {
	public static function getList($SqlWhere = ''){
		if($SqlWhere == '') $SqlWhere = " ORDER BY movimientos.IDMOVIMIENTO DESC";
		return (Movimiento::getList($SqlWhere));		
	}	
}
?>