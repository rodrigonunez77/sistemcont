<?php
class Base extends BaseAbstract {
	private $link;
	private $DataBaseResult;
	private $numRows;
	private $result;
	function __construct() {
					
	}	
	
	/**
	 * @return unknown
	 */
	public function getResult() {
		return $this->result;
	}
	
	public function ConnectDB() {
		if($this->link = mysqli_connect($this->__SERVER, $this->__USER, $this->__PASSWORD,$this->__BASE)){
			//if(!$this->DataBaseResult = mysql_select_db($this->__BASE,$this->link))
				//echo "E R R O R";
				//die("CONEXION FALLIDA CON LA BASE DE DATOS"); 		
		}
		else 
			//echo "E R R O R";
			die("CONEXION CON EL SERVIDOR FALLIDO");		
		//echo "bien";
	}
	public function Query($Sql){
		
		//if(!($this->result = mysql_query($Sql,$this->link))){
		if(!($this->result = $this->link->query($Sql))){
			echo $Sql;
			echo '<br><h2><font color="#AC3C15">Error en la consulta: <br><i>'.$Sql.'</i><br> MySQL dice: '.mysql_error().'</font></h2>';
			die();
		}
		
	}
	public function NumRows(){
		//return mysql_affected_rows();	
		return $this->link->affected_rows;

	}
	public function NextRecord(){
		return mysqli_fetch_array($this->result);
	}
}
?>