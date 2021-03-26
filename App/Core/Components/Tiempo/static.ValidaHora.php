<?php
class ValidaHora{
	/**
	 * Para convertir hora del archivo excel
	 *
	 * @param Cadena $hora
	 */
	static function ConvertirHora($hora){
		$hora = str_replace(",",".",$hora);
		$horaConvert=strtotime($hora);
		$horaConvert=date("H:i:s",$horaConvert);
		return $horaConvert; 
	}
}
?>
