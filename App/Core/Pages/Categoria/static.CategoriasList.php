<?php
require_once $App->getPathDomain()."Categoria.php";
require_once $App->getPathDomain()."lib.Table.php";	 	
require_once $App->getPathPages()."IListTable.php";

class CategoriasList implements IListTable {
	public static function getList($SqlWhere = ''){
		if($SqlWhere == '') $SqlWhere = " ORDER BY categorias.IDCATEGORIA DESC";
		return (Categoria::getList($SqlWhere));		
	}	
}
?>