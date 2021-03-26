<?php
	require_once '../../../Connections/BaseAbstract.php';
	//require_once 'Base.php';
	require_once 'Base.php';
	class MySql extends Base {		
		function __construct() {
			$this->ConnectDB();			
		}
	}
?>