<?php
class ImagenUploadTemporal {
	/**
	 * Sube al servidor
	 *
	 * @param Archivo $file
	 * @param nombreNuevo $nombreArchivo
	 */
	function upload($file, $nombreArchivo){
		
		$nombre_archivo = $file['name'];
		//$nombre_archivo = $HTTP_POST_FILES['userfile']['name']; 
		//echo $nombre_archivo."<br>";
		$extension = explode(".",$file['name']);
		$num = count($extension)-1;
		$errSize=0;
		$archivo=$nombreArchivo;
		
		if ($archivo!=""){	
			$tipo_archivo = $file['type']; 
			$tamano_archivo = $file['size']; 
			//echo $nombre_archivo;
			//echo "archivo:".$userfile;
			//echo "<br>Tipo:".$tipo_archivo;
			//echo "<br>tam:".$tamano_archivo ;
			//compruebo si las características del archivo son las que deseo 
			if (!($tamano_archivo < 1000000000000)) { 
				die("El archivo es demasiado grande, ingrese otros datos");
			}else{ 
				if (move_uploaded_file($file['tmp_name'], $archivo)){ 
				   //echo "El archivo ha sido cargado correctamente."; 
				}else{ 
					die("Error interno, consulte con el administrador.");
				}					
			} 
		}
		
		
			
	}
	function remove($archivo){
		if($archivo!="" && file_exists($archivo)){
			if(chmod($archivo,0700))	unlink($archivo) or die ("Error en la eliminacion del archivo fisico");
			else die("Sin permisos para cambiar atributo para eliminar archivo");		
		}	
	}
}

?>