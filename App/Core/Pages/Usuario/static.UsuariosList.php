<?php
require_once $App->getPathDomain()."Persona.php";
require_once $App->getPathDomain()."lib.Table.php";	 	
require_once $App->getPathPages()."IListTable.php";

class UsuariosList implements IListTable {
	public static function getList($SqlWhere = ''){
		if($SqlWhere == '') $SqlWhere = " ORDER BY personas.IDPERSONA ASC";
		return (Persona::getList($SqlWhere));		
	}	
}
?>