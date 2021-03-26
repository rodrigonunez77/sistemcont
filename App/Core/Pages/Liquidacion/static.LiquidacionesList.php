<?php
require_once $App->getPathDomain()."Liquidacion.php";
require_once $App->getPathDomain()."lib.Table.php";	 	
require_once $App->getPathPages()."IListTable.php";

class LiquidacionesList implements IListTable {
	public static function getList($SqlWhere = ''){
		if($SqlWhere == '') $SqlWhere = " ORDER BY IDLIQUIDACION DESC";
		return (Liquidacion::getList($SqlWhere));		
	}	
}
?>