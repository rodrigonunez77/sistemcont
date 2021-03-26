<?php
class App {
	private $pathDomain = '../../Core/Domain/';
	private $pathComponents = '../../Core/Components/';
	private $pathJavaScript = '../../Core/JavaScript/';
	private $pathPages = '../../Core/Pages/';
	private $pathImages = '../../Images/';
	private $pathUpFiles = '../../UpFiles/';
	private $pathErrors = '../../Errors/';
	private $pathSecurity = '../../../Security/';
	private $pathModules = '../../Modules/';
	private $pathStyles = '../../Core/css/';
	private $pathRoot = '/sistemcont/App/';	
	private $pathUpdateImagenProducts = '../../Images/UpdateImagenProducts/';	
		
	/**
	 * Retrona el path de la imagen a ubicarse
	 *
	 * @param String $Archivo
	 */
	public function getImagen($StringArchivo){
		return $this->getPathImages().$StringArchivo;
	}
	public function getFile($StringFile){
		return $this->getPathUpFiles().$StringFile;		
	}
	public function getPathStyles($Style){
		return $this->pathStyles.$Style;
	}
	/**
	 * Retorna el paths de loscomponentes
	 * @return pathComponents
	 */
	public function getPathComponents($File) {
		return $this->pathComponents.$File;
	}	
	/**
	 * Retorna el paths de la capa Domain
	 * @return pathDomain
	 */
	public function getPathDomain() {
		return $this->pathDomain;
	}	
	/**
	 * Retorna el paths de los errores de navegacion
	 * @return pathErrors
	 */
	public function getPathErrors($File = '') {
		return $this->pathErrors.$File;
	}	
	/**
	 * Retorna el paths de las imagenes
	 * @return pathImages
	 */
	public function getPathImages() {
		return $this->pathImages;
	}	
	/**
	 * Retorna el paths de los Java Scripts
	 * @return pathJavaScript
	 */
	public function getPathJavaScript($File) {
		return $this->pathJavaScript.$File;
	}	
	/**
	 * Retorna el paths de las paginas View
	 * @return pathPages
	 */
	public function getPathPages() {
		return $this->pathPages;
	}	
	/**
	 * Retorna el paths de los archivos a actualizar
	 * @return pathUpFiles
	 */
	public function getPathUpFiles() {
		return $this->pathUpFiles;
	}	
	/**
	 * Retorna el paths del directorio de Seguridad
	 * @return pathSecurity
	 */
	public function getPathSecurity($File='') {
		return $this->pathSecurity.$File;
	}
	
	/**
	 * Retorna el paths de Los modulos implementados
	 * @return pathModules
	 */
	public function getPathModules() {
		return $this->pathModules;
	}
	public function getPathApp(){
		return "http://".$_SERVER['SERVER_NAME'].$this->pathRoot;
	}
}
$App = new App();
?>