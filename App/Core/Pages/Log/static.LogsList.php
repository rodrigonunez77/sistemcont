<?php
require_once $App->getPathDomain()."Log.php";
require_once $App->getPathDomain()."lib.Table.php";	 	
require_once $App->getPathPages()."IListTable.php";

class LogsList implements IListTable {
	public static function getList($SqlWhere = ''){
		if($SqlWhere == '') $SqlWhere = " ORDER BY logs.IDLOG DESC";
		return (Log::getList($SqlWhere));		
	}	
}
?>