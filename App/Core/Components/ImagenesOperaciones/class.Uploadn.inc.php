<?php
	require_once("class.Rand.inc.php");
	require_once("class.ResourcesFiles.inc.php");
	/**
	 * Clase que permite realizar subidas al servidor
	 * PARA WINDOWS ESTÁ EN VERSIÓN BETA
	 * SE DEBEN TESTEAR LOS PERMISOS DE ARCHIVO
	 * Y LA FUNCIÓN DE ResourcesFiles->PERMISOS PARA ARCHIVOS SIN EXTENSIÓN
	 * PUES SE EQUIVOCA EN ENCONTRAR EL RECURSO ESPECIFICADO
	 *
	 * @author Victor Tejerina (c) 2008
	 * @package Engine App
	 * @version V1.0 20/04/2008
	 */
	class Uploadn {
        /**
         * Extensiones valida para subir
         *
         * @var array
         */
        var $ExtenValidas = array();

        /**
         * Tipo de Caracteres no validos para el nombre
         *
         * @var array
         */
        var $NoChars = array('/','\\',':','*','?','"','<','>','|','.');
		
        /**
         * Vector que almacena la información del archivo por subir
         *
         * @var array
         */
        var $FileInfo = array();
        
        /**
         * Toma el valor de $_FILES para uso interno
         *
         * @var unknown_type
         */
        var $FilePost = array();
        
        /**
         * Nombre del objeto cliente o campo del formulario
         *
         * @var string
         */
        var $ObjClientSide;
        
        /**
         * Registra el nuevo nombre de un archivo para ser subido
         *
         * @var string
         */
        var $NewFileName;
        
        /**
         * Directorio de subida
         *
         * @var string
         */
        var $FileDir;
       
        /**
         * Tamaño máximo del archivo por subirse en kb
         *
         * @var integer
         */
        var $MaxSize = 0;
        
        /**
         * Registra todas las operaciones en lotes
         *
         * @var array
         */
		var $BatchProcess = array();
		
		/**
		 * Registra las operaciones repetidas en lotes
		 *
		 * @var array
		 */
		var $BatchRecursiveProcess = array();
		
		var $ReplaceMode;
        
        /**
         * Constructor
         *
         * @param string $ObjClientSide Nombre del objeto cliente, o campo del formulario
         * @return boolean
         */
		function Uploadn($ObjClientSide = '',$Sw=''){
			// Si es diferente de vacío se sube un archivo específico
			// caso contrario podrían ser múltiples archivos por subir en lotes
			//print($GLOBALS['_FILES']['PERSO_FOTO']['name'].'rajo'); exit();
			if ($ObjClientSide != '') {
				$this->ObjClientSide = $ObjClientSide;
				if (isset($GLOBALS['_FILES'])) {
					$this->FilePost = $GLOBALS['_FILES'];
					
					if (is_uploaded_file($this->GetFileTempName())) {
						$this->SetReplaceMode(0);
						return true;
					} else {
						die('no pudo crearse la clase');
					}
				} else {
					die('no pudo crearse la clase');
				}
			} else {
				if($Sw=='')
					die('no pudo crearse la clase');
			}
		}
		
		/**
		 * Permite definir otro recurso
		 *
		 */
		function SetOtherObjectClient($Resource) {
			$this->ObjClientSide = $Resource;
			if (is_uploaded_file($this->GetFileTempName())) {
				$this->SetReplaceMode(0);
				return true;
			} else {
				$this->RollbackUpload();
				die('El cambio de recurso es erroneo: se ha procedido al rollback de todas las operaciones');
			}
		}
		
		/**
		 * Inicializa las extensiones permitidas para subirse al servidor
		 * ya sea desde un array o una cadena separada por comas
		 *
		 * @param array / string $Ext
		 */
		function SetValidExtensions($Ext) {
			$V = array();
			// Reinicializamos el vector
			$this->ExtenValidas = array();
			if (gettype($Ext) == "array") {
				$this->ExtenValidas = $Ext;
			} else {
				$V = explode(',', $Ext);
				// Recorremo el archivo para no permitir 
				// files sin extension
				foreach ($V as $Val) {
					if ($Val != '') {
						array_push($this->ExtenValidas, $Val);
					}
				}
			}
			$this->ToLowerArrayExtensions();
		}
		
		/**
		 * Permite activar modo de reemplazos, vale decir que si encuentra
		 * un archivo con el mismo nombre este se remplazará
		 * Al inicializar la clase automaticamente toma el valor de false
		 * Este metodo es particularmente útil cuando se están trabajando uploads
		 * con el Modo 2 de registro de los mismos, en otro caso no lo use
		 * 
		 * @param int $Rep 0 = false; 1 = true;
		 */
		function SetReplaceMode($Rep = 0) {
			$this->ReplaceMode = $Rep;
		}
		
		/**
		 * Obtiene el modo de remplazo actual
		 *
		 * @return boolean
		 */
		function GetReplaceMode() {
			return $this->ReplaceMode;
		}
		
		/**
		 * Pone a minúsculas todas las extensiones permitidas
		 *
		 */
		function ToLowerArrayExtensions () {
			foreach ($this->ExtenValidas as $Val) 
				$Val = strtolower($Val);
		}
		
		/**
		 * Verifica si un archivo con una extensión dada
		 * tiene permiso para ser subido al servidor
		 *
		 * @param string $Ext Estensión
		 * @return boolean
		 */
		function IsValidExtension($Ext) {
			if (in_array(strtolower($Ext), $this->ExtenValidas)) {
				return true;
			} else {
				return false;
			}
		}
		
		/**
		 * Adiciona una extensión al vector de extensiones válidas
		 *
		 * @param string $Ext
		 */
		function AddExtension($Ext) {
			array_push($this->ExtenValidas, $Ext);
		}
		
		/**
		 * Devuelve un nuevo nombre aleatorio para el archivo a subirse
		 *
		 */
		function SetNewFileName($New = true) {
			// Si se va a generar un nuevo nombre
			if ($New) {
				$R = new Rand();
				/**
				 * El metodo para generar el nombre es:
				 * timestamp + nro_aleatorio + filename
				 * todo esto encriptado a md5
				 */
				$this->NewFileName = md5(time().$R->GetRandNumber().$this->GetFileName());
			// Cuando solo existirá una asignación del mismo
			} else {
				$this->NewFileName = $this->GetFileName();
			}
		}
		
		/**
		 * Genera un nuevo nombre a partir del original
		 * aumentandole un prefijo time() al inicio
		 *
		 * @return string
		 */
		function AddPrefixToFileName() {
			$this->NewFileName = time().'_'.$this->GetFileName();
			//echo $this->NewFileName; exit();
			return $this->NewFileName;
		}
		
		/**
		 * Devuelve el nuevo nombre de un archivo
		 * si $Ext es false devuelve el nombre sin su extensión
		 * si $Ext es true devuelve el nombre con su extensión
		 *
		 * @param boolean $Ext
		 * @return string
		 */
		function GetNewFileName($Ext = false) {
			if ($Ext) {
        		return $this->NewFileName.$this->GetFileExtension();
        	} else {
				return $this->NewFileName;
        	}
		}
		
		/**
		 * Devuelve el nombre original del fichero que se intenta subir al server
		 *
		 * @return string
		 */
        function GetFileName() {
        	return $this->FilePost[$this->ObjClientSide]['name'];
        }
        
        /**
         * Devuelve el nombre del archivo temporal creado en el servidor
         *
         * @return string
         */
        function GetFileTempName() {
        	return $this->FilePost[$this->ObjClientSide]['tmp_name'];
        }
        
        /**
         * Devuelve el peso o tamaño del archivo a subirse al servidor
         *
         * @return string
         */
        function GetFileSize() {
        	return $this->FilePost[$this->ObjClientSide]['size'];
        }
        
        /**
         * Obtiene la extensión del archivo a partir de su nombre original
         *
         * @return string
         */
		function GetFileExtension() {
			return substr($this->GetFileName(),(strrpos($this->GetFileName(),".")+1),strlen($this->GetFileName())-1);
		}
        
		/**
		 * Inicializa el directorio al que subira el archivo
		 *
		 * @param string path $Dir
		 */
		function SetFileDir($Dir) {
			$this->FileDir = $Dir;
		}
		
		/**
		 * Obtiene el directorio de subida
		 *
		 * @return string
		 */
		function GetFileDir() {
			return $this->FileDir;
		}
		
		/**
		 * Lee los datos por defecto desde un archivo de configuración
		 * del entorno en el que se trabaje
		 * El directorio deberá definirse como una variable global con
		 * el nombre de _FILES_UPLOAD_DIR_
		 *
		 */
		function SetFileParameterFromEngine($ToRoot = '') {
			$this->SetFileDir($ToRoot.$GLOBALS['_FILES_UPLOAD_DIR_']);
		}
		
		/**
		 * Lee los datos por defecto desde un archivo de configuración
		 * del entorno en el que se trabaje
		 * El directorio deberá definirse como una variable global con
		 * el nombre de _FILES_TEMP_IMAGE_DIR_
		 *
		 */
		function SetFileParameterForImagesTemp($ToRoot = '') {
			$this->SetFileDir($ToRoot.$GLOBALS['_FILES_TEMP_IMAGE_DIR_']);
		}
		
		/**
		 * Sube un archivo al servidor, verificando si es permitido
		 * Tiene tres modos de subir archivos
		 * 
		 * Si $Mode = 0 sube el archivo al directorio dado con un nombre encriptado
		 * 				sin extensión asignandole un nombre aleatorio
		 * 
		 * Si $Mode = 1 se sube el archivo con un nuevo nombre encriptado
		 * 				mas la extensión del mismo
		 * 
		 * Si $Mode = 2 se sube el archivo con el mismo nombre mas su extensión,
		 * 				en caso de existir uno similar, se asigna un prefijo
		 * 				en función de la variable tiempo.
		 *
		 * @param integer $Mode
		 * @return boolean
		 */
		function UploadFile($Mode = 0) {
			$Res = new ResourcesFiles();
			// El recurso por verificar, si el directorio tiene los permisos
			$Res->SetResourceFile($this->GetFileDir());
			if (!$Res->GetPermissionsGroupWrite()) {
				die('el directorio asignado no tiene permisos de escritura');
			} else {
				// Si $Mode es cero sube el archivo al directorio dado con un nombre encriptado
				// sin extensión asignandole un nombre aleatorio
				switch ($Mode) {
					case 0:
						if ($this->IsValidExtension($this->GetFileExtension())) {
							// Un nuevo nombre inicial
							$this->SetNewFileName();
							// preguntamos si existe el archivo
							$Res->SetResourceFile($this->GetFileDir().$this->GetNewFileName());
							// iteramos hasta obtener un nuevo nombre
							while ($Res->IfFileExists()) {
								$this->SetNewFileName();
								$Res->SetResourceFile($this->GetFileDir().$this->GetNewFileName());
							}
							
							// Ahora copiamos el archivo
							if (!copy($this->GetFileTempName(),$this->GetFileDir().$this->GetNewFileName())) {
								return false;
							}
							// Incluimos la información ampliada en nuestro vector de procesos
							$this->AddBatchProcessValues($Mode);
							return true;
						} else {
							return false;
						}
						break;
					// Si $Mode tiene valor 1, se sube el archivo con un nuevo nombre encriptado
					// + la extensión del mismo
					case 1:
						//print_r($this->FilePost); exit();
						if ($this->IsValidExtension($this->GetFileExtension())) {
							// Un nuevo nombre inicial
							$this->SetNewFileName();
							// preguntamos si existe el archivo
							$Res->SetResourceFile($this->GetFileDir().$this->GetNewFileName().'.'.$this->GetFileExtension());
							
							// iteramos hasta obtener un nuevo nombre
							while ($Res->IfFileExists()) {
								$this->SetNewFileName();
								$Res->SetResourceFile($this->GetFileDir().$this->GetNewFileName().'.'.$this->GetFileExtension());
							}
							//print_r($this); exit();
							// Ahora copiamos el archivo
							if (!copy($this->GetFileTempName(),$this->GetFileDir().$this->GetNewFileName().'.'.$this->GetFileExtension())) {
								return false;
							} 
							// Incluimos la información ampliada en nuestro vector de procesos
							$this->AddBatchProcessValues($Mode);
							return true;
						} else {
							return false;
						}
						break;
					// Si $Mode tiene valor 2, se sube el archivo con el mismo nombre, se añade un prefijo
					// para diferenciarlo en el directorio asignado
					case 2:
						if ($this->IsValidExtension($this->GetFileExtension())) {
							// Un nuevo nombre inicial
							$this->SetNewFileName(false);
							// preguntamos si existe el archivo
							$Res->SetResourceFile($this->GetFileDir().$this->GetNewFileName());
							// iteramos hasta obtener un nuevo nombre
							if ($this->GetReplaceMode() == 0) {
								while ($Res->IfFileExists()) {
									$Res->SetResourceFile($this->GetFileDir().$this->AddPrefixToFileName());
								}
							}
							// Ahora copiamos el archivo
							if (!copy($this->GetFileTempName(),$this->GetFileDir().$this->GetNewFileName())) {
								return false;
							}
							// Incluimos la información ampliada en nuestro vector de procesos
							$this->AddBatchProcessValues($Mode);
							return true;
						} else {
							return false;
						}
						break;
				} 
			}
		}
		
		/**
		 * Genera los valores para el proceso recursivo sobre un mismo recurso
		 * subido varias veces y con modos diferentes
		 *
		 * @param unknown_type $Mode
		 * @return unknown
		 */
		function AddBatchProcessValues($Mode = 0) {
			if (!isset($this->BatchProcess[$this->ObjClientSide])) {
				switch ($Mode) {
					case 0:
						$this->BatchProcess[$this->ObjClientSide] = $this->FilePost[$this->ObjClientSide];
						$this->BatchProcess[$this->ObjClientSide]['new_name'] = $this->GetNewFileName();
						$this->BatchProcess[$this->ObjClientSide]['extension'] = $this->GetFileExtension();
						$this->BatchProcess[$this->ObjClientSide]['replace_mode'] = $this->GetReplaceMode();
						// esta dirección es la de configuración
						$this->BatchProcess[$this->ObjClientSide]['dir_file'] = $this->GetFileDir();
						return true;
						break;
					// Si $Mode tiene valor 1, se sube el archivo con un nuevo nombre encriptado
					// + la extensión del mismo
					case 1:
						$this->BatchProcess[$this->ObjClientSide] = $this->FilePost[$this->ObjClientSide];
						$this->BatchProcess[$this->ObjClientSide]['new_name'] = $this->GetNewFileName().'.'.$this->GetFileExtension();
						$this->BatchProcess[$this->ObjClientSide]['extension'] = $this->GetFileExtension();
						$this->BatchProcess[$this->ObjClientSide]['replace_mode'] = $this->GetReplaceMode();
						$this->BatchProcess[$this->ObjClientSide]['dir_file'] = $this->GetFileDir();
						return true;
						break;
					// Si $Mode tiene valor 2, se sube el archivo con el mismo nombre, se añade un prefijo
					// para diferenciarlo en el directorio asignado
					case 2:
						// Incluimos la información ampliada en nuestro vector de procesos
						$this->BatchProcess[$this->ObjClientSide] = $this->FilePost[$this->ObjClientSide];
						$this->BatchProcess[$this->ObjClientSide]['new_name'] = $this->GetNewFileName();
						$this->BatchProcess[$this->ObjClientSide]['extension'] = $this->GetFileExtension();
						$this->BatchProcess[$this->ObjClientSide]['replace_mode'] = $this->GetReplaceMode();
						$this->BatchProcess[$this->ObjClientSide]['dir_file'] = $this->GetFileDir();
						return true;
						break;
				}
			// Si ya se ha subido el archivo y se ejecuta nuevamente una operación con el mismo
			} else {
				if (!isset($this->BatchRecursiveProcess[$this->ObjClientSide])) {
					$this->BatchRecursiveProcess[$this->ObjClientSide] = array();
				}
				switch ($Mode) {
					case 0:
						array_push($this->BatchRecursiveProcess[$this->ObjClientSide], $this->FilePost[$this->ObjClientSide]);
						$this->BatchRecursiveProcess[$this->ObjClientSide][(count($this->BatchRecursiveProcess[$this->ObjClientSide])-1)]['new_name'] = $this->GetNewFileName();
						$this->BatchRecursiveProcess[$this->ObjClientSide][(count($this->BatchRecursiveProcess[$this->ObjClientSide])-1)]['extension'] = $this->GetFileExtension();
						$this->BatchRecursiveProcess[$this->ObjClientSide][(count($this->BatchRecursiveProcess[$this->ObjClientSide])-1)]['replace_mode'] = $this->GetReplaceMode();
						$this->BatchRecursiveProcess[$this->ObjClientSide][(count($this->BatchRecursiveProcess[$this->ObjClientSide])-1)]['dir_file'] = $this->GetFileDir();
						return true;
						break;
					// Si $Mode tiene valor 1, se sube el archivo con un nuevo nombre encriptado
					// + la extensión del mismo
					case 1:
						array_push($this->BatchRecursiveProcess[$this->ObjClientSide], $this->FilePost[$this->ObjClientSide]);
						$this->BatchRecursiveProcess[$this->ObjClientSide][(count($this->BatchRecursiveProcess[$this->ObjClientSide])-1)]['new_name'] = $this->GetNewFileName().'.'.$this->GetFileExtension();
						$this->BatchRecursiveProcess[$this->ObjClientSide][(count($this->BatchRecursiveProcess[$this->ObjClientSide])-1)]['extension'] = $this->GetFileExtension();
						$this->BatchRecursiveProcess[$this->ObjClientSide][(count($this->BatchRecursiveProcess[$this->ObjClientSide])-1)]['replace_mode'] = $this->GetReplaceMode();
						$this->BatchRecursiveProcess[$this->ObjClientSide][(count($this->BatchRecursiveProcess[$this->ObjClientSide])-1)]['dir_file'] = $this->GetFileDir();
						return true;
						break;
					// Si $Mode tiene valor 2, se sube el archivo con el mismo nombre, se añade un prefijo
					// para diferenciarlo en el directorio asignado
					case 2:
						array_push($this->BatchRecursiveProcess[$this->ObjClientSide], $this->FilePost[$this->ObjClientSide]);
						$this->BatchRecursiveProcess[$this->ObjClientSide][(count($this->BatchRecursiveProcess[$this->ObjClientSide])-1)]['new_name'] = $this->GetNewFileName();
						$this->BatchRecursiveProcess[$this->ObjClientSide][(count($this->BatchRecursiveProcess[$this->ObjClientSide])-1)]['extension'] = $this->GetFileExtension();
						$this->BatchRecursiveProcess[$this->ObjClientSide][(count($this->BatchRecursiveProcess[$this->ObjClientSide])-1)]['replace_mode'] = $this->GetReplaceMode();
						$this->BatchRecursiveProcess[$this->ObjClientSide][(count($this->BatchRecursiveProcess[$this->ObjClientSide])-1)]['dir_file'] = $this->GetFileDir();
						return true;
						break;
				}
			}
		}
		
		/**
		 * En caso de existir un error en la subida de archivos batch
		 * Retorna a cero el proceso
		 *
		 */
		function RollbackUpload() {
			// Debemos recorrer los dos vectores y eliminar todos los archivos procesados
			// anterior a la llamada a este proceso
			$K = array();
			$K = array_keys($this->BatchProcess);
			foreach ($K as $Val) {
				// Si este upload tiene proces recursivos
				if (isset($this->BatchRecursiveProcess[$Val])) {
					// Si es así recorremos los procesos
					foreach ($this->BatchRecursiveProcess[$Val] as $Value) {
						$this->DeleteFile($Value['new_name'], $Value['dir_file']);
					}
				}
				$this->DeleteFile($this->BatchProcess[$Val]['new_name'], $this->BatchProcess[$Val]['dir_file']);
			}
			die('Rollback: '.$this->GetFileName().' no se ha podido subir este archivo');
			unset($this);
		}
		
		/**
		 * Devuelve información ampliada de los archivos subidos
		 * Además encadena en el campo Recursive la información relativa
		 * a operaciones sucesivas con el fichero
		 *
		 * @param string $Resource
		 * @return array
		 */
		function GetFilesInfo($Resource = '') {
			$V = array();
			// Si se ha especificado el recurso,
			// se obtiene solamente la info ampliada del recurso sugerido
			if ($Resource != '') {
				// Vemos si ese recurso se ha subido
				if (isset($this->BatchProcess[$Resource])) {
					if (isset($this->BatchRecursiveProcess[$Resource])) {
						$V = $this->BatchProcess[$Resource];
						$V['Recursive'] = array();
						$V['Recursive'] = $this->BatchRecursiveProcess[$Resource];
						return $V;
					} else {
						return $this->BatchProcess[$Resource];
					}
				} else { 
					return false;
				}
			} else {
				// Caso contrario devolvemos todo el vector de proceso y sus asociaciones
				// recursivas
				$K = array();
				$K = array_keys($this->BatchProcess);
				$V = $this->BatchProcess;
				foreach ($K as $Val) {
					if (isset($this->BatchRecursiveProcess[$Val])) {
						$V[$Val]['Recursive'] = $this->BatchRecursiveProcess[$Val];
					}
				}
				return $V;
			}
		}
		
		/**
		 * Elimina un archivo
		 *
		 * @param string $Resource o nombre del archivo a ser eliminado
		 * @param string $Dir Directorio del cual deseamos eliminar el archivo
		 * @return unknown
		 */
        function DeleteFile($Resource, $Dir='#NODIR#') {
			// Objeto para manejo de recursos IO
			$Res = new ResourcesFiles();
			// Verificamos si debemos actualizar el directorio
			if ($Dir != '#NODIR#') {
				$this->SetFileDir($Dir);
			}
			// El recurso por verificar, si el directorio tiene los permisos
			$Res->SetResourceFile($this->GetFileDir());
			if (!$Res->GetPermissionsGroupWrite()) {
				die('el directorio asignado no tiene permisos de escritura');
			} else {
				// Verificamos la existencia del archivo
				$Res->SetResourceFile($this->GetFileDir().$Resource);
				// iteramos hasta obtener un nuevo nombre
				if ($Res->IfFileExists()) {
					if (!unlink($this->GetFileDir().$Resource)) {
						if ($this->GetReplaceMode() == 1) {
							return true;
						} else {
							die('No se pudo eliminar el archivo');
						}
					} else {
						return true;
					}
				} 
			}
        }
        
        /**
         * EN ESTUDIO - ESTE METODO DEBERÍA IR EN ResourcesFiles
         *
         * @param unknown_type $Resource
         * @param unknown_type $Dir
         */
        function CopyFile($Resource, $Dir='#NODIR#') {
        	
        }
	}
?>